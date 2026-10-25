<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'nama'           => fake()->name(),
            'email'          => fake()->unique()->safeEmail(),
            'password'       => static::$password ??= Hash::make('password123'),
            'nis'            => fake()->unique()->numerify('2024######'),
            'kelas'          => fake()->randomElement(['10 IPA 1', '10 IPS 1', '11 IPA 2', '11 IPS 1', '12 IPA 1']),
            'role'           => 'siswa',
            'total_poin'     => 0,
            'remember_token' => Str::random(10),
        ];
    }
}
