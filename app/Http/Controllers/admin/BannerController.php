<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use File;
class BannerController extends Controller
{
    public function banner()
    {
        $result['data'] = Banner::all();
        return view('admin.banner.banner', $result);
    }

    public function BannerForm($id){
        $result = [];
        if ($id != 'add') {
            $arr = Banner::where('id', $id)->first();
            $result['title'] = $arr->title;
            $result['desc'] = $arr->desc;
            $result['btn_text'] = $arr->btn_text;
            $result['btn_link'] = $arr->btn_link;
            $result['image'] = $arr->image;
            $result['id'] = $arr->id;
        } else {
            $result['title'] = '';
            $result['desc'] = '';
            $result['btn_text'] = '';
            $result['btn_link'] = '';
            $result['image'] = '';
            $result['id'] = 0;
        }
        return view('admin.banner.manage', $result);
    }

    public function BannerManage(Request $request)
    {
        if ($request->id > 0) {
            $image_validation = 'mimes:jpg,png,jpeg,gif,svg|max:2048';
        } else {
            $image_validation = 'required|mimes:jpg,png,jpeg,gif,svg|max:2048';
        }

        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'btn_text' => 'required',
            'btn_link' => 'required',
            'image' => $image_validation,
        ]); 
        
            if ($request->id > 0) {
                $model = Banner::find($request->id);
                $message = "Banner Updated";
                if($request->hasfile('image')){
                    $path = 'images/banner/'.$model->image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                }
            } else {
                $model = new Banner();
                $message = "Banner Added";
            }
            if($request->hasfile('image'))
            {
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename  = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->image->move(public_path('images/banner'), $fileNameToStore);
                $model->image = $fileNameToStore;
            }
            $model->title = $request->title;
            $model->desc = $request->desc;
            $model->btn_text = $request->btn_text;
            $model->btn_link = $request->btn_link;
            $model->save();
            return redirect('admin/banner')->with('success_msg', $message);
    }

    public function BannerDelete($id)
    {
        $banner = Banner::find($id);
        $path = 'images/banner/'.$banner->image;
        if(File::exists($path))
        {
            File::delete($path);
        }
        $banner->delete(); 
        return response()->json([
            'status' => 200,
            'message' => 'Banner deleted',
        ]);
    }

    public function BannerStatus($status, $id)
    {
        if ($status == "deactive") {
            $brand_status = '0';
        } elseif($status == "active") {
            $brand_status = '1';
        }
        $model = Banner::where('id', $id)->first();
        if ($model != null) {
            $model->status = $brand_status;
            $model->save();
            return redirect('admin/banner');
        }
    }
}
