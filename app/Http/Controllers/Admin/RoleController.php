<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Http\Response;
use App\Http\Controllers\Admin\NotificationController as Notify;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.roles.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleCreateRequest $request
     * @return Application|Factory|View
     */
    public function store(RoleCreateRequest $request)
    {
        $request->merge([
            'permissions' => ""
        ]);

        Role::create($request->post());

        send_notify(
            'info',
            '',
           auth()->user()->name . ' tarafından <b>' . $request->post('name') . '</b> adında bir rol oluşturuldu!'
        );

        return redirect()->route('roles.index')->withSuccess('Kayıt veritabanına başarıyla eklendi!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->first() ?? abort('404');

        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleUpdateRequest $request
     * @param  int  $id
     * @return Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::where('id', $id)->first() ?? abort('404');

        $request->merge([
            'permissions' => json_encode($request->permissions, JSON_UNESCAPED_UNICODE),
        ]);

        $role->update($request->post());

        return redirect()->route('roles.index')->withSuccess('Kayıt başarıyla güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = Role::where('id', $id)->first() ?? abort(404);

        if(in_array($id, array(1,2,3))){
            return redirect()->route('roles.index')->with('error', 'Bu kayıt veritabanından silinemez!');
        }else{
            $role->delete();

            send_notify(
                'info',
                '',
                auth()->user()->name . ' tarafından <b>' . $role->name . '</b> adındaki rol silindi!'
            );

            return redirect()->route('roles.index')->withSuccess('Kayıt veritabanından başarıyla silindi!');
        }
    }
}
