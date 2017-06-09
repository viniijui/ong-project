<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Test;
use OngSystem\Teacher;
use OngSystem\Subject;
use OngSystem\SubjectTime;
use OngSystem\Student;
use OngSystem\Notation;

class TestController extends Controller
{
	private $testModel;
	private $subjectModel;
	private $subjectTimeModel;
	private $teacherModel;
	private $studentModel;
	private $notationModel;

	public function __construct(Test $testModel, Teacher $teacherModel, Subject $subjectModel, SubjectTime $subjectTimeModel, Student $studentModel, Notation $notationModel)
	{
		$this->testModel = $testModel;
		$this->subjectModel = $subjectModel;
		$this->subjectTimeModel = $subjectTimeModel;
		$this->teacherModel = $teacherModel;
		$this->studentModel = $studentModel;
		$this->notationModel = $notationModel;
	}

	public function roll($subject_id='')
	{
		if (\Auth::user()->hasRole('teacher')) {
			$pass_add = true;
			if ($subject_id !== '') {
				$data = $this->testModel->where(['subject_time_id' => $subject_id, 'teacher_id' => getTeacherByUserID()->id])->get();
			} else {
				$data = $this->testModel->where('teacher_id', getTeacherByUserID()->id)->get();
			}
		} else {
			if ($subject_id !== '') {
				$data = $this->testModel->where('subject_time_id', $subject_id)->get();
			} else {
				$data = $this->testModel->get();
			}
		}
		$create = true;
		$title = 'Provas';
		$icon = 'fa fa-file-text';
		$controller = 'admin.test';
		$table_content = array(
			"Nome" => 'name',
			"Peso" => 'weight',
			"Dia" => 'day_br',
			"Materia" => 'subject_name',
			"Notas" => 'notation',
			"Situação" => 'situation'
		);

		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create', 'pass_add', 'subject_id'));
	}

	public function create() {
		$title = 'Cadastrar prova';
		$icon = 'fa fa-file-text';
		$route_form = 'admin.test.store';
		$back = 'admin.test.list';
		$teacher = $this->teacherModel->select('name', 'slug')->where('situation', 1)->get();
		$subject = $this->subjectTimeModel->where(['situation' => 1, 'teacher_id' => getTeacherByUserID()->id])->get();
		if ($subject) {
			$array_subject = [];
			foreach ($subject as $row) {
				$array_subject[$row->id] = getSubjectNameByID($row->subject_id).' - '.$row->year.' - '.($row->half == '1-semestre' ? '1º Semestre' : '2º Semestre');
			}
		}
		return view('test.form', compact('title', 'icon', 'route_form', 'back', 'array_teacher', 'array_subject'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$input['subject_time_id'] =$input['subject'];
		$input['teacher_id'] = getTeacherByUserID()->id;
		$test = $this->testModel->fill($input);
		if($test->save()) {
			return redirect()->route('admin.test.edit', $test->slug)->with('success', 'Prova cadastrada com sucessso!');
		} else {
			return redirect()->route('admin.test.edit', $test->slug)->with('danger', 'Erro ao cadastrar prova. Por gentileza, tente novamente.');
		}

	}

	public function edit($slug) {
		$icon = 'fa fa-file-text';
		$route_form = ['admin.test.update', $slug];
		$back = 'admin.test.list';
		$data = $this->testModel->where('slug', $slug)->first();
		$title = 'Editar prova: '.$data->name;
		$teacher = $this->teacherModel->select('name', 'slug')->where('situation', 1)->get();
		$subject = $this->subjectTimeModel->where(['situation' => 1, 'teacher_id' => getTeacherByUserID()->id])->get();
		if ($subject) {
			$array_subject = [];
			foreach ($subject as $row) {
				$array_subject[$row->id] = getSubjectNameByID($row->subject_id).' - '.$row->year.' - '.($row->half == '1-semestre' ? '1º Semestre' : '2º Semestre');
			}
		}

		$get_teacher_input = $this->teacherModel->where('id', $data->teacher_id)->first();
		$input_teacher = $get_teacher_input->slug;

		return view('test.form', compact('title', 'icon', 'route_form', 'back', 'data', 'array_teacher', 'array_subject'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$input['subject_time_id'] =$input['subject'];
		$input['teacher_id'] = getTeacherByUserID()->id;
		$test = $this->testModel->where('slug', $slug)->first();
		if($test->update($input)) {
			return redirect()->route('admin.test.edit', $test->slug)->with('success', 'Prova cadastrada com sucessso!');
		} else {
			return redirect()->route('admin.test.edit', $test->slug)->with('danger', 'Erro ao cadastrar prova. Por gentileza, tente novamente.');
		}
	}

	public function situation($slug, $situation) {

		$test = $this->testModel->where('slug', $slug)->first();
		$test->situation = $situation;
		if($test->save()) {
			return redirect()->route('admin.test.list')->with('success', 'Situação alterada com sucesso!');
		} else {
			return redirect()->route('admin.test.list')->with('danger', 'Erro ao alterar situação. Por gentileza, tente novamente.');
		}
	}

	public function notation($subject, $test) {
		$data = $this->subjectTimeModel->find($subject)->student()->get();
		$title = 'Cadastro de notas';
		$icon = 'fa-users';
		return view('test.notation', compact('data', 'title', 'icon', 'test', 'subject'));
	}

	public function notationStore(Request $request, $student, $test, $subject) {
		$input = $request->all();
		$input['student_id'] = $student;
		$input['test_id'] = $test;
		$notation = $this->notationModel->fill($input);
		if($notation->save()) {
			return redirect()->route('admin.test.notation', ['subject' => $subject, 'test' => $test])->with('success', 'Nota cadastrado com sucessso!');
		} else {
			return redirect()->route('admin.test.notation', ['subject' => $subject, 'test' => $test])->with('danger', 'Erro ao cadastrar Nota. Por gentileza, tente novamente.');
		}
	}

	public function notationUpdate(Request $request, $student, $test, $subject) {
		$input = $request->all();
		$notation = $this->notationModel->where(['test_id' => $test, 'student_id' => $student])->first();
		$notation->nota = $input['nota'];
		if($notation->save()) {
			return redirect()->route('admin.test.notation', ['subject' => $subject, 'test' => $test])->with('success', 'Nota editada com sucessso!');
		} else {
			return redirect()->route('admin.test.notation', ['subject' => $subject, 'test' => $test])->with('danger', 'Erro ao editar Nota. Por gentileza, tente novamente.');
		}
	}
}
