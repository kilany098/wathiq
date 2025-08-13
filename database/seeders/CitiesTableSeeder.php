<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
        ['name' => 'Riyadh','name_ar' => 'الرياض'],
        ['name' => 'Makkah','name_ar' => 'مكة'],
        ['name' => 'Madinah','name_ar' => 'المدينة'],
        ['name' => 'Ash-Sharqiyah','name_ar' => 'الشرقية'],
        ['name' => 'Qassim','name_ar' => 'قسيم'],
        ['name' => 'Asir','name_ar' => 'عسير'],
        ['name' => 'Tabuk','name_ar' => 'تبوك'],
        ['name' => 'Hail','name_ar' => 'حايل'],
        ['name' => 'Northern Borders','name_ar' => 'الحدود الشمالية'],
        ['name' => 'Jizan','name_ar' => 'جيزان'],
        ['name' => 'Najran','name_ar' => 'نجران'],
        ['name' => 'Al Bahah','name_ar' => 'الباحة'],
        ['name' => 'Al Jawf','name_ar' => 'الجوف'],
        ['name' => 'Other','name_ar' => 'أخرى'],
    ];

    DB::table('cities')->insert($cities);



    }
}
