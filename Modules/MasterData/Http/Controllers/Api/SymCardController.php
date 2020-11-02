<?php

namespace Modules\MasterData\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\SymCard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SymCardController extends Controller
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
            $data = SymCard::create($request->all());

            if ($request->hasFile('sym_card_image')) {
                $file_name = $data->title .'-'. uniqid() . '.' . $request->file('sym_card_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sym_card/sym_card_image', $request->file('sym_card_image'), $file_name
                );
                $data->sym_card_image = $file_name;
            }

            $data->save();

            log_activity(
                'Tambah SymCards ' . $data->title,
                $data
            );

            DB::commit();
            return response_json(true, null, 'SymCards berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }



    public function update(Request $request, SymCard $sym_card)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $sym_card->update($request->all());

            if ($request->hasFile('sym_card_image')) {
                $file_name = $sym_card->title . '-' . uniqid() . '.' . $request->file('sym_card_image')->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('sym_card/sym_card_image', $request->file('sym_card_image'), $file_name
                );
                $sym_card->sym_card_image = $file_name;

            }

            $sym_card->save();

            log_activity(
                'Ubah SymCards ' . $sym_card->title,
                $sym_card
            );


            DB::commit();
            return response_json(true, null, 'SymCards berhasil disimpan.', $sym_card);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function destroy(SymCard $sym_card)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus SymCards ' . $sym_card->title,
                $sym_card
            );
            
            $sym_card->delete();
            DB::commit();
            return response_json(true, null, 'SymCards property dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    

    public function data(SymCard $sym_card)
    {
        $sym_card->url_sym_card_image = get_file_url('public', 'app/public/sym_card/sym_card_image/' . $sym_card->sym_card_image);
        return response_json(true, null, 'Data retrieved', $sym_card);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            'title' => 'bail|required',
            'description' => 'bail|required',
            'sym_card_image' => 'bail|required',
            'link_embed_youtube' => 'bail|required',
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

        $query = SymCard::query();

        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('title', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('page_name', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
            $item->last_update = $item->updated_at->timezone(config('core.app_timezone', 'UTC'))->locale('id')->translatedFormat('d F Y H:i');
            if ($item->publish_status) {
                $item->publish_status = "Publish";
            } else {
                $item->publish_status = "Unpublish";
            }
            $item->sym_card_image = get_file_url('public', 'app/public/sym_card/sym_card_image/' . $item->sym_card_image);
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
