<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crudPermissionNames = [
            'Manage admins' => ' أدراة المدراء',
            'Manage roles' => ' أدراة الأدوار والصلاحيات',
            'Manage users' => 'أدراة المتدربين',
            'Manage courses' => 'أدراة الكورسات',
            'Manage certifications' => 'أدراة الشهادات',
        ];

        foreach ($crudPermissionNames as $en_permission => $ar_permission) {
                Permission::updateOrCreate(
                    [
                        'name' => $en_permission,
                        'name_ar' =>$ar_permission,
                        'guard_name' => 'admin',
                    ],
                    [
                        'name' => $en_permission,
                        'name_ar' =>$ar_permission,
                        'guard_name' => 'admin',
                    ]
                );
        }

        $role = Role::where(['name' => 'super admin', 'guard_name' => 'admin'])->first();

        $role->givePermissionTo(Permission::where('guard_name', 'admin')->pluck('id'));
    }
}
