<?php

namespace Modules\MasterData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class ProductDetail extends Model
{
    use Sluggable, SoftDeletes;

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_product_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'product_id',
        'product_image',
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
     * The attributes that should be appends for arrays.
     *
     * @var array
     */
    protected $appends = [
        'url_product_image',
    ];

    /**
     * Get the model's url ktp pemohon file.
     *
     * @param  string  $value
     * @return string
     */
    public function getUrlProductImageAttribute()
    {
        return (!empty($this->attributes['product_image'])) ? Storage::disk('public')->url('app/public/product/product_image/'.$this->attributes['product_image']) : null;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['product_id']
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
    public function product()
    {
        return $this->belongsTo('Modules\MasterData\Entities\Product', 'product_id');
    }
}
