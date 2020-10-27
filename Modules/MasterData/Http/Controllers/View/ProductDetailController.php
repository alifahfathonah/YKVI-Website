<?php

namespace Modules\MasterData\Http\Controllers\View;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\ProductDetail;
use Modules\MasterData\Http\Controllers\Helper\ProductHelper;

class ProductDetailController extends Controller
{
     
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->breadcrumbs = [
            ['href' => url('/'), 'text' => 'mdi-home'],
            ['href' => route('product-details.index'), 'text' => 'Master Data'],
            ['href' => route('product-details.index'), 'text' => 'Product Details'],
        ];

        $this->helper = new ProductHelper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table_headers = [
            [
                "text" => 'Gambar Produk',
                "align" => 'center',
                "sortable" => false,
                "value" => 'product_image',
            ],
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
        return view('masterdata::product_details.index')
            ->with('page_title', 'Product Details')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('table_headers', $table_headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->breadcrumbs[] = ['href' => route('product-details.create'), 'text' => 'Tambah Product Details'];

        return view('masterdata::product_details.create')
            ->with('page_title', 'Tambah Product Details')
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }



    public function edit(ProductDetail $product_detail)
    {
        $this->breadcrumbs[] = ['href' => route('product-details.edit', [ $product_detail->slug ]), 'text' => 'Ubah Detail Product ' . $product_detail->product->name];

        return view('masterdata::product_details.edit')
            ->with('data', $product_detail)
            ->with('page_title', 'Ubah Detail Product ' . $product_detail->product->name)
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with($this->helper->getHelper());
    }
}
