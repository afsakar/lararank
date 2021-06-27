<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.users.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
        $request->merge([
            'password' => Hash::make($request->password),
            'permissions' => "null",
        ]);

        User::create($request->post());
        return redirect()->route('users.index')->withSuccess('Kayıt veritabanına başarıyla eklendi!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::where('id', $id)->first() ?? abort(404);

        if($request->password != ""){
            $request->merge([
                'password' => Hash::make($request->password),
                'permissions' => json_encode($request->permissions, JSON_UNESCAPED_UNICODE),
            ]);
        }else{
            $request->merge([
                'password' => $user->password,
                'permissions' => json_encode($request->permissions, JSON_UNESCAPED_UNICODE),
            ]);
        }

        $user->update($request->post());

        return redirect()->route('users.index')->withSuccess('Kayıt başarıyla güncellendi!');
    }

    /**
     * @return Application|Factory|View
     */
    public function profile()
    {
        return view('admin.users.profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id) ?? abort(404);
        if($user->profile_photo_path != ""){
            File::delete(public_path($user->profile_photo_path));
        }
        $user->delete();
        return redirect()->route('users.index')->withSuccess('Kayıt veritabanından başarıyla silindi!');
    }
}
