<?php
function getTeacherNameByID($id) {
	$teacher = OngSystem\Teacher::where('id', $id)->first();
	return $teacher->name;
}

function countClassesBySubjectID($id, $teacher = '') {
	if ($teacher !== '') {
		return OngSystem\SubjectTime::where(['subject_id' => $id, 'teacher_id' => $teacher])->count();
	} else {
		return OngSystem\SubjectTime::where('subject_id', $id)->count();
	}
}

function getSubjectNameByID($id) {
	$subject = OngSystem\Subject::where('id', $id)->first();
	return $subject->name;
}

function getSubjectIDBySubjectTimeID($id) {
	$subject = OngSystem\SubjectTime::where('id', $id)->first();
	return $subject->subject_id;
}

function getPatrimonyNameByID($id) {
	$patrimony = OngSystem\Patrimony::where('id', $id)->first();
	return $patrimony->name;
}

function setRoleToUser($user, $role) {
	$roles = OngSystem\Role::where('name', $role)->first();
	$users = OngSystem\User::where('id', $user)->first();
	if($users->attachRole($roles)) return true;
	return false;
}

function getTeacherByUserID() {
	if (! \Auth::user()->hasRole('teacher')) return false;
	$teacher = OngSystem\Teacher::where('user_id', \Auth::user()->id)->first();
	if (!$teacher) return false;
	return $teacher;
}

function getSubjectsByTeacher() {
	if(getTeacherByUserID() == false) return false;
	$subject = \DB::connection('mysql')->select(DB::raw('
		SELECT sub.*, subt.week_day as day FROM subjects AS sub, subject_times AS subt
		WHERE subt.teacher_id = '.getTeacherByUserID()->id.'
		AND sub.id = subt.subject_id
		ORDER BY sub.id
	'));

	if(!$subject) return false;
	return $subject;
}

function setFirstName($string) {
	$arr = explode(' ', $string);
	return $arr[0];
}

function getNextTests() {
	return $subject = \DB::connection('mysql')->select(DB::raw('
		SELECT tests.name as name, subjects.name as subject, tests.day as day FROM tests, subjects, subject_times
		WHERE tests.teacher_id =  '.getTeacherByUserID()->id.'
		AND subject_times.id = tests.subject_time_id
		AND subjects.id = subject_times.subject_id
		AND day >= CURDATE()
	'));
}

function checkAndGetNotationByTestAndStudent($test_id, $student_id) {
	$notation = OngSystem\Notation::where(['test_id' => $test_id, 'student_id' => $student_id])->first();
	if ($notation !== null) return $notation->nota;
	return false;
}

function getTestByID($id) {
	$test = OngSystem\Test::where('id', $id)->first();
	if ($test) return $test;
	return false;
}

function getClassToday() {
	$data = date('Y-m-d');
	$subject = \DB::connection('mysql')->select(DB::raw('
		SELECT subjects.name as subject, subject_times.place as place FROM subjects, subject_times
		WHERE subject_times.teacher_id = '.getTeacherByUserID()->id.'
		AND subject_times.week_day = '.date('w', strtotime($data)).'
		AND subjects.id = subject_times.subject_id
	'));
	if (sizeof($subject) > 0) return $subject;
	return false;
}

function getEvents() {
	$event = OngSystem\Event::where('situation', 1)->get();
	$arrayJson = [];
	$i=0;
	foreach ($event as $row) {
		$arrayJson[$i]['title'] = $row->name;
		$arrayJson[$i]['start'] = $row->begin_date;
		$arrayJson[$i]['end'] = $row->end_date;
		$arrayJson[$i]['description'] = $row->description;
		$arrayJson[$i]['backgroundColor'] = "#00c0ef";
		$arrayJson[$i]['place'] = $row->place;
		$i++;
	}

	return json_encode($arrayJson);
}

function weekDay($day) {
	$days = [1 => 'Segunda Feira', 2 => 'Terça Feira', 3 => 'Quarta Feira', 4 => 'Quinta Feira', 5 => 'Sexta Feira', 6 => 'Sabado'];
	return $days[$day];
}
