<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;



class CategoryController extends Controller
{
    public function index()
    {
        //Ellquent
        //all rất cả bản ghi
        $categories = Category::all();
        //get : lấy ra toàn bộ các bản ghi, kết hợp  được với câu điều kiện
        //get : sẽ nằm cuối
        $categoriesGet = Category::select('*')
            // ->where('id', '>', 3 )
            // ->get();
            ->with('parentCategory')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('category.index', ['categories' =>  $categoriesGet]);
        // dd('danh sách category', $categories, $categoriesGet);

    }
    public function add()
    {
        $parentCategory = ParentCategory::all();
        return view('category.create', compact('parentCategory'));
    }
    public function save(Request $request)

    {   
        $unique = $request->has('id') ? ",name,$request->id" :'' ;
        $request->validate(
            [
                // nam nao se validate dieu kien gi
                'name' => 'required|max:50|unique:categories'.$unique ,
                'description' => 'required',
                'status' => 'required',
                'parent_id' => 'required'

            ],
            [
                'name.required' => 'Tên không được để trống',
                'name.unique' => 'Tên danh mục đã tồn tại',
                'name.max' => 'Tên danh mục không được quá 50 ký tự',
                'description.required' => 'Chi tiết không được để trống',
                'status.required' => ' Trạng thái không được để trống',
                'parent_id.required' => 'Danh mục cha không được để trống'
            ]
        );

        if($request->has('id')){
            $model = Category::find($request->id);
        }else{
            $model = new Category();
        }

        $model->fill($request->all());
        $model->save();



        return redirect()->route('categories.index');
    }
    public function edit(Category $id)
    {
        $parentCategory = ParentCategory::all();
        return view('category.create', [
            'category' => $id,
            'parentCategory' => $parentCategory
        ]);
    }
    public function delete(Category $cate)
    {
        // Neu muon su dung model binding
        // 1. Dinh nghia kieu tham so truyen vao la model tuong ung
        // 2. Tham so o route === ten tham so truyen vao ham
        if ($cate->delete()) {
            return redirect()->route('categories.index');
        }

        // Cach 1: destroy, tra ve id cua thang duoc xoa
        // Chi ap dung khi nhan vao tham so la gia tri
        // Neu k xoa duoc thi tra ve 0
        $categoryDelete = Category::destroy($cate);
        if ($categoryDelete !== 0) {
            return redirect()->route('categories.index');
        }
        // dd($categoryDelete);

        // Cach 2: delete, tra ve true hoac false
        // $category = Category::find($id);
        // $category->delete();
    }
}
