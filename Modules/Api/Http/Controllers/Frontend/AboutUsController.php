<?php

namespace Modules\Api\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\MasterData\Entities\AboutUs;

class AboutUsController extends Controller
{
    public function index()
    {
        $data = AboutUs::latest()->first();
        if ($data) {
            $data->url_about_us_image = get_file_url('public', 'app/public/about_us/about_us_image/' . $data->about_us_image);
	        return response_json(true, null, 'Data retrieved.', $data);
        } else {
	        return response_json(null, true, 'No data exist.', null);
        }

    }
}
