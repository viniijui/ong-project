<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Student;

class StudentController extends Controller
{
	private $studentModel;
	public function __construct(Student $studentModel)
	{
		$this->studentModel = $studentModel;
	}

	public function roll()
	{
		$data = $this->studentModel->get();
		$create = true;
		$title = 'Alunos';
		$icon = 'fa fa-user';
		$controller = 'admin.student';
		$table_content = array(
			"Nome" => 'name',
			"Situação" => 'situation'
		);
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create'));	
	}

	public function create() {
		$title = 'Cadastrar aluno';
		$icon = 'fa fa-user';
		$route_form = 'admin.student.store';
		$back = 'admin.student.list';
		return view('student.form', compact('title', 'icon', 'route_form', 'back'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$student = $this->studentModel->create($input);
		return redirect()->route('admin.student.edit', $student->slug);
	}
	
	public function edit($slug) {
		$icon = 'fa fa-user';
		$route_form = ['admin.student.update', $slug];
		$back = 'admin.student.list';
		$data = $this->studentModel->where('slug', $slug)->first();
		$title = 'Editar aluno: '.$data->name;
		return view('student.form', compact('title', 'icon', 'route_form', 'back', 'data'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$student = $this->studentModel->where('slug', $slug)->first();
		$student->update($input);
		return redirect()->route('admin.student.edit', $student->slug);	
	}

	public function situation($slug, $situation) {
		
		$student = $this->studentModel->where('slug', $slug)->first();
		$student->situation = $situation;
		$student->save();	
		return redirect()->route('admin.student.list');	

	}
}
