<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'store_id',
        'company_id',
        'total_quantity',
        'used_quantity',
        'stored_quantity',
        'minimum_used',
        'minimum_stored',
        'photo',
        'notified',
    ];

    /**
     * The path of the uploaded assets.
     *
     * @var string
     */
    public static $assetsPath = 'storage/images/products/';

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeUnnotifiedProducts($query)
    {
        return $query->where('notified', 0)
            ->whereNotNull('minimum_stored')
            ->select('id', 'name', 'used_quantity', 'stored_quantity', 'minimum_used', 'minimum_stored');
    }
}
