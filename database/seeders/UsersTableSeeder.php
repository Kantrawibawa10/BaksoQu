<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superusers = [
            'id'          => 1,
            'nama'        => 'Superadmin',
            'no_telepon'  => '087894484256',
            'alamat'      => 'Jl Mawar No. 40, Delod Peken, Tabanan, Bali - Indonesia',
            'email'       => 'admin@example.com',
            'username'    => 'superadmin',
            'password'    => Hash::make('superadmin'),
            'role'        => 'Superadmin',
            'created_at'  => now(),
            'updated_at'  => now(),
        ];

        User::insert($superusers);

        $pelanggan = [
            'id'          => 2,
            'nama'        => 'I Made Adi Guna',
            'no_telepon'  => '087894492725',
            'alamat'      => 'Jl Mawar No. 40, Delod Peken, Tabanan, Bali - Indonesia',
            'email'       => 'adiguna@example.com',
            'username'    => 'adiguna',
            'password'    => Hash::make('adiguna'),
            'role'        => 'Pelanggan',
            'created_at'  => now(),
            'updated_at'  => now(),
        ];

        User::insert($pelanggan);
    }
}
