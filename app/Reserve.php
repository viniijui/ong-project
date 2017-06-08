<?php

namespace OngSystem;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
	protected $fillable = [
		'day',
		'user_id',
		'event_id',
		'subject_time_id',
		'patrimony_id'
	];
}
