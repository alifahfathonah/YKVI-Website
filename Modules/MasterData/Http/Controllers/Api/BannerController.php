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
            } else {
                $data->publish_status = 0;
            }

            if ($request->hasFile('banner_image')) {
                $file_name = $data->banner_title .'-'. uniqid() . '.' . $request->file('banner_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('banner/banner_image', $request->file('banner_image'), $file_name
                );
                $data->banner_image = $file_name;

            }
            $data->save();

            log_activity(
                'Tambah banner ' . $data->banner_title,
                $data
            );

            DB::commit();
            return response_json(true, null, 'Banner berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
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

            $banner->save();

            log_activity(
                'Ubah banner ' . $banner->banner_title,
                $banner
            );


            DB::commit();
            return response_json(true, null, 'Banner berhasil disimpan.', $banner);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
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
            
            $banner->delete();
            DB::commit();
            return response_json(true, null, 'Banner property dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function data(Banner $banner)
    {
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

        $query = Banner::query();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('banner_title', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('page_name', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
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
