<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsData = Product::paginate(20); // 20 phải là hằng số, env
        return view('admin.product.index', [
            'productsData' => $productsData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return route('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'price' => 'required|integer|min:0'
            ],
            [
                'price.required' => 'Vui lòng nhập giá sản phẩm',
                'price.min' => 'Giá sản phẩm không được dưới 0',
                'price.integer' => 'Giá sản phẩm không được dưới 0',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 404);
        }

        $product = Product::create($request->all());
        if ($product) {
            return response()->json(['status' => 'success']);
        }
        return redirect()->route('products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required|integer|min:1000',
                'vote' => 'required|min:0|max:5',
                'product_brands_id' => 'required',
                'categories_id' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên sản phẩm.',

                'price.required' => 'Vui lòng nhập giá sản phẩm.',
                'price.min' => 'Giá sản phẩm không được dưới 1000.',
                'price.integer' => 'Giá sản phẩm không được dưới 1000.',

                'vote.required' => 'Đánh giá không được để trống.',
                'vote.min' => 'Đánh giá ít nhất là 0.',
                'vote.max' => 'Đánh giá ít nhất là 5.',

                'product_brands_id.required' => 'Thương hiệu không được để trống.',
                'categories_id.required' => 'Danh mục không được để trống.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'isValidator' => 'true', 'message' => $validator->errors()->all()]);
        }

        $editProduct = Product::find($id);
        $editProduct->update($request->all());
        if ($editProduct) {
            return response()->json(['status' => 'success']);
        }
        return redirect()->route('products.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }
}
