<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Tra ve danh sach cac ban ghi product
    public function index()
    {
        //Ellquent
        //all rất cả bản ghi
        $products = Product::all();
        //get : lấy ra toàn bộ các bản ghi, kết hợp  được với câu điều kiện
        //get : sẽ nằm cuối
        $productsGet = Product::select('*')
            ->with('category')
            // ->where('id', '>', 3 )
            // ->get();
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('product.index', ['products' =>  $productsGet]);
        // dd('danh sách category', $categories, $categoriesGet);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Tao ban ghi product moi

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Tra ve thong tin ban ghi product theo id
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Cap nhat thong tin cua 1 ban ghi
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Xoa 1 ban ghi product
    public function destroy($id)
    {
        //
    }
    public function delete(Product $pro)
    {
        // Neu muon su dung model binding
        // 1. Dinh nghia kieu tham so truyen vao la model tuong ung
        // 2. Tham so o route === ten tham so truyen vao ham
        if ($pro->delete()) {
            return redirect()->route('products.index');
        }

        // Cach 1: destroy, tra ve id cua thang duoc xoa
        // Chi ap dung khi nhan vao tham so la gia tri
        // Neu k xoa duoc thi tra ve 0
        $productDelete = Product::destroy($pro);
        if ($productDelete !== 0) {
            return redirect()->route('products.index');
        }
        // dd($categoryDelete);

        // Cach 2: delete, tra ve true hoac false
        // $category = Category::find($id);
        // $category->delete();
    }
    public function add()
    {
        $cate = Category::all();
        return view('product.create', compact('cate'));
    }
    public function edit(Product $id)
    {
        $cate = Category::all();
        return view('product.create', [
            'product' => $id,
            'cate' => $cate
        ]);
    }
    public function save(Request $request)

    {
        $unique = $request->has('id') ? ",name,$request->id" : '';
        $request->validate(
            [
                // nam nao se validate dieu kien gi
                'name' => 'required|unique:products' . $unique,
                'description' => 'required',
                'status' => 'required',
                'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'image_url' => 'required|url',
                'category_id' => 'required'

            ],
            [
                'name.required' => 'Tên không được để trống',
                'name.unique' => 'Tên sản phẩm đã tồn tại',
                'description.required' => 'Chi tiết không được để trống',
                'status.required' => ' Trạng thái không được để trống',
                'category_id.required' => 'Danh mục không được để trống',
                'image_url.required' => 'Đường dẫn ảnh không được để trống',
                'image_url.url' => 'Đường dẫn ảnh phải là một đường dẫn',
                'price.required' => 'Giá sản phẩm không được để trống',
                'price.regex' => 'Giá sản phẩm phải là một số',
            ]
        );

        if ($request->has('id')) {
            $model = Product::find($request->id);
        } else {
            $model = new Product();
        }

        $model->fill($request->all());
        $model->save();

        return redirect()->route('products.index');
    }
}
