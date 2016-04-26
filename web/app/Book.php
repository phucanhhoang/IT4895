<?php
/**
 * Created by IntelliJ IDEA.
 * User: ANHHP
 * Date: 4/6/2016
 * Time: 9:47 AM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';

    public $timestamps = true;

    protected $fillable = array('id', 'title', 'author_id', 'publisher_id', 'genre_id', 'image', 'isbn',
        'description_short', 'description', 'price', 'sale', 'created_at', 'updated_at');
}