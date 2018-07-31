<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Price
 * @package App\Models
 * @version September 20, 2016, 7:47 pm ICT
 */
class Price extends Model
{

    public $table = 'prices';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'price',
        'like_limit',
        'comment_limit',
        'like',
        'comment',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'integer',
        'like_limit' => 'integer',
        'comment_limit' => 'integer',
        'like' => 'integer',
        'comment' => 'integer',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
