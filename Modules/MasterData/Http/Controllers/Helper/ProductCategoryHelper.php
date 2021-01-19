<?php

namespace Modules\MasterData\Http\Controllers\Helper;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterData\Entities\Product;
use Modules\MasterData\Entities\ProductCategory;

class ProductCategoryHelper extends Controller
{
    /**
     *
     * Return Form Helper
     *
     */
    public function getHelper()
    {
        if (\Lang::locale() == 'en'){
            return [
                'product_category' => ProductCategory::on('mysqlEng')->select('id AS value', 'category_name AS text')->get(),
            ];
        } else{
            return [
                'product_category' => ProductCategory::select('id AS value', 'category_name AS text')->get(),
            ];
        }
    }

    /**
     *
     * Handle incoming request for form helper
     *
     */
    public function formHelper()
    {
        try {
            return response_json(true, null, 'Sukses mengambil data.', $this->getHelper());
        } catch (Exception $e) {
            return response_json(false, $e->getMessage() . ' on file ' . $e->getFile() . ' on line number ' . $e->getLine(), 'Terdapat kesalahan saat mengambil data, silahkan dicoba kembali beberapa saat lagi.');
        }
    }
}
