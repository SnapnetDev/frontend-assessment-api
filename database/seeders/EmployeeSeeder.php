<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 40 active fulltime employees
        Employee::factory()->count(40)->active()->fulltime()->create();

        // Create 20 contract employees
        Employee::factory()->count(20)->create(['employment_type' => 'contract']);

        // Create 10 onboarding employees
        Employee::factory()->count(10)->onboarding()->create();
    }
}
