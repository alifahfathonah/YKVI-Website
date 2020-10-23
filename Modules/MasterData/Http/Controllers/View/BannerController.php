<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Banner;

class BannerController extends Controller
{
     
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('banner.index'), 'text' => 'Master Data'],
            ['href' => route('banner.index'), 'text' => 'Banner'],
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
                "text" => 'Gambar Banner',
                "align" => 'center',
                "sortable" => false,
                "value" => 'banner_image',
            ],
            [
                "text" => 'Nama Halaman',
                "align" => 'center',
                "sortable" => false,
                "value" => 'page_name',
            ],
            [
                "text" => 'Judul Banner',
                "align" => 'center',
                "sortable" => false,
                "value" => 'banner_title',
            ],
            [
                "text" => 'Publish Status',
                "align" => 'center',
                "sortable" => false,
                "value" => 'publish_status',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('masterdata::banner.index')
            ->with('page_title', 'Banner')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('banner.create'), 'text' => 'Tambah Banner'];

        return view('masterdata::banner.create')
            ->with('page_title', 'Tambah Banner')
            ->with('breadcrumbs', $this->breadcrumbs);
    }



    public function edit(Banner $banner)
    {
        $this->breadcrumbs[] = ['href' => route('banner.edit', [ $banner->slug ]), 'text' => 'Ubah Banner ' . $banner->banner_title];

        return view('masterdata::banner.edit')
            ->with('data', $banner)
            ->with('page_title', 'Ubah Banner ' . $banner->banner_title)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
