<?php
function getTeacherNameByID($id) {
	$teacher = OngSystem\Teacher::where('id', $id)->first();
	return $teacher->name;
}

function countClassesBySubjectID($id) {
	return OngSystem\SubjectTime::where('subject_id', $id)->count();
}

function getSubjectNameByID($id) {
	$subject = OngSystem\Subject::where('id', $id)->first();
	return $subject->name;
}

function getSubjectIDBySubjectTimeID($id) {
	$subject = OngSystem\SubjectTime::where('id', $id)->first();
	return $subject->subject_id;
}