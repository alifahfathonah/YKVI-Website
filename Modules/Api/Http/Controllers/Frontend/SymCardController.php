<?php

namespace Modules\Api\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\MasterData\Entities\SymCard;

class SymCardController extends Controller
{
    public function index()
    {
        $data = SymCard::latest()->first();
        $data->description = strip_tags($data->description);
        $data->url_sym_card_image = get_file_url('public', 'app/public/sym_card/sym_card_image/' . $data->sym_card_image);

        return response_json(true, null, 'Data retrieved.', $data);
    }
}
