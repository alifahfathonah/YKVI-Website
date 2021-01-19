<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable, SoftDeletes;

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
    	'name',
        'description',
        'detail',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the relationship for the model.
     */
    public function product_details()
    {
        return $this->hasMany('Modules\MasterData\Entities\ProductDetail', 'product_id');
    }

    /**
     * Get the relationship for the model.
     */
    public function product_category()
    {
        return $this->belongsTo('Modules\MasterData\Entities\ProductCategory', 'category_id');
    }
}
