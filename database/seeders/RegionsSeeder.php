<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("insert into `regions` (`code`, `name_ar`, `name_en`)
values
('RD', 'منطقة الرياض', 'Riyadh'),
('MQ', 'منطقة مكة المكرمة', 'Makkah'),
('MN', 'منطقة المدينة المنورة', 'Madinah'),
('QA', 'منطقة القصيم', 'Qassim'),
('SQ', 'المنطقة الشرقية', 'Eastern Province'),
('AS', 'منطقة عسير', 'Asir'),
('TB', 'منطقة تبوك', 'Tabuk'),
('HA', 'منطقة حائل', 'Hail'),
('SH', 'منطقة الحدود الشمالية', 'Northern Borders'),
('GA', 'منطقة جازان', 'Jazan'),
('NG', 'منطقة نجران', 'Najran'),
('BA', 'منطقة الباحة', 'Bahah'),
('GO', 'منطقة الجوف', 'Jawf')
");
    }
}
