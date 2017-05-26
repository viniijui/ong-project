<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\SubjectTime;
use OngSystem\Teacher;
use OngSystem\Subject;

class ClassController extends Controller
{
	private $subjectTimeModel;
	private $subjectModel;
	private $teacherModel;

	public function __construct(SubjectTime $subjectTimeModel, Teacher $teacherModel, Subject $subjectModel)
	{
		$this->subjectTimeModel = $subjectTimeModel;
		$this->subjectModel = $subjectModel;
		$this->teacherModel = $teacherModel;
	}

	public function roll($slug ='') {
		if ($slug != '') {
			$subject = $this->subjectModel->select('id', 'name')->where('slug', $slug)->first();
			$title = 'Turmas da materia: '.$subject->name;
			$data = $this->subjectTimeModel->where('subject_id', $subject->id)->get();
			$back = 'admin.subject.list';
		} else {
			$data = $this->subjectTimeModel->get();
			$title = 'Turmas';
		}
		$create = true;
		$icon = 'fa fa-calendar-o';
		$controller = 'admin.subject.time';
		$table_content = array(
			"Ano" => 'year',
			"Semestre" => 'half_class',
			"Professor" => 'teacher_class',
			"Situação" => 'situation'
		);
	
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create', 'back'));	
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
		$subject = $this->subjectTimeModel->create($input);
		return redirect()->route('admin.subject.time.edit', $subject->id);
	}
	
	public function edit($slug) {
		$icon = 'fa fa-calendar-o';
		$route_form = ['admin.subject.time.update', $slug];
		$back = 'admin.subject.time.list';
		$data = $this->subjectTimeModel->where('id', $slug)->first();
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
		$subject_by_input = $this->subjectModel->select('ic', 'name', 'slug')->where('slug', $input['subject'])->first();
		$input['subject_id'] = $subject_by_input->id;
		$teacher = $this->teacherModel->select('id')->where('slug', $input['teacher'])->first();
		$input['teacher_id'] = $teacher->id;
		if (isset($input['teacher2']) and $input['teacher2'] !== 0) {
			$teacher = $this->teacherModel->select('id')->where('slug', $input['teacher2'])->first();
			$input['teacher2_id'] = $teacher->id;
		}
		$subject = $this->subjectTimeModel->where('id', $slug)->first();
		$subject->update($input);
		return redirect()->route('admin.subject.time.edit', $subject->id);	
	}

	public function situation($slug, $situation) {
		$subject = $this->subjectTimeModel->where('slug', $slug)->first();
		$subject->situation = $situation;
		$subject->save();	
		return redirect()->route('admin.subject.time.list');	
	}
}
