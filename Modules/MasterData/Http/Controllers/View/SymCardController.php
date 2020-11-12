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
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('sym-card.index'), 'text' => 'Master Data'],
            ['href' => route('sym-card.index'), 'text' => 'SymCard'],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = SymCard::first();
        if ($data) {
            $data->url_sym_card_image = get_file_url('public', 'app/public/sym_card/sym_card_image/' . $data->sym_card_image);
        }

        return view('masterdata::sym_card.index')
            ->with('page_title', 'SymCard')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('data', $data ?? '');

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('sym-card.create'), 'text' => 'Tambah SymCard'];

        return view('masterdata::sym_card.create')
            ->with('page_title', 'Tambah SymCard')
            ->with('breadcrumbs', $this->breadcrumbs);
    }



    public function edit(SymCard $sym_card)
    {
        $this->breadcrumbs[] = ['href' => route('sym-card.edit', [ $sym_card->slug ]), 'text' => 'Ubah SymCard'];

        return view('masterdata::sym_card.edit')
            ->with('data', $sym_card)
            ->with('page_title', 'Ubah SymCard')
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
