<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\ProductBrand;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = ProductBrand::all();
        return view('admin.dashboard.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);
        return redirect()->back();
    }

    public function doanhThu()
    {
        $dtQuery = DB::table('orders')
            ->select('total', 'created_at')
            ->whereYear('created_at', '=', Carbon::now()->year)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });

        foreach ($dtQuery as $key => $value) {
            $sum = 0;
            foreach ($value as $key2 => $value2) {
                $sum += $value2->total;
            }
            $dtCount[(int) $key] = $sum;
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($dtCount[$i])) {
                $doanhThu[$i] = $dtCount[$i];
            } else {
                $doanhThu[$i] = 0;
            }
        }

        return response()->json($doanhThu);
    }

    public function countOrderByMonth()
    {

        $orders = DB::table('orders')
            ->select('id', 'created_at')
            ->whereYear('created_at', '=', Carbon::now()->year)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $usermcount = [];
        $userArr = [];

        foreach ($orders as $key => $value) {
            $usermcount[(int) $key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $userArr[$i] = $usermcount[$i];
            } else {
                $userArr[$i] = 0;
            }
        }

        return response()->json($userArr);
    }

    public function countCate()
    {
        $orders = Category::select('id', 'name')->get();

        $a = [];
        foreach ($orders as $key => $value) {
            $products = Product::where('categories_id', $value->id)->count();
            $a[$value->name] = $products;
        }

        return response()->json($a);
    }
}
