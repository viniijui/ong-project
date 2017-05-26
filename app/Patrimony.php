<?php

namespace OngSystem;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Patrimony extends Model
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
		'key',
		'qtd',
		'price',
		'situation'
	];
}
