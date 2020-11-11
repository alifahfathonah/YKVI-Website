<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\AboutUs;

class AboutUsController extends Controller
{
    /**
     * AboutUsController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('about-us.index'), 'text' => 'Master Data'],
            ['href' => route('about-us.index'), 'text' => 'About Us'],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = AboutUs::first();
        if ($data) {
            $data->url_about_us_image = get_file_url('public', 'app/public/about_us/about_us_image/' . $data->about_us_image);
        }

        return view('masterdata::about_us.index')
            ->with('page_title', 'About Us')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('data', $data ?? '');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('about-us.create'), 'text' => 'Tambah About Us'];

        return view('masterdata::about_us.create')
            ->with('page_title', 'Tambah About Us')
            ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for editing the specified resource.
     * @param About Us $about_us
     * @return Renderable
     */
    public function edit(AboutUs $about_u)
    {
        $this->breadcrumbs[] = ['href' => route('about-us.edit', [ $about_u->slug ]), 'text' => 'Ubah About Us ' . $about_u->title];

        return view('masterdata::about_us.edit')
            ->with('data', $about_u)
            ->with('page_title', 'Ubah About Us ' . $about_u->title)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
