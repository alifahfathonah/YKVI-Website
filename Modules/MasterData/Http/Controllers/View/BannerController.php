<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Banner;

class BannerController extends Controller
{
    /**
     * BannerController constructor.
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
            ['href' => route('banner.index'), 'text' => __('Master Data')],
            ['href' => route('banner.index'), 'text' => __('Banner')],
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
                "text" => __('Images'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'banner_image',
            ],
            [
                "text" => __('Page Name'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'page_name',
            ],
            [
                "text" => __('Banner Title'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'banner_title',
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
        return view('masterdata::banner.index')
            ->with('page_title', __('Banner'))
            ->with('breadcrumbs', $this->breadcrumbs())
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs[] = ['href' => route('banner.create'), 'text' => __('Add') . ' ' . __('Banner')];

        return view('masterdata::banner.create')
            ->with('page_title', __('Add') . ' ' . __('Banner'))
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }



    public function edit(Banner $banner)
    {
        $breadcrumbs[] = ['href' => route('banner.edit', [ $banner->slug ]), 'text' => __('Edit') . ' ' . __('Banner') . ' ' . $banner->banner_title];

        return view('masterdata::banner.edit')
            ->with('data', $banner)
            ->with('page_title', __('Edit') . ' ' . __('Banner') . ' ' . $banner->banner_title)
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }
}
