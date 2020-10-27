<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\ProductDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductDetailController extends Controller
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
            $data = ProductDetail::create($request->all());

            if ($request->hasFile('product_image')) {
                $file_name = $data->product->name .'-'. uniqid() . '.' . $request->file('product_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('product/product_image', $request->file('product_image'), $file_name
                );
                $data->product_image = $file_name;

            }
            $data->save();

            log_activity(
                'Tambah Detail Product ' . $data->product->name,
                $data
            );

            DB::commit();
            return response_json(true, null, 'Product Detail berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }



    public function update(Request $request, ProductDetail $product_detail)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $product_detail->update($request->all());

            if ($request->hasFile('product_image')) {
                $file_name = $product_detail->product->name . '-' . uniqid() . '.' . $request->file('product_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('product/product_image', $request->file('product_image'), $file_name
                );
                $product_detail->product_image = $file_name;

            }

            $product_detail->save();

            log_activity(
                'Ubah Detail Product ' . $product_detail->product->name,
                $product_detail
            );


            DB::commit();
            return response_json(true, null, 'Product Detail berhasil disimpan.', $product_detail);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function destroy(ProductDetail $product_detail)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus Detail Product' . $product_detail->product->name,
                $product_detail
            );
            
            $product_detail->delete();
            DB::commit();
            return response_json(true, null, 'Gambar produk berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function data(ProductDetail $product_detail)
    {
        $product_detail->url_product_image = get_file_url('public', 'app/public/product/product_image/' . $product_detail->product_image);
        return response_json(true, null, 'Data retrieved', $product_detail);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'product_id' => 'bail|required',
            'product_image' => 'bail|required',
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

        $query = ProductDetail::query();

        if ($request->has('search') && $request->input('search')) {
            $query->whereHas('product', function($subquery) use ($request) {
                $subquery->where('name', 'LIKE', '%' . $request->input('search') . '%');
            });

            $query->orWhere(function($subquery) use ($request) {
                $subquery->orWhere('updated_at', 'LIKE', '%' . $request->input('search') . '%');
            });

        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->name = $item->product->name;
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            $item->product_image = get_file_url('public', 'app/public/product/product_image/' . $item->product_image);
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
