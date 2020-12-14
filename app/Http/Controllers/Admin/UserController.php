<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;

class UserController extends Controller
{
    private $admin;
    private $role;

    public function __construct(Admin $admin, Role $role)
    {
        $this->admin = $admin;
        $this->role = $role;

    }

    public function index()
    {
        // $listUser = $this->user->all();
        $listUser = DB::table('admins')
            ->join('role_admin', 'role_admin.admin_id', '=', 'admins.id')
            ->join('roles', 'roles.id', '=', 'role_admin.role_id')
            ->select('admins.*', 'roles.display_name')->get();
        return view('admin.user.index', compact('listUser'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            // Insert data to user table
            $userCreate = $this->admin->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            // Insert data to role_admin
            $userCreate->roles()->attach($request->roles);

            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }

    }

    /**
     * @param $id
     * show form edit
     */
    public function edit($id)
    {
        $roles = $this->role->all();
        $admin = $this->admin->findOrfail($id);
        $listRoleOfUser = DB::table('role_admin')->where('admin_id', $id)->pluck('role_id');
        return view('admin.user.edit', compact('roles', 'admin', 'listRoleOfUser'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            // update user tabale
            $this->admin->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            // Update to role_admin table
            DB::table('role_admin')->where('admin_id', $id)->delete();
            $userCreate = $this->admin->find($id);
            $userCreate->roles()->attach($request->roles);
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            dd(error);
            DB::rollBack();
        }


    }


    public function delete($id)
    {
        try {
            DB::beginTransaction();
            // Delete user
            $admin = $this->admin->find($id);
            $admin->delete($id);
            // Delete user of role_admin table
            $admin->roles()->detach();
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }

    }
}
