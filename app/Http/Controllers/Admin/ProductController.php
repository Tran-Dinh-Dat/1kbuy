<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_User;
use App\Models\ImagesProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use App\Exports\ExportOne;
use App\Exports\ExportTwo;
use App\Exports\ExportThree;
use App\Exports\ExportFour;
use App\Exports\ExportFive;
use App\Exports\ExportSix;
use App\Exports\ExportProduct;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ProductController extends Controller

{
    public function index(Request $request)
    {
        $products = Product::OrderBy('id', 'desc')->paginate(20);
        if ($request->has('search')) {
            $keyword = $request->search;
            $products = Product::where(function ($query) use($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
                $query->orwhere('sku', 'LIKE', "%$keyword%");
                $query->orWhereHas('category', function($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                });
            })->paginate(20);
        } 
        return view('admin.product.index', compact('products'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }
    
    public function active(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        if ($product->active == 0) {
            $product->active = 1;
            $product->save();
            return '<a href="javascript:void(0)" onclick="getActive('.$id.')" style="cursor: pointer"><i class="fa fa-check text-success"></i> </a>';
        } else {
            $product->active= 0;
            $product->save();
            return '<a href="javascript:void(0)" onclick="getActive('.$id.')" style="cursor: pointer"><i class="fa fa-close text-danger"></i> </a>';
        }
    }
    public function activePost(Request $request){
        $id = $request->id;
        $post = Post::findOrFail($id);
        if ($post->active == 0) {
            $post->active = 1;
            $post->save();
            return '<a href="javascript:void(0)" onclick="getActive('.$id.')" style="cursor: pointer"><i class="fa fa-check text-success"></i> </a> Tin tức';
        } else {
            $post->active= 0;
            $post->save();
            return '<a href="javascript:void(0)" onclick="getActive('.$id.')" style="cursor: pointer"><i class="fa fa-close text-danger"></i> </a> Câu Hỏi Thường Gặp';
        }
    }
    
    public function store(Request $request)
    {   
        $product = new Product();
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'sku' => 'required',
            'description' => 'required',
            'ship'=>'required',
            'price' => 'required',
            'image' => 'required',
            'files' => 'required',
            'size' => 'required'
        ],[
            'name.required' => 'Bạn cần nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'sku.required' => 'Bạn cần nhập mã sản phẩm',
            'description.required' => 'Bạn cần nhập mô tả',
            'ship.required' => 'Bạn cần nhập thông tin ship hàng',
            'size.required' => 'Bạn cần nhập quy cách size',
            'price.required' => 'Bạn cần nhập giá của sản phẩm',
            'image.required' => 'Bạn cần tải ảnh lên',
            'files.required' => 'Bạn cần tải album ảnh lên',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } 
        $product->category_id  = $request->category_id; 
        $product->name  = $request->name; 
        $product->sku  = $request->sku; 
        $product->slug  = Str::slug($request->name); 
        $product->description  = $request->description; 
        $product->ship =$request->ship;
        $product->price  = $request->price; 
        $product->size  = $request->size; 
        $product->promotion_price  = $request->promotion_price == null ? 0 : $request->promotion_price; 
        $product->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $product->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $product->image = $filename;
        } 
       
        $product->save();

        if ($request->hasFile('files')) {
            foreach($request->file('files') as $item){
                $addpicture = New ImagesProduct();
                $name= $item->getClientOriginalName();
                $item->move(public_path().'/upload/', $name);  
                $addpicture->image_name = $name;
                $addpicture->alt = $product->name;
                $addpicture->product_id = $product->id;
                $addpicture->save();
            }
        }
        return back()->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,'. $id,
            'sku' => 'required',
            'description' => 'required',
            'ship'=>'required',
            'price' => 'required',
        ],[
            'name.required' => 'Bạn cần nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'sku.required' => 'Bạn cần nhập mã sản phẩm',
            'description.required' => 'Bạn cần nhập mô tả',
            'ship.required' => 'Bạn cần nhập thông tin ship hàng',
            'price.required' => 'Bạn cần nhập giá của sản phẩm',
        ]);
            
        if ($validator->fails()) {
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } 
        }

        $product->category_id  = $request->category_id; 
        $product->name  = $request->name; 
        $product->sku  = $request->sku; 
        $product->slug  = Str::slug($request->name); 
        $product->description  = $request->description; 
        $product->ship =$request->ship;
        $product->price  = $request->price; 
        $product->size  = $request->size; 
        $product->promotion_price  = $request->promotion_price == null ? 0 : $request->promotion_price; 
        $product->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $product->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $product->image = $filename;
        } 


        if ($request->hasFile('files')) {
            foreach($request->file('files') as $item){
                $addpicture = New ImagesProduct();
                $name= $item->getClientOriginalName();
                $item->move(public_path().'/upload/', $name);  
                $addpicture->image_name = $name;
                $addpicture->alt = $product->name;
                $addpicture->product_id = $product->id;
                $addpicture->save();
            }
        }
        
        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }
    
    public function destroy(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $path = public_path('upload/images/');
        $file_old = $path . $product->image;
        if(File::exists($file_old)) {
            File::delete($file_old); 
        }
        $product->delete();
        return response()->json([
            'message' => 'Xóa sản phẩm thành công!'
          ]);
    }

    public function importExportView()
    {
       return view('admin.product.import');
    }
   
    public function import() 
    {
        if (!(request()->hasFile('import'))) {
            return back()->with('error', 'Bạn chưa chọn file!');
        }
        Excel::import(new ProductsImport,request()->file('import'));
        return back()->with('success', 'Nhập dữ liệu sản phẩm từ file excel thành công!');
    }

    public function detail($id)
    {
        $product = Product::with('user')->find($id);
        $productuser = Product_User::where('product_id', $id)->get();
        return view('admin.product.detail', compact('product', 'productuser'));
    }

    public function viewexport($month, $year) 
    {
        return view('admin.product.viewexport', compact('month', 'year'));
    }

    public function exportproduct() 
    {
        return Excel::download(new ExportProduct(), 'products-all.xlsx');
    }
    public function export($yesterday, $today) 
    {
        return Excel::download(new ProductsExport($yesterday, $today), 'dat-lenh-1kbuy.xlsx');
    }
    public function picture(Request $request){
        $id = $request->id;
        $picture = ImagesProduct::find($id);
        $app_path = str_replace("\\", '/', public_path());
        $file_path = $app_path.'/upload/'.$picture->image_name;
        if(File::exists($file_path)) {
            File::delete($file_path); 
        }
        $picture->delete();
        return '';
    }

}
