<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Cme;

class CmeController extends Controller
{
    /**
     * CmeController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('cme.index'), 'text' => 'Master Data'],
            ['href' => route('cme.index'), 'text' => 'CME'],
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
                "text" => 'Tipe CME',
                "align" => 'center',
                "sortable" => false,
                "value" => 'type',
            ],
            [
                "text" => 'Judul',
                "align" => 'center',
                "sortable" => false,
                "value" => 'title',
            ],
            [
                "text" => 'Status',
                "align" => 'center',
                "sortable" => false,
                "value" => 'is_home',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
        ];
        return view('masterdata::cme.index')
             ->with('page_title', 'CME')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('cme.create'), 'text' => 'Tambah CME'];

        return view('masterdata::cme.create')
            ->with('page_title', 'Tambah CME')
            ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Cme $cme
     * @return Renderable
     */
    public function edit(Cme $cme)
    {
        $this->breadcrumbs[] = ['href' => route('cme.edit', [ $cme->slug ]), 'text' => 'Ubah CME ' . $cme->title];

        return view('masterdata::cme.edit')
            ->with('data', $cme)
            ->with('page_title', 'Ubah CME ' . $cme->title)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
