<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Faq;
use Modules\MasterData\Http\Controllers\Helper\FaqHelper;

class FaqController extends Controller
{
    /**
     * FaqController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->helper = new FaqHelper;
    }

    public function breadcrumbs()
    {
        return [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('faq.index'), 'text' =>  __('Master Data')],
            ['href' => route('faq.index'), 'text' =>  __('FAQ E-Learning')],
        ];
    }

    /**.
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" =>  __('Question'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'question',
            ],
            [
                "text" => __('Publish Status'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'publish_status',
            ],
            [
                "text" => __('Last Change'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('masterdata::faq.index')
             ->with('page_title',  __('FAQ E-Learning'))
             ->with('breadcrumbs', $this->breadcrumbs())
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs[] = ['href' => route('faq.create'), 'text' => __('Add') . ' Faq'];

        return view('masterdata::faq.create')
            ->with('page_title', __('Add') . ' Faq')
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs))
            ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param Faq $faq
     * @return Renderable
     */
    public function edit(Faq $faq)
    {
        $breadcrumbs[] = ['href' => route('faq.edit', [ $faq->slug ]), 'text' => __('Edit') . ' Faq'];

        return view('masterdata::faq.edit')
            ->with('data', $faq)
            ->with('page_title', __('Edit') . ' Faq')
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs))
            ->with($this->helper->getHelper());
    }
}
