<?php
/**
 * Created by IntelliJ IDEA.
 * User: ANHHP
 * Date: 4/6/2016
 * Time: 9:47 AM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    public $timestamps = true;

    protected $fillable = array('id', 'name', 'address', 'phone', 'created_at', 'updated_at');

    public function users() {
        return $this->morphMany('App\User', 'userable');
    }

}