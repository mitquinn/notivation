<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

	protected $fillable = [
		'name'
	];

	protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function notes()
    {
    	return $this->belongsToMany('App\Notes');
    }
}
