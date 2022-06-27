<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function color()
    {
        $result['data'] = Color::all();
        return view('admin.color.color', $result);
    }

    public function ColorForm($id){
        $result = [];
        if ($id != 'add') {
            $arr = Color::where('id', $id)->first();
            $result['color'] = $arr->color;
            $result['id'] = $arr->id;
        } else {
            $result['color'] = '';
            $result['id'] = 0;
        }
        return view('admin.color.manage', $result);
    }

    public function ColorManage(Request $request)
    {
        $request->validate([
            'color' => 'required|unique:colors,color,'.$request->id,
        ]); 
        
            if ($request->id > 0) {
                $model = Color::find($request->id);
                $message = "Color Updated";
            } else {
                $model = new Color();
                $message = "Color Added";
            }
            $model->color = $request->color;
            $model->save();
            return redirect('admin/color')->with('success_msg', $message);
    }

    public function ColorDelete($id)
    {
        $color = Color::find($id);
        $color->delete(); 
        return response()->json([
            'status' => 200,
            'message' => 'Color deleted',
        ]);
    }

    public function ColorStatus($status, $id)
    {
        if ($status == "deactive") {
            $color_status = '0';
        } elseif($status == "active") {
            $color_status = '1';
        }
        $model = Color::where('id', $id)->first();
        if ($model != null) {
            $model->status = $color_status;
            $model->save();
            return redirect('admin/color');
        }
    }
}
