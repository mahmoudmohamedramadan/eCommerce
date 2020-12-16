<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'details',
        'pay_date',
        'remember_date',
    ];

    public function scopeNotification($query)
    {
        return $query->where('remember_date', date('Y-m-d'))->select('id', 'title', 'details', 'pay_date');
    }
}
