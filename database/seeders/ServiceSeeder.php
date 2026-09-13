<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
         = [
            [
                'name' => 'Web Development',
                'description' => 'Custom website development using modern technologies',
                'price' => 500000,
                'category' => 'development',
            ],
            [
                'name' => 'Software Development',
                'description' => 'Custom software solutions for businesses',
                'price' => 1000000,
                'category' => 'development',
            ],
            [
                'name' => 'Graphics Design',
                'description' => 'Professional graphics design services',
                'price' => 100000,
                'category' => 'design',
            ],
            [
                'name' => 'IT Consultation',
                'description' => 'Expert IT consultation and advisory services',
                'price' => 200000,
                'category' => 'consultation',
            ],
            [
                'name' => 'Printing Services',
                'description' => 'High-quality printing services',
                'price' => 50000,
                'category' => 'printing',
            ],
            [
                'name' => 'Branding',
                'description' => 'Complete branding and identity solutions',
                'price' => 300000,
                'category' => 'branding',
            ],
        ];

        foreach ( as ) {
            Service::create();
        }
    }
}
