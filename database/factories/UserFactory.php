<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory {

    public function definition() {
        return [
            'name' => fake()->name(),
            'username' => fake()->username(),
            'type' => fake()->type(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified() {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    
}
