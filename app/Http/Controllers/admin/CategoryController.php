<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use session;
use File;
class CategoryController extends Controller
{
    public function category()
    {
        $result['data'] = Category::all();
        return view('admin.category.category', $result);
    }

    public function CategoryForm($slug){
        $result = [];
        if ($slug != 'add') {
            $arr = Category::where('cat_slug', $slug)->first();
            $result['cat_name'] = $arr->cat_name;
            $result['cat_slug'] = $arr->cat_slug;
            $result['image'] = $arr->image;
            $result['id'] = $arr->id;
        } else {
            $result['cat_name'] = '';
            $result['cat_slug'] = '';
            $result['image'] = '';
            $result['id'] = 0;
        }
        return view('admin.category.manage', $result);
    }

    public function CategoryManage(Request $request)
    {
        if ($request->id > 0) {
            $image_validation = 'mimes:jpg,png,jpeg,gif,svg|max:2048';
        } else {
            $image_validation = 'required|mimes:jpg,png,jpeg,gif,svg|max:2048';
        }       
        $request->validate([
            'cat_name' => 'required',
            'cat_slug' => 'required|unique:categories,cat_slug,'.$request->id,
            'image' => $image_validation,
        ]);
        
            if ($request->id > 0) {
                $model = Category::find($request->id);
                $message = "Category Updated";
                if($request->hasfile('image')){
                    $path = 'images/category/'.$model->image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                }
            } else {
                $model = new Category();
                $message = "Category Added";
            }
            
                if($request->hasfile('image'))
                {
                    $filenameWithExt = $request->file('image')->getClientOriginalName();
                    $filename  = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $request->image->move(public_path('images/category'), $fileNameToStore);
                    $model->image = $fileNameToStore;
                }
            $model->Cat_name = $request->cat_name;
            $model->Cat_slug = $request->cat_slug;
            $model->save();
            return redirect('admin/category')->with('success_msg', $message);
    }

    public function CategoryDelete(Request $request, $id)
    {
        $category = Category::find($id);
        $path = 'images/category/'.$category->image;
        if(File::exists($path))
        {
            File::delete($path);
        }
        $category->delete(); 
        return response()->json([
            'status' => 200,
            'message' => 'Category deleted',
        ]);
    }

    public function CategoryStatus(Request $request, $status, $slug)
    {
        if ($status == "deactive") {
            $cat_status = '0';
        } elseif($status == "active") {
            $cat_status = '1';
        }
        $model = Category::where('cat_slug', $slug)->first();
        if ($model != null) {
            $model->status = $cat_status;
            $model->save();
            return redirect('admin/category');
        }
    }
}
