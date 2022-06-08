<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\User;
class DatabaseSeeder extends Seeder
{
    use HasRoles;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $superAdmin = Role::create(['name' => 'quan_tri_vien']);
        $admin = Role::create(['name' => 'bo_tai_chinh']);
        $user = Role::create(['name' => 'hoc_vien']);

        $permissionView = Permission::create(['name' => 'viewThongKe']);
        $permissionInsert = Permission::create(['name' => 'insertThongKe']);
        $permissionDelete = Permission::create(['name' => 'deleteThongKe']);
        $permissionUpdate = Permission::create(['name' => 'updateThongKe']);

        $permissionView2 = Permission::create(['name' => 'viewHocPhiHocVien']);
        $permissionInsert2 = Permission::create(['name' => 'insertHocPhiHocVien']);
        $permissionDelete2 = Permission::create(['name' => 'deleteHocPhiHocVien']);
        $permissionUpdate2 = Permission::create(['name' => 'updateHocPhiHocVien']);

        $permissionView3 = Permission::create(['name' => 'viewCaNhan']);
        $permissionInsert3 = Permission::create(['name' => 'insertCaNhan']);
        $permissionDelete3 = Permission::create(['name' => 'deleteCaNhan']);
        $permissionUpdate3 = Permission::create(['name' => 'updateCaNhan']);

        $superAdmin->givePermissionTo($permissionView);
        $superAdmin->givePermissionTo($permissionInsert);
        $superAdmin->givePermissionTo($permissionDelete);
        $superAdmin->givePermissionTo($permissionUpdate);
        $superAdmin->givePermissionTo($permissionView2);
        $superAdmin->givePermissionTo($permissionInsert2);
        $superAdmin->givePermissionTo($permissionDelete2);
        $superAdmin->givePermissionTo($permissionUpdate2);
        $superAdmin->givePermissionTo($permissionView3);
        $superAdmin->givePermissionTo($permissionInsert3);
        $superAdmin->givePermissionTo($permissionDelete3);
        $superAdmin->givePermissionTo($permissionUpdate3);

        $admin->givePermissionTo($permissionView);
        $admin->givePermissionTo($permissionDelete);
        $admin->givePermissionTo($permissionUpdate);
        $admin->givePermissionTo($permissionView2);
        $admin->givePermissionTo($permissionDelete2);
        $admin->givePermissionTo($permissionUpdate2);
        $admin->givePermissionTo($permissionView3);
        $admin->givePermissionTo($permissionDelete3);
        $admin->givePermissionTo($permissionUpdate3);


        $user->givePermissionTo($permissionView3);

        $userTuyet = User::insert([
            ['name'=>'Le teo','user_name'=>'HV001','email'=>'hv001@gmail.com','password'=>'123456'],
            ['name'=>'Le leo','user_name'=>'HV002','email'=>'hv002@gmail.com','password'=>'123456'],
            ['name'=>'Le meo','user_name'=>'HV003','email'=>'hv003@gmail.com','password'=>'123456'],
            ['name'=>'Le neo','user_name'=>'HV004','email'=>'hv004@gmail.com','password'=>'123456'],
            ['name'=>'Le beo','user_name'=>'HV005','email'=>'hv005@gmail.com','password'=>'123456'],
        ]);
        // $userTuyet->assignRole($superAdmin);

        $user1 = User::where('email','hv001@gmail.com')->first();
        $user1->assignRole($superAdmin);

        $user2 = User::where('email','hv002@gmail.com')->first();
        $user2->assignRole($admin);

        $user3 = User::where('email','hv003@gmail.com')->first();
        $user3->assignRole($user);
        $user4 = User::where('email','hv004@gmail.com')->first();
        $user4->assignRole($user);
        $user5 = User::where('email','hv005@gmail.com')->first();
        $user5->assignRole($user);


    }
}
