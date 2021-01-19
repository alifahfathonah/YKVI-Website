<?php

namespace Modules\Api\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\MasterData\Entities\Product;
use Modules\MasterData\Entities\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }

        $data = ProductCategory::with('product')->orderBy('created_at', 'desc')->get();

        $data->transform(function($item) {
            foreach($item->product as $product){
                $product->short_description = clean_string($product->description);
            }
            return $item;
        });

        return response_json(true, null, 'Data retrieved.', $data);
    }

    public function indexEng(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }

        $data = ProductCategory::on('mysqlEng')->with('product')->orderBy('created_at', 'desc')->get();

        $data->transform(function($item) {
            foreach($item->product as $product){
                $product->short_description = clean_string($product->description);
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
            "paginate" => "bail|sometimes|required|numeric",
        ]);
    }
}
