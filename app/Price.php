<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Price
 *
 * @property integer $id
 * @property integer $price
 * @property integer $like_limit
 * @property integer $comment_limit
 * @property integer $like
 * @property integer $comment
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereLikeLimit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereCommentLimit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Price whereComment($value)
 * @mixin \Eloquent
 */
class Price extends Model
{
    //
}
