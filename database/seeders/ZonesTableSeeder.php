<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
        ['name' => 'Riyadh','name_ar' => 'الرياض','city_id'=>1],
        ['name' => 'Diriyah','name_ar' => 'الدرعية','city_id'=>1],
        ['name' => 'Al Kharj','name_ar' => 'الخرج','city_id'=>1],
        ['name' => 'Al Majmaah','name_ar' => 'المجمعة','city_id'=>1],
        ['name' => 'Al Duwadimi','name_ar' => 'الدوادمي','city_id'=>1],
        ['name' => 'Mecca','name_ar' => 'مكة','city_id'=>2],
        ['name' => 'Jeddah','name_ar' => 'جدة','city_id'=>2],
        ['name' => 'Taif','name_ar' => 'الطائف','city_id'=>2],
        ['name' => 'Al Qunfudhah','name_ar' => 'قنفذة','city_id'=>2],
        ['name' => 'Al Lith','name_ar' => 'الليث','city_id'=>2],
        ['name' => 'Medina','name_ar' => 'المدينة','city_id'=>3],
        ['name' => 'Yanbu','name_ar' => 'ينبع','city_id'=>3],
        ['name' => 'Badr','name_ar' => 'بدر','city_id'=>3],
        ['name' => 'Khaybar','name_ar' => 'خيبر','city_id'=>3],
        ['name' => 'Dammam','name_ar' => 'الدمام','city_id'=>4],
        ['name' => 'Khobar','name_ar' => 'خبر','city_id'=>4],
        ['name' => 'Dhahran','name_ar' => 'الظهران','city_id'=>4],
        ['name' => 'Hofuf','name_ar' => 'الهفوف','city_id'=>4],
        ['name' => 'Jubail','name_ar' => 'الجبيل','city_id'=>4],
        ['name' => 'Qatif','name_ar' => 'القطيف','city_id'=>4],
        ['name' => 'Buraidah','name_ar' => 'بريدة','city_id'=>5],
        ['name' => 'Unaizah','name_ar' => 'عنيزة','city_id'=>5],
        ['name' => 'Al Rass','name_ar' => 'الراس','city_id'=>5],
        ['name' => 'Abha','name_ar' => 'أبها','city_id'=>6],
        ['name' => 'Khamis','name_ar' => 'خميس','city_id'=>6],
        ['name' => 'Najran','name_ar' => 'نجران','city_id'=>6],
        ['name' => 'Tabuk','name_ar' => 'تبوك','city_id'=>7],
        ['name' => 'Al Wajh','name_ar' => 'الوجه','city_id'=>7],
        ['name' => 'Haql','name_ar' => 'حقل','city_id'=>7],
        ['name' => 'Hail','name_ar' => 'حايل','city_id'=>8],
        ['name' => 'Al Ghazalah','name_ar' => 'الغزالة','city_id'=>8],
        ['name' => 'Arar','name_ar' => 'عرعر','city_id'=>9],
        ['name' => 'Turaif','name_ar' => 'طريف','city_id'=>9],
        ['name' => 'Jizan','name_ar' => 'جازان','city_id'=>10],
        ['name' => 'Sabya','name_ar' => 'صبيا','city_id'=>10],
        ['name' => 'Farasan','name_ar' => 'فرسان','city_id'=>10],
        ['name' => 'Najran','name_ar' => 'نجران','city_id'=>11],
        ['name' => 'Sharurah','name_ar' => 'شرورة','city_id'=>11],
        ['name' => 'Al Bahah','name_ar' => 'الباحة','city_id'=>12],
        ['name' => 'Baljurashi','name_ar' => 'بلجرشي','city_id'=>12],
        ['name' => 'Sakaka','name_ar' => 'سكاكا','city_id'=>13],
        ['name' => 'Qurayyat','name_ar' => 'القريات','city_id'=>13],
        ['name' => 'NEOM','name_ar' => 'نيوم','city_id'=>14],
        ['name' => 'King Abdullah Economic City','name_ar' => 'مدينة الملك عبدالله الاقتصادية','city_id'=>14],
        ['name' => 'Ras Tanura','name_ar' => 'رأس تنورة','city_id'=>14],
        ['name' => 'Al Khafji','name_ar' => 'الخفجي','city_id'=>14],
        ['name' => 'Dhurma','name_ar' => 'دورما','city_id'=>14],
        ['name' => 'Al Artawiyah','name_ar' => 'الأرطاوية','city_id'=>14],
        ['name' => 'Tarout Island','name_ar' => 'جزيرة تاروت','city_id'=>14],
    
    ];

    DB::table('zones')->insert($zones);
    }
}
