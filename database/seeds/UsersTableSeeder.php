<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        User::truncate();

        //Creamos un usuario


        $user  = new User;

        $user->name 	= "Marcos Portillo";

        $user->email 	= "marcos@gmail.com";

        $user->password = bcrypt('123456');

        $user->save();

        
    }
}
