<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
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
        ];
    }

    // Filament-specific method
    public function canAccessFilament(): bool
    {
        // For testing, allow all users access
        return true;

        // Later you can replace with a role check, e.g.:
        // return $this->is_admin === 1;
    }

    // Optional: your preferred timezone helper
    public function getPreferredTimezone(): string
    {
        return $this->timezone ?? config('app.timezone', 'Europe/Amsterdam');
    }
}
