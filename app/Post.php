<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='post';
    protected $primaryKey='id';
    protected $fillable=[
    	'title',
    	'body',
    	'status',
    	'numofview',
    	'image',
    	'menu_id'
    ];
}
