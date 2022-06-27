<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function coupon()
    {
        $result['data'] = Coupon::all();
        return view('admin.coupon.coupon', $result);
    }

    public function CouponForm($id){
        $result = [];
        if ($id != 'add') {
            $arr = Coupon::where('id', $id)->first();
            $result['title'] = $arr->title;
            $result['description'] = $arr->description;
            $result['code'] = $arr->code;
            $result['value'] = $arr->value;   
            $result['type'] = $arr->type;   
            $result['min_order_amt'] = $arr->min_order_amt;   
            $result['uses_time'] = $arr->uses_time;   
            $result['id'] = $arr->id;
        } else {
            $result['title'] = '';
            $result['description'] = '';
            $result['code'] = '';
            $result['value'] = '';
            $result['type'] = '';
            $result['min_order_amt'] = '';
            $result['uses_time'] = '';
            $result['id'] = 0;
        }
        return view('admin.coupon.manage', $result);
    }

    public function CouponManage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'code' => 'required',
            'value' => 'required',
        ]);
        
            if ($request->id > 0) {
                $model = Coupon::find($request->id);
                $message = "Coupon Updated";
            } else {
                $model = new Coupon();
                $message = "Coupon Added";
            }
            $model->title = $request->title;
            $model->description = $request->description;
            $model->code = $request->code;
            $model->value = $request->value;
            $model->type = $request->type;
            $model->min_order_amt = $request->min_order_amt;
            $model->uses_time = $request->uses_time;
            $model->save();
            return redirect('admin/coupon')->with('success_msg', $message);
    }


    public function CouponDelete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Coupon deleted',
        ]);
    }

    public function CouponStatus($status, $id)
    {
        if ($status == "deactive") {
            $coupon_status = '0';
        } elseif($status == "active") {
            $coupon_status = '1';
        }
        $model = Coupon::where('id', $id)->first();
        if ($model != null) {
            $model->status = $coupon_status;
            $model->save();
            return redirect('admin/coupon');
        }
    }
}
