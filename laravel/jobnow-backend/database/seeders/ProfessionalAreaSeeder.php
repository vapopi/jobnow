<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionalAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professional_areas')->insert([
            'name'=> 'administration and managements'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'agrarian'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'arts and crafts'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'building and civil works'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'chemistry'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'electricity and electronic'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'energy and water'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'extractive industries'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'food industries'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'glass and ceramic '
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'graphic arts '
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'health service '
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'hostelry and tourism'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'image and sound'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'instalation and maintenance'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'IT and TIC'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'maritime fishing'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'mechanical manufacturing'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'professional image'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'security and environment'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'sociocultural and community services'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'sports physical activities'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'textile, clothing and leather'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'trade and marketing'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'vehicle transportation and maintenance'
        ]);

        DB::table('professional_areas')->insert([
            'name'=> 'wood, furniture and cork'
        ]);
    }
}
