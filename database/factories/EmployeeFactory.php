<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition()
    {
        $departments = ['data', 'backend', 'frontend', 'sales'];
        $jobTitle = ['Backend developer', 'Frontend Developer', 'Sales Representative', 'Data Analyst'];
        $employmentTypes = ['fulltime', 'contract'];
        $statuses = ['active', 'inactive', 'leave', 'onboarding'];
        $managers = ['Mr. Blue', 'Mr. Pink', 'Mr. Brown', 'Mr. Black'];

        return [
            'full_name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'name_nok' => $this->faker->name(), // Name of Next of Kin
            'image_url' => $this->faker->imageUrl(640, 480, 'animals', true), // Name of Next of Kin
            'job_title' => $this->faker->randomElement($jobTitle),
            'spouse' => $this->faker->optional(0.7)->name(), // 70% chance of having a spouse
            'dob' => $this->faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_no' => $this->faker->phoneNumber(),
            'phone_no_nok' => $this->faker->phoneNumber(),
            'department' => $this->faker->randomElement($departments),
            'address' => $this->faker->address(),
            'location' => $this->faker->city(),
            'employment_type' => $this->faker->randomElement($employmentTypes),
            'start_date' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'status' => $this->faker->randomElement($statuses),
            'current_salary' => $this->faker->numberBetween(30000, 150000),
            'manager' => $this->faker->randomElement($managers),
        ];
    }

    /**
     * Configure the model factory with specific states
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
            ];
        });
    }

    public function fulltime()
    {
        return $this->state(function (array $attributes) {
            return [
                'employment_type' => 'fulltime',
            ];
        });
    }

    public function onboarding()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'onboarding',
                'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            ];
        });
    }

    public function withHighSalary()
    {
        return $this->state(function (array $attributes) {
            return [
                'current_salary' => $this->faker->numberBetween(100000, 200000),
            ];
        });
    }
}
