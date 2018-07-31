<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VipUser
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $prices_id
 * @property integer $like_available
 * @property integer $comment_available
 * @property string $begin
 * @property string $end
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\VipUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VipUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VipUser wherePricesId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VipUser whereLikeAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VipUser whereCommentAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VipUser whereBegin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VipUser whereEnd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VipUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VipUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VipUser extends Model
{
    //
}
