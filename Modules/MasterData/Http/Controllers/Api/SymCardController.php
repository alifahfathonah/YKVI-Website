<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\SymCard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SymCardController extends Controller
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

        DB::beginTransaction();
        try {
            $data = SymCard::create($request->all());

            if ($request->hasFile('sym_card_image')) {
                $file_name = $data->title .'-'. uniqid() . '.' . $request->file('sym_card_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sym_card/sym_card_image', $request->file('sym_card_image'), $file_name
                );
                $data->sym_card_image = $file_name;
            }

            $request->merge([
                'title'   => $request->input('title_en'),
                'description'   => $request->input('description_en'),
            ]);

            $data_en = SymCard::on('mysqlEng')->create($request->all());
            $data_en->sym_card_image = $data->sym_card_image;

            $data->save();
            $data_en->save();

            log_activity(
                'Tambah SymCard ' . $data->title,
                $data
            );

            DB::commit();
            return response_json(true, null,  __('SymCard') . ' ' .  __('saved successfully'), $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }



    public function update(Request $request, SymCard $sym_card)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $sym_card->update($request->all());

            if ($request->hasFile('sym_card_image')) {
                $file_name = $sym_card->title . '-' . uniqid() . '.' . $request->file('sym_card_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sym_card/sym_card_image', $request->file('sym_card_image'), $file_name
                );
                $sym_card->sym_card_image = $file_name;
            }

            $data = SymCard::on('mysqlEng')->where('id', $sym_card->id)->update([
                'title'          => $request->input('title_en'),
                'description'    => $request->input('description_en'),
                'sym_card_image' => $sym_card->sym_card_image,
            ]);

            $sym_card->save();

            log_activity(
                'Ubah SymCard ' . $sym_card->title,
                $sym_card
            );


            DB::commit();
            return response_json(true, null,  __('SymCard') . ' ' .  __('saved successfully'), $sym_card);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    

    public function destroy(SymCard $sym_card)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus SymCard ' . $sym_card->title,
                $sym_card
            );
            
            $data_en = SymCard::on('mysqlEng')->where('id', $sym_card->id)->delete();
            $sym_card->delete();

            DB::commit();
            return response_json(true, null, __('SymCard') . ' ' . __('Deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(),  __('Delete data failed, try again later.'));
        }
    }

    

    public function data(SymCard $sym_card)
    {
        $data = SymCard::on('mysqlEng')->where('id', $sym_card->id)->firstOrFail();
        $sym_card->title_en = $data->title;
        $sym_card->description_en = $data->description;
        $sym_card->url_sym_card_image = get_file_url('public', 'app/public/sym_card/sym_card_image/' . $sym_card->sym_card_image);
        return response_json(true, null, 'Data retrieved', $sym_card);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'title' => 'bail|required',
            'description' => 'bail|required',
            'sym_card_image' => 'bail|nullable',
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
            $query = SymCard::query();
        } else{
            $query = SymCard::on('mysqlEng');
        }

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('title', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('page_name', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $data_id = Product::find($item->id);
            $item->slug = $data_id->slug;
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            if ($item->publish_status) {
                $item->publish_status = "Publish";
            } else {
                $item->publish_status = "Unpublish";
            }
            $item->sym_card_image = get_file_url('public', 'app/public/sym_card/sym_card_image/' . $item->sym_card_image);
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
