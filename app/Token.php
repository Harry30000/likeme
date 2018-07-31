<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Token
 *
 * @property integer $id
 * @property string $user_id
 * @property string $name
 * @property boolean $gender
 * @property string $locale
 * @property boolean $verified
 * @property string $app_id
 * @property string $access_token
 * @method static \Illuminate\Database\Query\Builder|\App\Token whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Token whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Token whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Token whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Token whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Token whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Token whereAppId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Token whereAccessToken($value)
 * @mixin \Eloquent
 */
class Token extends Model
{
    //
}
