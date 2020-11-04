<?php

namespace Modules\Api\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\MasterData\Entities\ELearning;

class ELearningController extends Controller
{
    public function index()
    {
        $data = ELearning::latest()->first();
        $data->description = strip_tags($data->description);

        return response_json(true, null, 'Data retrieved.', $data);
    }
}
