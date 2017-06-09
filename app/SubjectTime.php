<?php

namespace OngSystem;

use Illuminate\Database\Eloquent\Model;

class SubjectTime extends Model
{
	protected $fillable = [
		'situation',
		'subject_id',
		'teacher_id',
		'teacher2_id',
		'situation',
		'year',
		'half',
		'week_day',
		'place'
	];

	public function student()	{
		return $this->belongsToMany('OngSystem\Student')->withTimestamps();
	}
}
