<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\SymCard;

class SymCardController extends Controller
{
     
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('sym-card.index'), 'text' => 'Master Data'],
            ['href' => route('sym-card.index'), 'text' => 'SymCards'],
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
                "text" => 'Judul',
                "align" => 'center',
                "sortable" => false,
                "value" => 'title',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('masterdata::sym_card.index')
            ->with('page_title', 'SymCards')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('sym-card.create'), 'text' => 'Tambah SymCards'];

        return view('masterdata::sym_card.create')
            ->with('page_title', 'Tambah SymCards')
            ->with('breadcrumbs', $this->breadcrumbs);
    }



    public function edit(SymCard $sym_card)
    {
        $this->breadcrumbs[] = ['href' => route('sym-card.edit', [ $sym_card->slug ]), 'text' => 'Ubah SymCards ' . $sym_card->title];

        return view('masterdata::sym_card.edit')
            ->with('data', $sym_card)
            ->with('page_title', 'Ubah SymCards ' . $sym_card->title)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
