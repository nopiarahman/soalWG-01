<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'name' => 'Nopi',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('rahasia'),
            // 'role'=>'admin'
        ]);
        $superAdmin->assignRole('admin');
        $editor = User::create([
            'name' => 'Budi',
            'email' => 'editor@gmail.com',
            'password' => Hash::make('rahasia'),
            // 'role'=>'admin'
        ]);
        $editor->assignRole('editor');

    }
}
