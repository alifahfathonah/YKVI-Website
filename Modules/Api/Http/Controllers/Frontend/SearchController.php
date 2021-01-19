<?php

namespace Modules\Api\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\MasterData\Entities\AboutUs;
use Modules\MasterData\Entities\ELearning;
use Modules\MasterData\Entities\Faq;
use Modules\MasterData\Entities\Cme;
use Modules\MasterData\Entities\Product;
use Modules\MasterData\Entities\ProductCategory;
use Modules\MasterData\Entities\SymCard;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }

        if ($request->has('search') && $request->input('search') !== null) {
            $about_us_title = AboutUs::where('title', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Tentang Kami';
                $result['name'] = $item->title;
                $result['url'] = 'http://ykvi.or.id/tentang-kami';
                return collect($result);
            });

             $about_us_description = AboutUs::where('description', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Tentang Kami';
                $result['name'] = clean_string($item->description);
                $result['url'] = 'http://ykvi.or.id/tentang-kami';
                return collect($result);
            });

            $e_learning_title = ELearning::where('title', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Kelas Online';
                $result['name'] = $item->title;
                $result['url'] = 'http://ykvi.or.id/kelas-online';
                return collect($result);
            });

            $e_learning_description = ELearning::where('description', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Kelas Online';
                $result['name'] = clean_string($item->description);
                $result['url'] = 'http://ykvi.or.id/kelas-online';
                return collect($result);
            });

            $faq_question = Faq::where('question', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'FAQ Kelas Online';
                $result['name'] = $item->question;
                $result['url'] = 'http://ykvi.or.id/kelas-online';
                return collect($result);
            });

            $cme_type = Cme::where('type', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'CME';
                $result['name'] = $item->type;
                $result['url'] = 'http://ykvi.or.id/cme';
                return collect($result);
            });

            $cme_title = Cme::where('title', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'CME';
                $result['name'] = $item->title;
                $result['url'] = 'http://ykvi.or.id/cme';
                return collect($result);
            });

            $product_category = ProductCategory::where('category_name', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Produk';
                $result['name'] = $item->category_name;
                $result['url'] = 'http://ykvi.or.id/produk';
                return collect($result);
            });

            $product = Product::where('name', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Produk';
                $result['name'] = $item->name;
                $result['url'] = 'http://ykvi.or.id/produk/'.$item->slug;
                return collect($result);
            });

            $symcard_title = SymCard::where('title', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'SymCard';
                $result['name'] = $item->title;
                $result['url'] = 'http://ykvi.or.id/symcard';
                return collect($result);
            });

            $symcard_description = SymCard::where('description', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'SymCard';
                $result['name'] = clean_string($item->description);
                $result['url'] = 'http://ykvi.or.id/symcard';
                return collect($result);
            });

            $data = collect($about_us_title ?? [])
                    ->merge($about_us_description ?? [])
                    ->merge($e_learning_title ?? [])
                    ->merge($e_learning_description ?? [])
                    ->merge($faq_question ?? [])
                    ->merge($cme_title ?? [])
                    ->merge($cme_type ?? [])
                    ->merge($product_category ?? [])
                    ->merge($product ?? [])
                    ->merge($symcard_title ?? [])
                    ->merge($symcard_description ?? []);

            $data = collect($data)->take(20)->all();

            if ($data == '[]'){
                return response_json(true, null, 'Data retrieved.', $data);
            } else {
                return response_json(false, 'Get data failed.', 'Data tidak ditemukan');
            }
        } else {
            return response_json(false, 'Get data failed.', 'Data tidak ditemukan');
        }
    }

    public function indexEng(Request $request)
    {
        $validator = $this->validateFormRequest($request);

        if ($validator->fails()) {
            return response_json(false, 'Get data failed.', $validator->errors()->first());
        }

        if ($request->has('search') && $request->input('search') !== null) {
            $about_us_title = AboutUs::on('mysqlEng')->where('title', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Tentang Kami';
                $result['name'] = $item->title;
                $result['url'] = 'http://ykvi.or.id/tentang-kami';
                return collect($result);
            });

             $about_us_description = AboutUs::on('mysqlEng')->where('description', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Tentang Kami';
                $result['name'] = clean_string($item->description);
                $result['url'] = 'http://ykvi.or.id/tentang-kami';
                return collect($result);
            });

            $e_learning_title = ELearning::on('mysqlEng')->where('title', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Kelas Online';
                $result['name'] = $item->title;
                $result['url'] = 'http://ykvi.or.id/kelas-online';
                return collect($result);
            });

            $e_learning_description = ELearning::on('mysqlEng')->where('description', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Kelas Online';
                $result['name'] = clean_string($item->description);
                $result['url'] = 'http://ykvi.or.id/kelas-online';
                return collect($result);
            });

            $faq_question = Faq::on('mysqlEng')->where('question', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'FAQ Kelas Online';
                $result['name'] = $item->question;
                $result['url'] = 'http://ykvi.or.id/kelas-online';
                return collect($result);
            });

            $cme_type = Cme::on('mysqlEng')->where('type', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'CME';
                $result['name'] = $item->type;
                $result['url'] = 'http://ykvi.or.id/cme';
                return collect($result);
            });

            $cme_title = Cme::on('mysqlEng')->where('title', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'CME';
                $result['name'] = $item->title;
                $result['url'] = 'http://ykvi.or.id/cme';
                return collect($result);
            });

            $product_category = ProductCategory::on('mysqlEng')->where('category_name', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Produk';
                $result['name'] = $item->category_name;
                $result['url'] = 'http://ykvi.or.id/produk';
                return collect($result);
            });

            $product = Product::on('mysqlEng')->where('name', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'Produk';
                $result['name'] = $item->name;
                $result['url'] = 'http://ykvi.or.id/produk/'.$item->slug;
                return collect($result);
            });

            $symcard_title = SymCard::on('mysqlEng')->where('title', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'SymCard';
                $result['name'] = $item->title;
                $result['url'] = 'http://ykvi.or.id/symcard';
                return collect($result);
            });

            $symcard_description = SymCard::on('mysqlEng')->where('description', 'LIKE', '%' . $request->input('search') . '%')->get()->transform(function($item) {
                $result['menu'] = 'SymCard';
                $result['name'] = clean_string($item->description);
                $result['url'] = 'http://ykvi.or.id/symcard';
                return collect($result);
            });

            $data = collect($about_us_title ?? [])
                    ->merge($about_us_description ?? [])
                    ->merge($e_learning_title ?? [])
                    ->merge($e_learning_description ?? [])
                    ->merge($faq_question ?? [])
                    ->merge($cme_title ?? [])
                    ->merge($cme_type ?? [])
                    ->merge($product_category ?? [])
                    ->merge($product ?? [])
                    ->merge($symcard_title ?? [])
                    ->merge($symcard_description ?? []);

            $data = collect($data)->take(20)->all();

            if ($data == '[]'){
                return response_json(true, null, 'Data retrieved.', $data);
            } else {
                return response_json(false, 'Get data failed.', 'No Data Exist');
            }
        } else {
            return response_json(false, 'Get data failed.', 'No Data Exist');
        }
    }

    public function validateFormRequest($request)
    {
        return Validator::make($request->all(), [
            "paginate" => "bail|sometimes|required|numeric",
        ]);
    }
}
