<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Test;
use OngSystem\Teacher;
use OngSystem\Subject;
use OngSystem\SubjectTime;

class TestController extends Controller
{
	private $testModel;
	private $subjectModel;
	private $teacherModel;

	public function __construct(Test $testModel, Teacher $teacherModel, Subject $subjectModel, SubjectTime $subjectTimeModel)
	{
		$this->testModel = $testModel;
		$this->subjectModel = $subjectModel;
		$this->subjectTimeModel = $subjectTimeModel;
		$this->teacherModel = $teacherModel;
	}

	public function roll()
	{
		$data = $this->testModel->get();
		$create = true;
		$title = 'Provas';
		$icon = 'fa fa-file-text';
		$controller = 'admin.test';
		$table_content = array(
			"Nome" => 'name',
			"Peso" => 'weight',
			"Dia" => 'day_br',
			"Materia" => 'subject_name',
			"Situação" => 'situation'
		);
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create'));	
	}

	public function create() {
		$title = 'Cadastrar prova';
		$icon = 'fa fa-file-text';
		$route_form = 'admin.test.store';
		$back = 'admin.test.list';
		$teacher = $this->teacherModel->select('name', 'slug')->where('situation', 1)->get();
		if ($teacher) {
			$array_teacher = [];
			foreach ($teacher as $row) {
				$array_teacher[$row->slug] = $row->name;
			}
		}
		$subject = $this->subjectTimeModel->where('situation', 1)->get();
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
		$teacher = $this->teacherModel->select('id', 'slug')->where('slug', $input['teacher'])->first();
		$input['teacher_id'] = $teacher->id;
		$test = $this->testModel->create($input);
		return redirect()->route('admin.test.edit', $test->slug);
	}
	
	public function edit($slug) {
		$icon = 'fa fa-file-text';
		$route_form = ['admin.test.update', $slug];
		$back = 'admin.test.list';
		$data = $this->testModel->where('slug', $slug)->first();
		$title = 'Editar prova: '.$data->name;
		$teacher = $this->teacherModel->select('name', 'slug')->where('situation', 1)->get();
		if ($teacher) {
			$array_teacher = [];
			foreach ($teacher as $row) {
				$array_teacher[$row->slug] = $row->name;
			}
		}

		$subject = $this->subjectTimeModel->where('situation', 1)->get();
		if ($subject) {
			$array_subject = [];
			foreach ($subject as $row) {
				$array_subject[$row->slug] = getSubjectNameByID($row->subject_id).' - '.$row->year.' - '.($row->half == '1-semestre' ? '1º Semestre' : '2º Semestre');
			}
		}

		$get_teacher_input = $this->teacherModel->where('id', $data->teacher_id)->first();
		$input_teacher = $get_teacher_input->slug;

		return view('test.form', compact('title', 'icon', 'route_form', 'back', 'data', 'array_teacher', 'array_subject'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$input['subject_time_id'] =$input['subject'];
		$teacher = $this->teacherModel->select('id', 'slug')->where('slug', $input['teacher'])->first();
		$input['teacher_id'] = $teacher->id;
		$test = $this->testModel->where('slug', $slug)->first();
		$test->update($input);
		return redirect()->route('admin.test.edit', $test->slug);	
	}

	public function situation($slug, $situation) {
		
		$test = $this->testModel->where('slug', $slug)->first();
		$test->situation = $situation;
		$test->save();	
		return redirect()->route('admin.test.list');	

	}
}
