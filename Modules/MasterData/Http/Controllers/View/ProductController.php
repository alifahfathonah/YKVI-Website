<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Product;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('product.index'), 'text' => 'Master Data'],
            ['href' => route('product.index'), 'text' => 'Product'],
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
                "text" => 'Nama Produk',
                "align" => 'center',
                "sortable" => false,
                "value" => 'name',
            ],
            [
                "text" => 'Terakhir Diubah',
                "align" => 'center',
                "sortable" => false,
                "value" => 'last_update',
            ]
           
        ];
        return view('masterdata::product.index')
             ->with('page_title', 'Product')
             ->with('breadcrumbs', $this->breadcrumbs)
             ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('product.create'), 'text' => 'Tambah Product'];

        return view('masterdata::product.create')
            ->with('page_title', 'Tambah Product')
            ->with('breadcrumbs', $this->breadcrumbs);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Product $product
     * @return Renderable
     */
    public function edit(Product $product)
    {
        $this->breadcrumbs[] = ['href' => route('product.edit', [ $product->slug ]), 'text' => 'Ubah Product ' . $product->name];

        return view('masterdata::product.edit')
            ->with('data', $product)
            ->with('page_title', 'Ubah Product ' . $product->name)
            ->with('breadcrumbs', $this->breadcrumbs);
    }
}
