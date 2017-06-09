<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\SubjectTime;
use OngSystem\Teacher;
use OngSystem\Subject;
use OngSystem\Student;

class ClassController extends Controller
{
	private $subjectTimeModel;
	private $subjectModel;
	private $teacherModel;
	private $studentModel;

	public function __construct(SubjectTime $subjectTimeModel, Teacher $teacherModel, Subject $subjectModel, Student $studentModel)
	{
		$this->subjectTimeModel = $subjectTimeModel;
		$this->subjectModel = $subjectModel;
		$this->teacherModel = $teacherModel;
		$this->studentModel = $studentModel;
	}

	public function roll($slug ='') {
		if ($slug != '') {
			$subject = $this->subjectModel->select('id', 'name')->where('slug', $slug)->first();
			$title = 'Turmas da materia: '.$subject->name;
			if(\Auth::user()->hasRole('teacher')) {
				$teacher = getTeacherByUserID();
				$data = $this->subjectTimeModel->where(['subject_id' => $subject->id, 'teacher_id' => $teacher->id])->get();
				$no_tools = true;
			} else {
				$data = $this->subjectTimeModel->where('subject_id', $subject->id)->get();
			}
			$back = 'admin.subject.list';
		}

		$create = true;
		$icon = 'fa fa-file-text-o';
		$controller = 'admin.subject.time';

		if(\Auth::user()->hasRole('teacher')) {
			$table_content = array(
				"Ano" => 'year',
				"Semestre" => 'half_class',
				"Provas" => 'subject_tests',
				"Situação" => 'situation'
			);
		} else {
			$table_content = array(
				"Ano" => 'year',
				"Semestre" => 'half_class',
				"Professor" => 'teacher_class',
				"Situação" => 'situation_aux',
				"Alunos" => 'subject_student'
			);
		}

		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create', 'back', 'no_tools', 'slug'));
	}

	public function create() {
		$title = 'Cadastrar Turma';
		$icon = 'fa fa-calendar-o';
		$route_form = 'admin.subject.time.store';
		$teacher = $this->teacherModel->select('name', 'slug')->where('situation', 1)->get();
		if ($teacher) {
			$array_teacher = [];
			foreach ($teacher as $row) {
				$array_teacher[$row->slug] = $row->name;
			}
		}
		$subject = $this->subjectModel->select('name', 'slug')->where('situation', 1)->get();
		if ($subject) {
			$array_subject = [];
			foreach ($subject as $row) {
				$array_subject[$row->slug] = $row->name;
			}
		}
		return view('subject.form_class', compact('title', 'icon', 'route_form', 'array_teacher','array_subject'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$subject_by_input = $this->subjectModel->select('id', 'name', 'slug')->where('slug', $input['subject'])->first();
		$input['subject_id'] = $subject_by_input->id;
		$teacher = $this->teacherModel->select('id', 'slug')->where('slug', $input['teacher'])->first();
		$input['teacher_id'] = $teacher->id;
		if (isset($input['teacher2']) and $input['teacher2'] != 0) {
			$teacher = $this->teacherModel->select('slug', 'name', 'id')->where('slug', $input['teacher2'])->first();
			$input['teacher2_id'] = $teacher->id;
		}
		$subject = $this->subjectTimeModel->fill($input);
		if($subject->save()) {
			return redirect()->route('admin.subject.time.edit', $subject->id)->with('success', 'Turma cadastrada com sucesso!');
		} else {
			return redirect()->route('admin.subject.time.edit', $subject->id)->with('danger', 'Erro ao cadastrar turma, tente novamente.');
		}
	}

	public function edit($slug) {
		$icon = 'fa fa-calendar-o';
		$route_form = ['admin.subject.time.update', $slug];
		$data = $this->subjectTimeModel->where('id', $slug)->first();
		$subject_data = $this->subjectModel->where('id', $data->subject_id)->first();
		$back = $subject_data->slug;
		$title = 'Editar Turma: '.$data->year;
		$first_teacher = $this->teacherModel->where('id', $data->teacher_id)->first()->slug;
		if ($data->teacher2_id) {
			$second_teacher = $this->teacherModel->where('id', $data->teacher2_id)->first()->slug;
		}
		$teacher = $this->teacherModel->select('name', 'slug')->where('situation', 1)->get();
		if ($teacher) {
			$array_teacher = [];
			foreach ($teacher as $row) {
				$array_teacher[$row->slug] = $row->name;
			}
		}
		$subject = $this->subjectModel->select('name', 'slug')->where('situation', 1)->get();
		if ($subject) {
			$array_subject = [];
			foreach ($subject as $row) {
				$array_subject[$row->slug] = $row->name;
			}
		}
		return view('subject.form_class', compact('title', 'icon', 'route_form', 'back', 'data', 'array_teacher', 'first_teacher', 'second_techer', 'array_subject'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$subject_by_input = $this->subjectModel->select('id', 'name', 'slug')->where('slug', $input['subject'])->first();
		$input['subject_id'] = $subject_by_input->id;
		$teacher = $this->teacherModel->select('id')->where('slug', $input['teacher'])->first();
		$input['teacher_id'] = $teacher->id;
		if (isset($input['teacher2']) and $input['teacher2'] != 0) {
			$teacher = $this->teacherModel->select('id')->where('slug', $input['teacher2'])->first();
			$input['teacher2_id'] = $teacher->id;
		}
		$subject = $this->subjectTimeModel->where('id', $slug)->first();
		if($subject->update($input)) {
			return redirect()->route('admin.subject.time.edit', $subject->id)->with('success', 'Registro alterado com sucesso!');
		} else {
			return redirect()->route('admin.subject.time.edit', $subject->id)->with('danger', 'Erro ao alterar registro, tente novamente.');
		}
	}

	public function situation($id, $situation, $subject_slug) {
		$subject = $this->subjectTimeModel->where('id', $id)->first();
		$subject->situation = $situation;
		if($subject->save()) {
			return redirect()->route('admin.subject.time.list', $subject_slug)->with('success', 'Situação alterada com sucesso!');
		} else {
			return redirect()->route('admin.subject.time.list', $subject_slug)->with('danger', 'Erro ao alterar a situação, tente novamente.');
		}
	}

	public function student($id) {
		$data = $this->subjectTimeModel->find($id)->student()->get();
		$student = $this->studentModel->get();
		$options = [];
		foreach ($student as $row) {
			$options[$row->id] = $row->name;
		}
		$title = 'Alunos';
		$icon = 'fa-users';
		return view('subject.student', compact('data', 'title', 'icon', 'student', 'id', 'options'));
	}

	public function studentStore(Request $request, $id) {
		$input = $request->all();
		$data = $this->subjectTimeModel->where('id', $id)->first()->student()->attach($input['student']);
		return redirect()->route('admin.subject.time.student', $id)->with('success', 'Aluno vinculado com sucesso');
	}

	public function studentDelete($student, $id) {
		$data = $this->subjectTimeModel->where('id', $id)->first()->student()->detach($student);
		return redirect()->route('admin.subject.time.student', $id)->with('success', 'Aluno desvinculado!');
	}
}
