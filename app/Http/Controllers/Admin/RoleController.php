<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\User;
use App\Traits\General;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use General;

    public function index()
    {

        if (Session::has('LoggedIn')) {

            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Manage Roles';
            $data['roles'] = Role::paginate(25);

            return view('admin.role.index', $data);
        }
    }

    public function create()
    {
        if (Session::has('LoggedIn')) {

            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = 'Add Role';
            $data['roles'] = Role::all();
            $data['permissions'] = Permission::all();

            return view('admin.role.create', $data);
        }
    }

    public function store(RoleRequest $request)
    {

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        $role->givePermissionTo($request->permissions);


    return redirect('admin/role')->with('success','Data has been created successfully');
    }

    public function edit($id)
    {

        if (Session::has('LoggedIn')) {

            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Edit Role';
            $data['role'] = Role::find($id);
            $data['permissions'] = Permission::all();
            $data['selected_permissions'] = DB::table('role_has_permissions')->where('role_id', $id)->select('permission_id')->pluck('permission_id')->toArray();

            return view('admin.role.edit', $data);
        }
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|unique:roles,name,' . $id,
        'permissions' => ['required', 'array', 'min:1'],
    ]);

    $role = Role::find($id);
    $role->name = $request->name;
    $role->save();

    DB::table('role_has_permissions')->where('role_id', $id)->delete();
    $role->givePermissionTo($request->permissions);
    Artisan::call('cache:clear');



    return redirect('admin/role')->with('success','Data has been updated successfully');
}

    public function delete($id)
    {

        $role = Role::find($id);
        DB::table('role_has_permissions')->where('role_id', $id)->delete();
        $role->delete();

        $this->showToastrMessage('error', __('Role has been deleted'));
        return redirect()->back();
    }
}
