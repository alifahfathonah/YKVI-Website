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
    }

    public function breadcrumbs()
    {
        return [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('user.index'), 'text' => __('Manage User')],
            ['href' => route('user.index'), 'text' => __('User')],
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
                "text" => __('User'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'name',
            ],
            [
                "text" => __('Email Address'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'email',
            ],
            [
                "text" => __('Phone Number'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'telepon',
            ],
            [
                "text" => __('Last Change'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('manageuser::user.index')
             ->with('page_title', __('User'))
             ->with('breadcrumbs', $this->breadcrumbs())
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs[] = ['href' => route('user.create'), 'text' => __('Add') . ' ' . __('User')];

        return view('manageuser::user.create')
             ->with('page_title', __('Add') . ' ' . __('User'))
             ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return Renderable
     */
    public function edit(User $user)
    {
        $breadcrumbs[] = ['href' => route('user.edit', [ $user->slug ]), 'text' => __('Edit') . ' ' . __('User') . ' ' . $user->name];

        return view('manageuser::user.edit')
             ->with('data', $user)
             ->with('page_title', __('Edit') . ' ' . __('User') . ' ' . $user->name)
             ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return Renderable
     */
    public function changePasswordForm()
    {
        $breadcrumbs[] = ['href' => route('change-password.form'), 'text' => __('Change Password')];
        return view('manageuser::user.change_password')
             ->with('page_title', __('Change Password') . ' ' . \Auth::user()->name)
             ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }
}
