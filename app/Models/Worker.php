<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'age',
        'national_id',
        'address',
        'phone',
        'salary',
        'per',
        'store_id',
        'worker_permission',
        'photo',
    ];

    /**
     * The path of the uploaded assets.
     *
     * @var string
     */
    public static $assetsPath = 'storage/images/workers/';

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
