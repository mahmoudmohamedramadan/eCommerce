<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
