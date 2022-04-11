<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::paginate();
        return view('user.index', compact('data'));
    }

    public function add()
    {
        return view('user.form-data');
    }

    public function save(Request $request)
    {
        $uniqueName = $request->has('id') ? ",name,$request->id" : '';
        $uniqueEmail = $request->has('id') ? ",email,$request->id" : '';
        //Khi sử dụng update sẽ bị bug unique , nên sử dụng cách này gán xuống dưới để tránh bug đó

        $request->validate(
            [
                'name' => 'required|unique:users' . $uniqueName,
                'email' => 'required|email|unique:users'. $uniqueEmail,
                'password' => 'required'
            ],
            [
                'name.required' => 'Tên không được để trống',
                'name.unique' => 'Tên đã được sử dụng',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không phù hợp',
                'email.unique' => 'Email đã được sử dụng',
                'password.required' => 'Mật khẩu không được để trống'
            ]
        );

        if ($request->has('id')) {
            $model = User::find($request->id);
        } else {
            $model = new User();
        }
        $model->fill($request->all());
        $model->password = Hash::make($request->password);
        $model->save();


        return redirect()->route('user.index');
    }


    public function edit(Request $request , $id){
        $user = User::find($id);
        return view('user.form-data', compact('user'));
    }

    public function delete($id){
        User::destroy($id);
        return redirect()->route('user.index');
    }
}
