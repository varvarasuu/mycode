<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function randomPassword() {
        $pass = array();
        $alphabet_small = 'abcdefghijklmnopqrstuvwxyz';
        $alphabet_big = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $special_symbols = '!@#$%^&*()~[]{}';
        $alphaSmallLength = strlen($alphabet_small) - 1; //put the length -1 in cache
        $alphaBigLength = strlen($alphabet_big) - 1;
        $symbolsLength = strlen($special_symbols) - 1;
        for ($i = 0; $i < 4; $i++) {
            $n = rand(0, $alphaBigLength);
            $pass[] = $alphabet_big[$n];
        }
        for ($i = 0; $i < 4; $i++) {
            $n = rand(0, $alphaSmallLength);
            $pass[] = $alphabet_small[$n];
        }
        for ($i = 0; $i < 4; $i++) {
            $n = rand(0, 9);
            $pass[] = $n;
        }
        for ($i = 0; $i < 2; $i++) {
            $n = rand(0, $symbolsLength);
            $pass[] = $special_symbols[$n];
        }

        shuffle($pass);
        return implode($pass);
    }

    public function definition(): array {
        $plain_text_password = $this->randomPassword();
        $email = $this->faker->email();
        $password = Hash::make($plain_text_password);
        $phone_number = $this->faker->e164PhoneNumber();
        echo "  Email: " . $email . " ";
        echo "  Plain_Text_Password: " . $plain_text_password . "\n";
        return [
            'email' => $email,
            'password' => $password,
            'phone_number' => $phone_number,
        ];
    }
}
