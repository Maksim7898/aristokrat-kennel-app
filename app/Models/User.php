<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'full_name',
        'phone',
        'city',
        'role',
        'pet_experience',
        'living_conditions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRoleEnum::class,
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin || $this->is_sales_manager || $this->is_editor;
    }

    public function getFilamentName(): string
    {
        return $this->full_name;
    }

    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->role->value == UserRoleEnum::ADMIN->value
        );
    }

    protected function isSalesManager(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->role->value == UserRoleEnum::SALES_MANAGER->value
        );
    }

    protected function isEditor(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->role->value == UserRoleEnum::EDITOR->value
        );
    }

    protected function isUser(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->role->value === UserRoleEnum::USER->value
        );
    }
}
