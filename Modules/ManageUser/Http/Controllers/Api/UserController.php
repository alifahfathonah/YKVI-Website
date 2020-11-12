<?php

namespace Modules\ManageUser\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Rules\SignedPhoneNumber;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
            $data = User::create($request->all());
            log_activity(
                'Tambah user ' . $data->name,
                $data
            );
            DB::commit();
            return response_json(true, null, 'User berhasil disimpan.', $data);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param User $user
     * @return Renderable
     */
    public function update(Request $request, User $user)
    {
        $validator = $this->validateFormRequest($request, $user->id);

        if ($validator->fails()) {
            return response_json(false, $validator->errors(), $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            log_activity(
                'Update user ' . $user->name,
                $user
            );
            $user->update($request->all());
            DB::commit();
            return response_json(true, null, 'User berhasil disimpan.', $user);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return Renderable
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Hapus user ' . $user->name,
                $user
            );
            $user->delete();
            DB::commit();
            return response_json(true, null, 'User berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menghapus data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }

    /**
     * Get the specified resource from storage.
     * @param User $user
     * @return Renderable
     */
    public function data(User $user)
    {
        return response_json(true, null, 'Data retrieved', $user);
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validateFormRequest($request, $id = null)
    {
        return Validator::make($request->all(), [
            'name' => 'bail|required',
            'email' => [
                'bail', 
                'required', 
                'email', 
                Rule::unique('\Modules\ManageUser\Entities\User', 'email')
                    ->ignore($id)
            ],
            'telepon' => [
                'bail', 
                'required', 
                new SignedPhoneNumber, 
                Rule::unique('\Modules\ManageUser\Entities\User', 'telepon')
                    ->ignore($id)
            ],
            'password' => 'bail|sometimes|confirmed|min:8'
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

        $query = User::query();
        $query->orderBy('created_at', 'DESC');
        
        if ($request->has('search') && $request->input('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('name', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                $subquery->orWhere('telepon', 'LIKE', '%' . $request->input('search') . '%');
            });
        }
        
        $data = $query->orderBy('created_at', 'desc')
                    ->paginate($request->input('paginate') ?? 10);

        $data->getCollection()->transform(function($item) {
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param User $user
     * @return Renderable
     */
    public function changePassword(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            log_activity(
                'Change password user ' . $user->name,
                $user
            );
            $user->update($request->all());
            DB::commit();
            return response_json(true, null, 'Perubahan Password telah berhasil dilakukan.', $user);
        } catch (\Exception $e) {
            DB::rollback();
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat menyimpan data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }
}
