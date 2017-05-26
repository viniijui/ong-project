<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Subject;

class SubjectController extends Controller
{
	private $subjectModel;
	public function __construct(Subject $subjectModel)
	{
		$this->subjectModel = $subjectModel;
	}

	public function roll() {
		$data = $this->subjectModel->get();
		$create = true;
		$title = 'Materias';
		$icon = 'fa fa-file-text-o';
		$controller = 'admin.subject';
		$table_content = array(
			"Nome" => 'name',
			"Turmas" => 'classes',
			"Situação" => 'situation'
		);
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create'));	
	}

	public function create() {
		$title = 'Cadastrar materia';
		$icon = 'fa fa-file-text-o';
		$route_form = 'admin.subject.store';
		$back = 'admin.subject.list';
		return view('subject.form', compact('title', 'icon', 'route_form', 'back'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$subject = $this->subjectModel->create($input);
		return redirect()->route('admin.subject.edit', $subject->slug);
	}
	
	public function edit($slug) {
		$icon = 'fa fa-file-text-o';
		$route_form = ['admin.subject.update', $slug];
		$back = 'admin.subject.list';
		$data = $this->subjectModel->where('slug', $slug)->first();
		$title = 'Editar materia: '.$data->name;
		return view('subject.form', compact('title', 'icon', 'route_form', 'back', 'data'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$subject = $this->subjectModel->where('slug', $slug)->first();
		$subject->update($input);
		return redirect()->route('admin.subject.edit', $subject->slug);	
	}

	public function situation($slug, $situation) {
		$subject = $this->subjectModel->where('slug', $slug)->first();
		$subject->situation = $situation;
		$subject->save();	
		return redirect()->route('admin.subject.list');	
	}
}
