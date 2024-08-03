<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $fillable = [
        'category_id',
        'store_id',
        'name',
        'slug',
        'description',
        'price',
        'compare_price',
        'featured',
        'status'
    ];

    public static function booted()
    {

        static::addGlobalScope(StoreScope::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,             // related model
            'product_tag',          // pivot table name
            'product_id',           // FK in pivot table for current model
            'tag_id',               // FK in pivot table for related model
            'id',                   // PK in current model
            'id'                    // PK in related model
        );
    }

    public function getStatusClassAttribute()
    {
        if ($this->status == 'active') {
            return 'success';
        }
        if ($this->status == 'draft') {
            return 'warning';
        }
        if ($this->status == 'archived') {
            return 'dark';
        }
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }

    public function scopeFeatured(Builder $builder)
    {
        $builder->where('featured', 1);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 1);
    }
}
