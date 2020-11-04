<?php

namespace Modules\Api\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\MasterData\Entities\Banner;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $validator = $this->validateTableRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }

        $data = Banner::orderBy('created_at', 'desc')->get();

        $data->transform(function($item) {
            $item->url_banner_image = get_file_url('public', 'app/public/banner/banner_image/' . $item->banner_image);
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
