<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Botlike
 * @package App\Models
 * @version September 24, 2016, 6:52 am ICT
 */
class Botlike extends Model
{

    public $table = 'botlikes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'facebook_id',
        'name',
        'like'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'facebook_id' => 'string',
        'name' => 'string',
        'like' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
