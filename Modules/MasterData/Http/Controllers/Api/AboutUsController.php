<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\AboutUs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
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
            $data = AboutUs::create($request->all());

            if ($request->hasFile('about_us_image')) {
                $file_name = $data->title .'-'. uniqid() . '.' . $request->file('about_us_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('about_us/about_us_image', $request->file('about_us_image'), $file_name
                );
                $data->about_us_image = $file_name;
            } else {
                $file_name = "";
            }

            $request->merge([
                'title' => $request->input('title_en'),
                'description' => $request->input('description_en'),
            ]);

            $data_en = AboutUs::on('mysqlEng')->create($request->all());
            $data_en->about_us_image = $data->about_us_image;

            $data->save();
            $data_en->save();

            DB::commit();
            return response_json(true, null, 'Data '. __('About us') . ' ' . __('saved successfully'), $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param About Us $about_us
     * @return Renderable
     */
    public function update(Request $request, AboutUs $about_u)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $about_u->update($request->all());

            if ($request->hasFile('about_us_image')) {
                $file_name = $request->title . '-' . uniqid() . '.' . $request->file('about_us_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('about_us/about_us_image', $request->file('about_us_image'), $file_name
                );
                $about_u->about_us_image = $file_name;
            }

            $data = AboutUs::on('mysqlEng')->where('id', $about_u->id)->update([
                'title' => $request->input('title_en'),
                'description' => $request->input('description_en'),
                'about_us_image' => $about_u->about_us_image
            ]);

            $about_u->save();
            
            DB::commit();
            return response_json(true, null, 'Data '. __('About Us') . ' '. __('saved successfully'), $about_u);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param About Us $about_us
     * @return Renderable
     */
    public function destroy(AboutUs $about_us)
    {
        DB::beginTransaction();
        try {
            $about_us->delete();
            DB::commit();
            return response_json(true, null, 'Data ' . __('About Us') . ' ' . __('Deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Delete data failed, try again later.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param About Us $about_us
     * @return Renderable
     */
    public function deleteImage(AboutUs $about_us)
    {
        DB::beginTransaction();
        try {
            $about_us->about_us_image = null;
            $about_us->save();

            DB::commit();
            return response_json(true, null, 'Gambar untuk '. __('About Us'). ' berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Get the specified resource from storage.
     * @param About Us $about_us
     * @return Renderable
     */
    public function data(AboutUs $about_us)
    {
        $data = AboutUs::on('mysqlEng')->where('id', $about_us->id)->firstOrFail();
        $about_us->title_en = $data->title;
        $about_us->description_en = $data->description;
        $about_us->url_about_us_image = get_file_url('public', 'app/public/about_us/about_us_image/' . $about_us->about_us_image);

        return response_json(true, null, 'Data retrieved', $about_us);
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

        $query = AboutUs::query();

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
