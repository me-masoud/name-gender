<?php

namespace Database\Seeders;

use App\Models\Name;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

        $faker = Faker::create();

        foreach (range(1 , 5) as $index){
            $name = $faker->firstName;
            Name::create([
                'firstChar' => substr($name , 0 , 1),
                'name' => $name,
                'enName'=>$name,
                'sex'  => $faker->randomElement(['male' , 'female' , 'both'])
            ]);
        }

//        $names = [
//            ['id'=> '' ,'firstChar' => '', 'name'=> '' ,'sex'=>'', 'baseCulture'=>'','sameNames'=>''],
//            ['id'=> '' ,'firstChar' => '', 'name'=> '' ,'sex'=>'', 'baseCulture'=>'','sameNames'=>''],
//            ['id'=> '' ,'firstChar' => '', 'name'=> '' ,'sex'=>'', 'baseCulture'=>'','sameNames'=>''],
//            ['id'=> '' ,'firstChar' => '', 'name'=> '' ,'sex'=>'', 'baseCulture'=>'','sameNames'=>''],
//            ['id'=> '' ,'firstChar' => '', 'name'=> '' ,'sex'=>'', 'baseCulture'=>'','sameNames'=>''],
//            ['id'=> '' ,'firstChar' => '', 'name'=> '' ,'sex'=>'', 'baseCulture'=>'','sameNames'=>''],
//            ['id'=> '' ,'firstChar' => '', 'name'=> '' ,'sex'=>'', 'baseCulture'=>'','sameNames'=>''],
//        ];
    }
}
