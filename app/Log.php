<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Log
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $object_id
 * @property integer $like
 * @property integer $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereObjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Log extends Model
{
    //
}
