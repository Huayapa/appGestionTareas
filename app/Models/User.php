<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'auth_provider',
        'api_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_assigned', '_id');

    }

    public function getUserAKA(): ?array
    {
        $aka = collect(explode(' ', $this->name))
            ->take(2)
            ->map(fn($word) => strtoupper($word[0]))
            ->implode('');

        // Colores predefinidos que combinan bien
        $colors = [
            '#FF6B6B',
            '#4ECDC4',
            '#45B7D1',
            '#96CEB4',
            '#FFEAA7',
            '#DDA0DD',
            '#98D8C8',
            '#F7DC6F',
            '#BB8FCE',
            '#85C1E9'
        ];

        // Seleccionar color basado en el nombre (siempre el mismo para el mismo nombre)
        $colorIndex = crc32($this->name) % count($colors);
        $color = $colors[$colorIndex];

        return [
            'aka' => $aka,
            'color' => $color,
        ];
    }
}
