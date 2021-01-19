<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Cme;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CmeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        // Count Is Home Status
        $is_home_count = Cme::where('is_home', 1)->count();
        if ($request->is_home) {
            if ($is_home_count >= 4) {
                return response_json(false, '', 'Video pilihan telah dibatasi hanya untuk 4 video.');
            }
        }

        DB::beginTransaction();
        try {
            // Is Home Status
            $request->merge([
                'is_home' => ($request->is_home) ? 1 : 0,
            ]);

            $data = Cme::create($request->all());
            
            $request->merge([
                'title'   => $request->input('title_en'),
            ]);

            $data_en = Cme::on('mysqlEng')->create($request->all());

            $data->save();

            log_activity(
                'Tambah Cme ' . $data->title,
                $data
            );

            DB::commit();
            return response_json(true, null, 'Cme ' . __('saved successfully'), $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Cme $cme
     * @return Renderable
     */
    public function update(Request $request, Cme $cme)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        // Count Is Home Status
        $is_home_count = Cme::where('is_home', 1)->where('id', '!=', $cme->id)->count();
        if ($request->is_home) {
            if ($is_home_count >= 4) {
                return response_json(false, '', 'Video pilihan telah dibatasi hanya untuk 4 video.');
            }
        }

        DB::beginTransaction();
        try {
            $cme->update($request->all());

            // Is Home Status
            if ($request->is_home) {
                $cme->is_home = 1;
            } else {
                $cme->is_home = 0;
            }

            $data = Cme::on('mysqlEng')->where('id', $cme->id)->update([
                'title'   => $request->input('title_en'),
                'is_home' => $cme->is_home
            ]);

            $cme->save();

            log_activity(
                'Ubah Cme ' . $cme->title,
                $cme
            );
            
            DB::commit();
            return response_json(true, null, 'Cme ' . __('saved successfully'), $cme);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Cme $cme
     * @return Renderable
     */
    public function destroy(Cme $cme)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus Cme ' . $cme->title,
                $cme
            );

            $data_en = Cme::on('mysqlEng')->where('id', $cme->id)->delete();
            $cme->delete();
            DB::commit();
            return response_json(true, null, 'Cme ' .  __('Deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Delete data failed, try again later.'));
        }
    }

    /**
     * Get the specified resource from storage.
     * @param Cme $cme
     * @return Renderable
     */
    public function data(Cme $cme)
    {
        $data = Cme::on('mysqlEng')->where('id', $cme->id)->firstOrFail();
        $cme->title_en = $data->title;
        return response_json(true, null, 'Data retrieved', $cme);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'title' => 'bail|required|string|max:190',
            'type' => 'bail|required',
            'link_embed_youtube' => 'bail|required',
            'link_url_zoom' => 'bail|required',
        ]);
    }

    /**
     *
     * Get the resources from storage.
     * @return Renderable
     *
     */
    public function table(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Isian form salah', $validator->errors()->first());
        }

        if (\Session::get('lang') == 'id'){
            $query = Cme::query();
        } else{
            $query = Cme::on('mysqlEng');
        }

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->orWhere('title', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('type', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $data_id = Cme::find($item->id);
            $item->slug = $data_id->slug;
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            if ($item->is_home) {
                $item->is_home = "Video Pilihan";
            } else {
                $item->is_home = "-";
            }
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    /**
     *
     * Validation Rules for Get Table Data
     *
     */
    public function validateTableRequest($request)
    {
        return Validator::make($request->all(), [
            "page" => "bail|sometimes|required|numeric|min:1",
            "search" => "bail|present|nullable",
            "paginate" => "bail|required|numeric|in:10,20,50,100",
        ]);
    }
}
