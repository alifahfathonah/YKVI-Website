<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\ELearning;

class ELearningController extends Controller
{
    /**
     * ELearningController constructor.
     *
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('e-learning.index'), 'text' => 'Master Data'],
            ['href' => route('e-learning.index'), 'text' => 'E-Learning'],
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
                "text" => 'Link URL',
                "align" => 'center',
                "sortable" => false,
                "value" => 'link_url_redirect',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
        ];
        return view('masterdata::e_learning.index')
             ->with('page_title', 'E-Learning')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('e-learning.create'), 'text' => 'Tambah E-Learning'];

        return view('masterdata::e_learning.create')
            ->with('page_title', 'Tambah E-Learning')
            ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for editing the specified resource.
     * @param E-Learning $e_learning
     * @return Renderable
     */
    public function edit(ELearning $e_learning)
    {
        $this->breadcrumbs[] = ['href' => route('e-learning.edit', [ $e_learning->slug ]), 'text' => 'Ubah E-Learning ' . $e_learning->pertanyaan];

        return view('masterdata::e_learning.edit')
            ->with('data', $e_learning)
            ->with('page_title', 'Ubah E-Learning ' . $e_learning->pertanyaan)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
