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
    protected $morphClass = 'MorphCustomer';
    protected $table = 'customer';

    public $timestamps = false;

    protected $fillable = array('name', 'address', 'phone');

    public function users() {
        return $this->morphMany('App\User', 'userable');
    }

}