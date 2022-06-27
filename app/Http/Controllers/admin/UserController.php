<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user()
    {
        $result['data'] = User::all();
        return view('admin.user.user', $result);
    }

    public function UserStatus($status, $id)
    {
        if ($status == "deactive") {
            $user_status = '0';
        } elseif($status == "active") {
            $user_status = '1';
        }
        $model = User::where('id', $id)->first();
        if ($model != null) {
            $model->status = $user_status;
            $model->save();
            return redirect('admin/user');
        }
    }

}
