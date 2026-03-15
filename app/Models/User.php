<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Filament v5 requires the Panel argument
    public function canAccessPanel(Panel $panel): bool
    {
        // Allow all users for now
        return true;

        // Later, restrict by role, permission, or panel slug:
        // return $this->is_admin === 1;
    }

    // Optional: your preferred timezone
    public function getPreferredTimezone(): string
    {
        return $this->timezone ?? config('app.timezone', 'Europe/Amsterdam');
    }
}
