<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Product;
use Modules\MasterData\Entities\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * ProductController constructor.
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
            ['href' => route('product-category.index'), 'text' => __('Master Data')],
            ['href' => route('product-category.index'), 'text' => __('Product Category')],
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
                "text" => __('Product Category Name'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'category_name',
            ],
            [
                "text" => __('Last Change'),
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('masterdata::product_category.index')
             ->with('page_title', __('Product Category'))
             ->with('breadcrumbs', $this->breadcrumbs())
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs[] = ['href' => route('product-category.create'), 'text' => __('Add') . ' ' . __('Product Category')];

        return view('masterdata::product_category.create')
            ->with('page_title', __('Add') . ' ' . __('Product Category'))
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Product $product_category
     * @return Renderable
     */
    public function edit(ProductCategory $product_category)
    {
        $breadcrumbs[] = ['href' => route('product-category.edit', [ $product_category->slug ]), 'text' => __('Edit') . ' ' . __('Product Category') . ' ' . $product_category->name];

        return view('masterdata::product_category.edit')
            ->with('data', $product_category)
            ->with('page_title', __('Edit') . ' ' . __('Product Category') . ' ' . $product_category->name)
            ->with('breadcrumbs', array_merge($this->breadcrumbs(), $breadcrumbs));
    }
}
