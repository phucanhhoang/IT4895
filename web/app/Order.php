<?php
/**
 * Created by IntelliJ IDEA.
 * User: ANHHP
 * Date: 4/6/2016
 * Time: 9:47 AM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    public $timestamps = true;

    protected $fillable = array('id', 'customer_id', 'note', 'ship_time', 'shipped', 'seen', 'deleted', 'created_at', 'updated_at');
}