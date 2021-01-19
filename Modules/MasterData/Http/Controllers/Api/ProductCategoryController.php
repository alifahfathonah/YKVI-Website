<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Product;
use Modules\MasterData\Entities\ProductCategory;
use Modules\MasterData\Entities\ProductDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
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
            $data = ProductCategory::create($request->all());

            $request->merge([
                'category_name' => $request->input('category_name_en'),
            ]);

            $data_en = ProductCategory::on('mysqlEng')->create($request->all());

            $data->save();

            log_activity(
                'Tambah Product Category ' . $data->category_name,
                $data
            );

            DB::commit();
            return response_json(true, null, __('Product Category') . ' ' .  __('saved successfully'), $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param ProductCategory $product_category
     * @return Renderable
     */
    public function update(Request $request, ProductCategory $product_category)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $product_category->update($request->all());

            $data_en = ProductCategory::on('mysqlEng')->where('id', $product_category->id)->update([
                'category_name' => $request->category_name_en,
            ]);

            $product_category->save();

            log_activity(
                'Ubah Product Category ' . $product_category->category_name,
                $product_category
            );
            
            DB::commit();
            return response_json(true, null,  __('Product Category') . ' ' .  __('saved successfully'), $product_category);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param ProductCategory $product_category
     * @return Renderable
     */
    public function destroy(ProductCategory $product_category)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus Product Category ' . $product_category->category_name,
                $product_category
            );

            $data_en = ProductCategory::on('mysqlEng')->where('id', $product_category->id)->delete();
            $product_category->delete();
            DB::commit();
            return response_json(true, null, __('Product Category') . ' ' .  __('Deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Delete data failed, try again later.'));
        }
    }

    /**
     * Get the specified resource from storage.
     * @param ProductCategory $product_category
     * @return Renderable
     */
    public function data(ProductCategory $product_category)
    {
        $data = ProductCategory::on('mysqlEng')->where('id', $product_category->id)->firstOrFail();
        $product_category->category_name_en = $data->category_name;
        return response_json(true, null, 'Data retrieved', $product_category);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'category_name' => 'bail|required|string',
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
            $query = ProductCategory::query();
        } else{
            $query = ProductCategory::on('mysqlEng');
        }

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->orWhere('category_name', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $data_id = ProductCategory::find($item->id);
            $item->slug = $data_id->slug;
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
