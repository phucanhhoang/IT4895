<?php
/**
 * Created by IntelliJ IDEA.
 * User: ANHHP
 * Date: 4/6/2016
 * Time: 9:47 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreDetail extends Model
{
    protected $table = 'genre_detail';

    public $timestamps = false;

    protected $fillable = array('id', 'name', 'genre_id');
}