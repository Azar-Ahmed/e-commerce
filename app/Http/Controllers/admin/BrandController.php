<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use File;

class BrandController extends Controller
{
    public function brand()
    {
        $result['data'] = Brand::all();
        return view('admin.brand.brand', $result);
    }

    public function BrandForm($id){
        $result = [];
        if ($id != 'add') {
            $arr = Brand::where('id', $id)->first();
            $result['brand'] = $arr->brand;
            $result['image'] = $arr->image;
            $result['id'] = $arr->id;
        } else {
            $result['brand'] = '';
            $result['image'] = '';
            $result['id'] = 0;
        }
        return view('admin.brand.manage', $result);
    }

    public function BrandManage(Request $request)
    {
        if ($request->id > 0) {
            $image_validation = 'mimes:jpg,png,jpeg,gif,svg|max:2048';
        } else {
            $image_validation = 'required|mimes:jpg,png,jpeg,gif,svg|max:2048';
        }

        $request->validate([
            'brand' => 'required',
            'image' => $image_validation,
        ]); 
        
            if ($request->id > 0) {
                $model = Brand::find($request->id);
                $message = "Brand Updated";
                if($request->hasfile('image')){
                    $path = 'images/brand/'.$model->image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                }
            } else {
                $model = new Brand();
                $message = "Brand Added";
            }
            if($request->hasfile('image'))
                {
                    $filenameWithExt = $request->file('image')->getClientOriginalName();
                    $filename  = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $request->image->move(public_path('images/brand'), $fileNameToStore);
                    $model->image = $fileNameToStore;
                }
           
            $model->brand = $request->brand;
            $model->save();
            return redirect('admin/brand')->with('success_msg', $message);
    }

    public function BrandDelete($id)
    {
        $brand = Brand::find($id);
        $path = 'images/brand/'.$brand->image;
        if(File::exists($path))
        {
            File::delete($path);
        }
        $brand->delete(); 
        return response()->json([
            'status' => 200,
            'message' => 'Brand deleted',
        ]);
    }

    public function BrandStatus($status, $id)
    {
        if ($status == "deactive") {
            $brand_status = '0';
        } elseif($status == "active") {
            $brand_status = '1';
        }
        $model = Brand::where('id', $id)->first();
        if ($model != null) {
            $model->status = $brand_status;
            $model->save();
            return redirect('admin/brand');
        }
    }
}
