<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Banner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
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
            $data = Banner::create($request->all());

            if ($request->publish_status) {
                $data->publish_status = 1;
                $publish_status = 1;
            } else {
                $data->publish_status = 0;
                $publish_status = 0;
            }

            if ($request->hasFile('banner_image')) {
                $file_name = $data->banner_title .'-'. uniqid() . '.' . $request->file('banner_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('banner/banner_image', $request->file('banner_image'), $file_name
                );
                $data->banner_image = $file_name;
            } else {
                $file_name = "";
            }

            $request->merge([
                'banner_title'   => $request->input('banner_title_en'),
                'publish_status' => $publish_status,
            ]);

            $data_en = Banner::on('mysqlEng')->create($request->all());
            $data_en->banner_image = $data->banner_image;

            $data->save();
            $data_en->save();

            log_activity(
                'Tambah banner ' . $data->banner_title,
                $data
            );

            DB::commit();
            return response_json(true, null,  __('Banner') . ' '. __('saved successfully'), $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }



    public function update(Request $request, Banner $banner)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $banner->update($request->all());

            if ($request->hasFile('banner_image')) {
                $file_name = $banner->banner_title . '-' . uniqid() . '.' . $request->file('banner_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('banner/banner_image', $request->file('banner_image'), $file_name
                );
                $banner->banner_image = $file_name;
            }

            if ($request->publish_status) {
                $banner->publish_status = 1;
            } else {
                $banner->publish_status = 0;
            }

            $data = Banner::on('mysqlEng')->where('id', $banner->id)->update([
                'page_name'      => $request->input('page_name'),
                'banner_title'   => $request->input('banner_title_en'),
                'banner_image'   => $banner->banner_image,
                'publish_status' => $banner->publish_status
            ]);

            $banner->save();

            log_activity(
                'Ubah banner ' . $banner->banner_title,
                $banner
            );


            DB::commit();
            return response_json(true, null, __('Banner') . ' '. __('saved successfully'), $banner);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    

    public function destroy(Banner $banner)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus banner ' . $banner->banner_title,
                $banner
            );
            
            $data_en = Banner::on('mysqlEng')->where('id', $banner->id)->delete();
            $banner->delete();
            DB::commit();
            return response_json(true, null, __('Banner') . ' ' . __('Deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Delete data failed, try again later.'));
        }
    }

    

    public function data(Banner $banner)
    {
        $data = Banner::on('mysqlEng')->where('id', $banner->id)->firstOrFail();
        $banner->banner_title_en = $data->banner_title;
        $banner->url_banner_image = get_file_url('public', 'app/public/banner/banner_image/' . $banner->banner_image);
        return response_json(true, null, 'Data retrieved', $banner);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'page_name' => 'bail|required',
            'banner_title' => 'bail|required',
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
            $query = Banner::query();
        } else{
            $query = Banner::on('mysqlEng');
        }

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('banner_title', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('page_name', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $data_id = Banner::find($item->id);
            $item->slug = $data_id->slug;
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            if ($item->publish_status) {
                $item->publish_status = "Publish";
            } else {
                $item->publish_status = "Unpublish";
            }
            $item->banner_image = get_file_url('public', 'app/public/banner/banner_image/' . $item->banner_image);
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
