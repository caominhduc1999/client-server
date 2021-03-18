<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backend.users.index', compact('users'));
    }

    public function show($id)
    {
        //
    }

    public function create()
    {
        return view('backend.users.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'user_type' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên user'
        ]);

        User::create($request->all());
        return redirect()->back()->with('success', 'Thêm thành công !');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email,'.$user->id.'',
            'phone' => 'required|unique:users,phone,'.$user->id.'',
        ], [
            'email.required' => 'Vui lòng nhập email'
        ]);

        $user->update($request->all());
        $user->save();
        return redirect()->back()->with('success', 'Sửa thành công !');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Xóa thành công !');
    }

    public function getProfile()
    {
        $user = Auth::user();
        return view('backend.profile', compact('user'));
    }

    public function postProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::id().'',
            'phone' => 'required|unique:users,phone,'.Auth::id().'',
        ], [
            'name.required' => 'Vui lòng nhập tên user'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thành công !');
    }
}
