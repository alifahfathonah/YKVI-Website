<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\ELearning;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ELearningController extends Controller
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
            $data = ELearning::create($request->all());

            $request->merge([
                'title' => $request->input('title_en'),
                'description' => $request->input('description_en'),
            ]);

            $data_en = ELearning::on('mysqlEng')->create($request->all());

            $data->save();

            log_activity(
                'Tambah E-Learning ' . $data->title,
                $data
            );

            DB::commit();
            return response_json(true, null, __('E-Learning') . ' ' .  __('saved successfully'), $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param E-Learning $e_learning
     * @return Renderable
     */
    public function update(Request $request, ELearning $e_learning)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $e_learning->update($request->all());
            $e_learning->save();

            $data_en = ELearning::on('mysqlEng')->where('id', $e_learning->id)->update([
                'title' => $request->title_en,
                'description' => $request->description_en,
                'link_url_redirect' => $request->link_url_redirect
            ]);

            log_activity(
                'Ubah E-Learning ' . $e_learning->title,
                $e_learning
            );
            
            DB::commit();
            return response_json(true, null, __('E-Learning') . ' ' .  __('saved successfully'), $e_learning);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param E-Learning $e_learning
     * @return Renderable
     */
    public function destroy(ELearning $e_learning)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus E-Learning ' . $e_learning->title,
                $e_learning
            );

            $e_learning->delete();
            DB::commit();
            return response_json(true, null, __('E-Learning') . ' ' .  __('Deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Delete data failed, try again later.'));
        }
    }

    /**
     * Get the specified resource from storage.
     * @param E-Learning $e_learning
     * @return Renderable
     */
    public function data(ELearning $e_learning)
    {
        $data = ELearning::on('mysqlEng')->where('id', $e_learning->id)->firstOrFail();
        $e_learning->title_en = $data->title;
        $e_learning->description_en = $data->description;
        return response_json(true, null, 'Data retrieved', $e_learning);
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
            'description' => 'bail|required',
            'link_url_redirect' => 'bail|required'
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

        $query = ELearning::query();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->orWhere('title', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
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
