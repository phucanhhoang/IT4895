<?php
/**
 * Created by IntelliJ IDEA.
 * User: ANHHP
 * Date: 4/6/2016
 * Time: 9:47 AM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publisher';

    public $timestamps = false;

    protected $fillable = array('id', 'name', 'country', 'short_intro');
}