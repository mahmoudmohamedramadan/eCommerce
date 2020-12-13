<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'address',
        'phone',
        'salary',
        'per',
        'store_id',
        'photo',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
