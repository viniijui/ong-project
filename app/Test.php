<?php

namespace OngSystem;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Test extends Model
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
		'teacher_id',
		'subject_time_id',
		'weight',
		'day'
	];
}
