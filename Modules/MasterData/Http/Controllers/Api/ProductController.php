<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Product;
use Modules\MasterData\Entities\ProductDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
            $data = Product::create($request->all());

            // Product Details
            if ($request->hasFile('product_image')) {
                foreach ($request->file('product_image') ?? [] as $key => $file) {
                    $file_name = $request->name . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('product/product_image', $file, $file_name);
                    $product_detail = ProductDetail::Create([
                        'product_id'    => $data->id,
                        'product_image' => $file_name,
                    ]);
                    // Product Detail English
                    $product_detail_en = ProductDetail::on('mysqlEng')->Create([
                        'product_id'    => $data->id,
                        'product_image' => $file_name,
                    ]);
                    
                }
            }

            $request->merge([
                'name' => $request->input('name_en'),
                'description' => $request->input('description_en'),
                'detail' => $request->input('detail_en'),
            ]);

            $data_en = Product::on('mysqlEng')->create($request->all());

            $data->save();

            log_activity(
                'Tambah Product ' . $data->name,
                $data
            );

            DB::commit();
            return response_json(true, null, __('Product') . ' ' .  __('saved successfully'), $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Product $product
     * @return Renderable
     */
    public function update(Request $request, Product $product)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {

            $product->update($request->all());

            // Product Details
            if ($request->hasFile('product_image')) {
                foreach ($request->file('product_image') ?? [] as $key => $file) {
                    $file_name = $request->name . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('product/product_image', $file, $file_name);
                    $product_detail = ProductDetail::Create([
                        'product_id'    => $product->id,
                        'product_image' => $file_name,
                    ]);

                    $product_detail_en = ProductDetail::on('mysqlEng')->Create([
                        'product_id'    => $product->id,
                        'product_image' => $file_name,
                    ]);
                }
            }

            $data_en = Product::on('mysqlEng')->where('id', $product->id)->update([
                'name' => $request->name_en,
                'description' => $request->description_en,
                'detail' => $request->detail_en,
                'category_id' => $product->category_id,
            ]);

            $product->save();

            log_activity(
                'Ubah Product ' . $product->name,
                $product
            );
            
            DB::commit();
            return response_json(true, null,  __('Product') . ' ' .  __('saved successfully'), $product);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Save data failed, try again later.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return Renderable
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus Product ' . $product->name,
                $product
            );

            $data_en = Product::on('mysqlEng')->where('id', $product->id)->delete();
            $product->delete();
            DB::commit();
            return response_json(true, null, __('Product') . ' ' .  __('Deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), __('Delete data failed, try again later.'));
        }
    }

    /**
     * Get the specified resource from storage.
     * @param Product $product
     * @return Renderable
     */
    public function data(Product $product)
    {
        $data = Product::on('mysqlEng')->where('id', $product->id)->firstOrFail();
        $product->name_en = $data->name;
        $product->description_en = $data->description;
        $product->detail_en = $data->detail;
        $product->product_details = $product->product_details;
        return response_json(true, null, 'Data retrieved', $product);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'name' => 'bail|required|string|max:190',
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

        if (\Session::get('lang') == 'id'){
            $query = Product::query();
        } else{
            $query = Product::on('mysqlEng');
        }
        
        $query->with('product_category');

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->orWhere('name', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $data_id = Product::find($item->id);
            $item->slug = $data_id->slug;
            $item->category = $item->product_category->category_name;
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
