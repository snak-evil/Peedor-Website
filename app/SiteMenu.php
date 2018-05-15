<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteMenu extends Model
{
    protected $table='site_menus';
    protected $primaryKey='id';
    protected $fillable=[
    	'text',
    	'path',
    	'parent_id'
    ];
}
