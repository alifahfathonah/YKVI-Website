<?php

namespace Modules\Api\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\ContactUs\Entities\ContactUs;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Rules\SignedPhoneNumber;
use Illuminate\Validation\Rule;

class ContactUsController extends Controller
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
            $data = ContactUs::create($request->all());
            $data->save();

            DB::commit();
            return response_json(true, null, 'Data berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'name' => 'bail|required|string|max:190',
            'email' => 'bail|required|email',
            'phone_number' => 'bail|required',
            'subject' => 'bail|required',
            'message' => 'bail|required',
        ]);
    }
}
