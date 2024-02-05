<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services=[
            [
                'service_unit'=>'Perdata',
                'service_name'=>'Pendaftaran Gugatan'
            ],
            [
                'service_unit'=>'Perdata',
                'service_name'=>'Pendaftaran Permohonan'
            ],
            [
                'service_unit'=>'Hukum',
                'service_name'=>'Pendaftaran Surat Kuasa'
            ],
            [
                'service_unit'=>'Hukum',
                'service_name'=>'Pendaftaran Surat Keterangan'
            ],
        ];

        foreach($services as $service){
            Service::create($service);
        }
    }
}
