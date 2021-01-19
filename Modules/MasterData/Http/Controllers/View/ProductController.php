<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Product;
use Modules\MasterData\Http\Controllers\Helper\ProductCategoryHelper;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->helper = new ProductCategoryHelper;
    }

    public function breadcrumbs()
    {
        return [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('product.index'), 'text' => __('Master Data')],
            ['href' => route('product.index'), 'text' => __('Product')],
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
                "text" => __('Product Name'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'name',
            ],
            [
                "text" => __('Product Category'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'category',
            ],
            [
                "text" => __('Last Change'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('masterdata::product.index')
             ->with('page_title', __('Product'))
             ->with('breadcrumbs', $this->breadcrumbs())
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs[] = ['href' => route('product.create'), 'text' => __('Add') . ' ' . __('Product')];

        return view('masterdata::product.create')
            ->with('page_title', __('Add') . ' ' . __('Product'))
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs))
            ->with($this->helper->getHelper());
    }

    /**
     * Show the form for editing the specified resource.
     * @param Product $product
     * @return Renderable
     */
    public function edit(Product $product)
    {
        $breadcrumbs[] = ['href' => route('product.edit', [ $product->slug ]), 'text' => __('Edit') . ' ' . __('Product') . ' ' . $product->name];

        return view('masterdata::product.edit')
            ->with('data', $product)
            ->with('page_title', __('Edit') . ' ' . __('Product') . ' ' . $product->name)
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs))
            ->with($this->helper->getHelper());
    }
}
