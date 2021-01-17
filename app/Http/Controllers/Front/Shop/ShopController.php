<?php

namespace App\Http\Controllers\Front\Shop;

use App\Enums\Shop\ProductStatus;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use stdClass;

class ShopController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('pages.front.shop.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function datatable(Request $request): JsonResponse
    {
        $products = Product::whereStatus(ProductStatus::CONFIRMED)->with('owner.school');

        foreach ($request->input('columns') as $column) {
            if ($column['search']['value'] != "") {
                $val = $column['search']['value'];
                switch ($column['name']) {
                    case 'price':
                        $products->where('price', $val);
                        break;
                }
            }
        }

        switch ($request->input('columns')[$request->input('order.0.column')]['name']) {
            case 'price':
                $products->orderBy('price', $request->input('order.0.dir'));
                break;
            case 'created_at':
                $products->orderBy('created_at', $request->input('order.0.dir'));
                break;
        }

        $total = $products->count();
        $products = $products->offset($request->input('start'))->limit($request->input('length'))->get();

        $data = new Collection();
        foreach ($products as $product) {
            /** @var Product $product */

            $obj = new stdClass();
            $obj->id = $product->id;
            $obj->name = $product->name;
            $obj->image = $product->image('small');
            $obj->link = route('shop.products.show', ['id' => $product->id, 'slug' => $product->slug]);
            $obj->school = $product->owner->school->name;
            $obj->tags = $product->tags()->pluck('name')->toArray();
            $obj->price = number_format($product->price);
            $obj->discount = $product->discount;
            $obj->final_price = number_format($product->final_price);
            $obj->updated_at = jDate($product->updated_at);

            $data->add($obj);
            $obj = null;
        }

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            "data" => $data,
        ];

        return new JsonResponse($json_data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function product(Request $request, $id)
    {
        $product = Product::whereId($id)->with(['comments', 'owner.school'])->withCount('comments')->firstOrFail();

        if ($product->status != ProductStatus::CONFIRMED and
            Auth::user()->isAdmin() == false and
            Auth::id() != $product->owner_id
        ) {
            abort(404);
        }

        $relatedProducts = Product::whereStatus(ProductStatus::CONFIRMED)->where('id', '<>', $id)->with('owner.school')->limit(6)->get();

        return view('pages.front.shop.product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
