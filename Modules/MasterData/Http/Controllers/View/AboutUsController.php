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
    }

    public function breadcrumbs()
    {
        return [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('about-us.index'), 'text' => __('Master Data')],
            ['href' => route('about-us.index'), 'text' => __('About Us')],
        ];
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = AboutUs::latest()->first() ?? '';
        if ($data) {
            $data->url_about_us_image = get_file_url('public', 'app/public/about_us/about_us_image/' . $data->about_us_image);
            if (\Lang::locale() == 'en'){
                $data_eng = AboutUs::on('mysqlEng')->latest()->first() ?? '';
                $data_eng->url_about_us_image = $data->url_about_us_image;
                $data_eng->about_us_image = $data->about_us_image;
                $data_eng->slug = $data->slug;
                $data = $data_eng;
            }
        }

        return view('masterdata::about_us.index')
            ->with('page_title', __('About Us'))
            ->with('breadcrumbs', $this->breadcrumbs())
            ->with('data', $data ?? '');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs[] = ['href' => route('about-us.create'), 'text' => __('Add') . ' ' . __('About Us')];

        return view('masterdata::about_us.create')
            ->with('page_title', __('Add') . ' '. __('About Us'))
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }

    /**
     * Show the form for editing the specified resource.
     * @param About Us $about_us
     * @return Renderable
     */
    public function edit(AboutUs $about_u)
    {
        $breadcrumbs[] = ['href' => route('about-us.edit', [ $about_u->slug ]), 'text' => __('Edit') . ' ' . __('About Us')];
        return view('masterdata::about_us.edit')
            ->with('data', $about_u)
            ->with('page_title', __('Edit') . ' '. __('About Us'))
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }
}
