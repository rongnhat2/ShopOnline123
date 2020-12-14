<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class admin_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->insert([
            'name'              => 'Quản lí cao cấp',
            'email'             => 'admin@admin.com',
            'password'          => Hash::make('12345678'),
            "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        DB::table('roles')->insert([
            'name'              => 'admin',
            'display_name'      => 'admin',
            "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('role_admin')->insert([
            'admin_id'           => '1',
            'role_id'           => '1',
            "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);


        DB::table('permissions')->insert([
            'name'              => 'roles',
            'display_name'          => 'Quản Lí Chức Vụ',
            "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('permissions')->insert([
            'name'              => 'users',
            'display_name'          => 'Quản Lí Nhân Viên',
            "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('permissions')->insert([
            'name'              => 'item',
            'display_name'          => 'Quản Lí Sản Phẩm',
            "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('permissions')->insert([
            'name'              => 'order',
            'display_name'          => 'Quản Lí Đơn hàng',
            "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        DB::table('permissions')->insert([
            'name'              => 'layout',
            'display_name'          => 'Quản Lí Giao diện',
            "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);


        for ($i=1; $i <= 5 ; $i++) { 
            DB::table('role_permission')->insert([
                'permission_id'     => $i,
                'role_id'           => '1',
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
    }
}
