<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Faq;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
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
            $data = Faq::create($request->all());

            if ($request->publish_status) {
                $data->publish_status = 1;
                $publish_status = 1;
            } else {
                $data->publish_status = 0;
                $publish_status = 0;
            }

            $request->merge([
                'question'       => $request->input('question_en'),
                'answer'         => $request->input('answer_en'),
                'publish_status' => $publish_status,
            ]);

            $data_en = Faq::on('mysqlEng')->create($request->all());
            $data->save();

            log_activity(
                'Tambah FAQ ' . $data->menu,
                $data
            );

            DB::commit();
            return response_json(true, null, 'Faq ' . __('saved successfully'), $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Faq $faq
     * @return Renderable
     */
    public function update(Request $request, Faq $faq)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $faq->update($request->all());

            if ($request->publish_status) {
                $faq->publish_status = 1;
            } else {
                $faq->publish_status = 0;
            }

            $data = Faq::on('mysqlEng')->where('id', $faq->id)->update([
                'question'       => $request->input('question_en'),
                'answer'         => $request->input('answer_en'),
                'publish_status' => $faq->publish_status
            ]);

            $faq->save();

            log_activity(
                'Ubah FAQ ' . $faq->menu,
                $faq
            );
            
            DB::commit();
            return response_json(true, null, 'Faq ' . __('saved successfully'), $faq);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Faq $faq
     * @return Renderable
     */
    public function destroy(Faq $faq)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus FAQ ' . $faq->menu,
                $faq
            );

            $data_en = Faq::on('mysqlEng')->where('id', $faq->id)->delete();
            $faq->delete();
            DB::commit();
            return response_json(true, null, 'Faq ' . __('Deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Delete data failed, try again later.'));
        }
    }

    /**
     * Get the specified resource from storage.
     * @param Faq $faq
     * @return Renderable
     */
    public function data(Faq $faq)
    {
        $data = Faq::on('mysqlEng')->where('id', $faq->id)->firstOrFail();
        $faq->question_en = $data->question;
        $faq->answer_en = $data->answer;

        return response_json(true, null, 'Data retrieved', $faq);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'question' => 'bail|required|string|max:190',
            'answer' => 'bail|required'
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
            $query = Faq::query();
        } else{
            $query = Faq::on('mysqlEng');
        }

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->orWhere('pertanyaan', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $data_id = Faq::find($item->id);
            $item->slug = $data_id->slug;
            if ($item->publish_status) {
                $item->publish_status = "Publish";
            } else {
                $item->publish_status = "Unpublish";
            }
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
