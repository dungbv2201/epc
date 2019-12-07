<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\Topping;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($soreId, Request $request)
    {
        $toppingsIds = $request->toppingIds ? $request->toppingIds : [];
        $query = Product::query()->with([
            'stores' => function ($q) use ($soreId) {
                $q->select(['stores.id', 'stores.name'])->where('stores.id', $soreId);
            },
            'toppings' => function ($q) {
                $q->select(['toppings.id', 'toppings.name']);
            }])->whereHas('stores', function ($q2) use ($soreId) {
            $q2->where('stores.id', $soreId);
        });
        if (count($toppingsIds) > 0) {
            $query->whereHas('toppings', function ($q2) use ($toppingsIds) {
                $q2->whereIn('toppings.id', $toppingsIds);
            });
        }
        if ($request->sort) {
            $sort = explode('_', $request->sort);
            $query->orderBy(str_replace('_' . end($sort), '', $request->sort), end($sort));
        }
        $products = $query->get()->toArray();
        return response()->json($products);
    }

    public function getStore()
    {
        return response()->json(Store::all());
    }

    public function storeDetail($id)
    {
        return response()->json(Store::find($id));
    }

    public function getTopping()
    {
        return response()->json(Topping::all());
    }
}
