<?php

namespace Modules\ManageUser\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ManageUser\Entities\User;

class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('user.index'), 'text' => 'Kelola User'],
            ['href' => route('user.index'), 'text' => 'Users'],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'User',
                "align" => 'center',
                "sortable" => false,
                "value" => 'name',
            ],
            [
                "text" => 'Email',
                "align" => 'center',
                "sortable" => false,
                "value" => 'email',
            ],
            [
                "text" => 'Nomor Handphone',
                "align" => 'center',
                "sortable" => false,
                "value" => 'telepon',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('manageuser::user.index')
             ->with('page_title', 'Users')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('user.create'), 'text' => 'Tambah User'];

        return view('manageuser::user.create')
             ->with('page_title', 'Tambah Users')
             ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return Renderable
     */
    public function edit(User $user)
    {
        $this->breadcrumbs[] = ['href' => route('user.edit', [ $user->slug ]), 'text' => 'Ubah User ' . $user->name];

        return view('manageuser::user.edit')
             ->with('data', $user)
             ->with('page_title', 'Ubah User ' . $user->name)
             ->with('breadcrumbs', $this->breadcrumbs);
    }
}
