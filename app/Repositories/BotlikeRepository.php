<?php

namespace App\Repositories;

use App\Models\Botlike;
use InfyOm\Generator\Common\BaseRepository;

class BotlikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'facebook_id',
        'name',
        'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Botlike::class;
    }
}
