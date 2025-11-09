<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'auth_provider'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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
