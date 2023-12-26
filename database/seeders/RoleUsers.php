<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Roles;

class RoleUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'id'        => '1',
            'roles'     => 'Superadmin',
        ];

        Roles::insert($roles);

        $roles = [
            'id'        => '2',
            'roles'     => 'Pelanggan',
        ];

        Roles::insert($roles);
    }
}
