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
        $this->middleware(['auth']);
    }

    public function breadcrumbs()
    {
        return [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('e-learning.index'), 'text' => __('Master Data')],
            ['href' => route('e-learning.index'), 'text' => __('E-Learning')],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = ELearning::latest()->first() ?? '';
        if ($data) {
            if (\Lang::locale() == 'en'){
                $data_eng = ELearning::on('mysqlEng')->latest()->first() ?? '';
                $data_eng->slug = $data->slug;
                $data = $data_eng;
            }
        }
        return view('masterdata::e_learning.index')
            ->with('page_title', __('E-Learning'))
            ->with('breadcrumbs', $this->breadcrumbs())
            ->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs[] = ['href' => route('e-learning.create'), 'text' => __('Add') . ' ' . __('E-Learning')];

        return view('masterdata::e_learning.create')
            ->with('page_title', __('Add') . ' ' . __('E-Learning'))
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }

    /**
     * Show the form for editing the specified resource.
     * @param E-Learning $e_learning
     * @return Renderable
     */
    public function edit(ELearning $e_learning)
    {
        $breadcrumbs[] = ['href' => route('e-learning.edit', [ $e_learning->slug ]), 'text' =>  __('Edit') . ' ' . __('E-Learning')];

        return view('masterdata::e_learning.edit')
            ->with('data', $e_learning)
            ->with('page_title',  __('Edit') . ' ' . __('E-Learning'))
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }
}
