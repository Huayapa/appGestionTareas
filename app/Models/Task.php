<?php

namespace App\Models;

use Carbon\Carbon;
use MongoDB\Laravel\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'user_assigned'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_assigned', 'id');
    }

    public function getUserAKA() : ?string
    {
        $aka = collect(explode(' ', $this->user->name))->take(2)->map(fn($word) => strtoupper($word[0]))->implode('');

        return $aka;
    }

    public function isDueSoon(): bool
    {
        if (!$this->due_date) {
            return false;
        }

        return Carbon::today()->diffInDays(Carbon::parse($this->due_date)) <= 3;
    }

    public function getDueStatus(): ?string
    {
        if (!$this->due_date) {
            return null;
        }

        $daysUntilDue = Carbon::today()->diffInDays(Carbon::parse($this->due_date));

        // dd(Carbon::today());
        // dd(Carbon::parse('2025-11-09'));
        // dd($daysUntilDue);

        if ($daysUntilDue < 0) {
            return 'Vencido';
        } elseif ($daysUntilDue == 0) {
            return 'Vence Hoy';
        } elseif ($daysUntilDue <= 3) {
            return 'Vence pronto';
        }

        return null;
    }
}
