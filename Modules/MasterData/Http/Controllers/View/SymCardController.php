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
    }

    public function breadcrumbs()
    {
        return [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('sym-card.index'), 'text' => __('Master Data')],
            ['href' => route('sym-card.index'), 'text' => __('SymCard')],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = SymCard::latest()->first();
        if ($data) {
            $data->url_sym_card_image = get_file_url('public', 'app/public/sym_card/sym_card_image/' . $data->sym_card_image);
            if (\Lang::locale() == 'en'){
                $data_eng = SymCard::on('mysqlEng')->latest()->first() ?? '';
                $data_eng->url_sym_card_image = $data->url_sym_card_image;
                $data_eng->sym_card_image = $data->sym_card_image;
                $data_eng->slug = $data->slug;
                $data = $data_eng;
            }
        }

        return view('masterdata::sym_card.index')
            ->with('page_title', __('SymCard'))
            ->with('breadcrumbs', $this->breadcrumbs())
            ->with('data', $data ?? '');

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs[] = ['href' => route('sym-card.create'), 'text' => __('Add') . ' ' . __('SymCard')];

        return view('masterdata::sym_card.create')
            ->with('page_title', __('Add') . ' ' . __('SymCard'))
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }



    public function edit(SymCard $sym_card)
    {
        $breadcrumbs[] = ['href' => route('sym-card.edit', [ $sym_card->slug ]), 'text' => __('Edit') . ' ' . __('SymCard')];

        return view('masterdata::sym_card.edit')
            ->with('data', $sym_card)
            ->with('page_title', __('Edit') . ' ' . __('SymCard'))
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }
}
