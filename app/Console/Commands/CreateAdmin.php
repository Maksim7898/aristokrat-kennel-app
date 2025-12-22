<?php

namespace App\Console\Commands;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    protected $signature = 'create-admin';

    protected $description = 'Create admin account';

    protected $aliases = [
        'make:admin',
    ];

    public function handle(): int
    {
        $email = $this->ask('Email администратора', 'admin@example.com');
        $password = $this->secret('Пароль администратора') ?? 'admin';
        $fullName = $this->ask('ФИО администратора', 'Admin');
        $phone = $this->ask('Телефон администратора', '+79124567890');
        $city = $this->ask('Город администратора', 'Москва');
        $petExperience = $this->ask('Опыт с животными', 'Нет опыта');
        $livingConditions = $this->ask('Условия проживания', 'Хорошие');

        $user = User::create([
            'email' => $email,
            'password' => $password,
            'full_name' => $fullName,
            'phone' => $phone,
            'city' => $city,
            'role' => UserRoleEnum::ADMIN,
            'pet_experience' => $petExperience,
            'living_conditions' => $livingConditions,
        ]);

        $this->info("Аккаунт {$user->email} создан!");

        return self::SUCCESS;
    }
}
