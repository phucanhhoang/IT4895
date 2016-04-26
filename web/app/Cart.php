<?php
/**
 * Created by IntelliJ IDEA.
 * User: ANHHP
 * Date: 4/6/2016
 * Time: 9:47 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    public $timestamps = true;

    protected $fillable = array('id', 'user_id', 'book_id', 'quantity', 'create_at', 'update_at');

    protected $hidden = array('remember_token');
}