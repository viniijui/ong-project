<?php

namespace OngSystem;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Teacher extends Model
{

	use Sluggable;

	public function sluggable()
	{
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}

	protected $fillable = [
		'name',
		'cpf',
		'address',
		'begin_date',
		'end_date',
		'situation',
		'user_id'
	];


}
