<?php

namespace App\Repositories;

use App\Models\Price;
use InfyOm\Generator\Common\BaseRepository;

class PriceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'price',
        'like_limit',
        'comment_limit',
        'like',
        'comment',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Price::class;
    }
}
