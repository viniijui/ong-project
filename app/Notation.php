<?php

namespace OngSystem;

use Illuminate\Database\Eloquent\Model;

class Notation extends Model
{
	protected $fillable = [
		'student_id',
		'test_id',
		'nota'
	];
}
