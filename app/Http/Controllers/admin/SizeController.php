<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function size()
    {
        $result['data'] = Size::all();
        return view('admin.size.size', $result);
    }

    public function SizeForm($id){
        $result = [];
        if ($id != 'add') {
            $arr = Size::where('id', $id)->first();
            $result['size'] = $arr->size;
            $result['id'] = $arr->id;
        } else {
            $result['size'] = '';
            $result['id'] = 0;
        }
        return view('admin.size.manage', $result);
    }

    public function SizeManage(Request $request)
    {
        $request->validate([
            'size' => 'required|unique:sizes,size,'.$request->id,
        ]); 
        
            if ($request->id > 0) {
                $model = Size::find($request->id);
                $message = "Size Updated";
            } else {
                $model = new Size();
                $message = "Size Added";
            }
            $model->size = $request->size;
            $model->save();
            return redirect('admin/size')->with('success_msg', $message);
    }

    public function SizeDelete($id)
    {
        $size = Size::find($id);
        $size->delete(); 
        return response()->json([
            'status' => 200,
            'message' => 'Size deleted',
        ]);
    }

    public function SizeStatus($status, $id)
    {
        if ($status == "deactive") {
            $size_status = '0';
        } elseif($status == "active") {
            $size_status = '1';
        }
        $model = Size::where('id', $id)->first();
        if ($model != null) {
            $model->status = $size_status;
            $model->save();
            return redirect('admin/size');
        }
    }
}
