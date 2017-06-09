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
		$subject = getSubjectsByTeacher();
		if($subject !== false) {
			$data = $subject;
			$table_content = array(
				"Nome" => 'name',
				"Turmas" => 'classes',
			);
			$no_tools = true;
		} else {
			$data = $this->subjectModel->get();
			$table_content = array(
				"Nome" => 'name',
				"Turmas" => 'classes',
				"Situação" => 'situation'
			);
		}
		$create = true;
		$title = 'Matérias';
		$icon = 'fa fa-file-text-o';
		$controller = 'admin.subject';
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create', 'no_tools'));
	}

	public function create() {
		$title = 'Cadastrar matéria';
		$icon = 'fa fa-file-text-o';
		$route_form = 'admin.subject.store';
		$back = 'admin.subject.list';
		return view('subject.form', compact('title', 'icon', 'route_form', 'back'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$subject = $this->subjectModel->fill($input);
		if($subject->save()) {
			return redirect()->route('admin.subject.edit', $subject->slug)->with('success', 'Matéria cadastrada com sucesso!');
		} else {
			return redirect()->route('admin.subject.edit', $subject->slug)->with('danger', 'Erro ao cadstrar a matéria. Por gentileza, tente novamente.');
		}
	}

	public function edit($slug) {
		$icon = 'fa fa-file-text-o';
		$route_form = ['admin.subject.update', $slug];
		$back = 'admin.subject.list';
		$data = $this->subjectModel->where('slug', $slug)->first();
		$title = 'Editar matéria: '.$data->name;
		return view('subject.form', compact('title', 'icon', 'route_form', 'back', 'data'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$subject = $this->subjectModel->where('slug', $slug)->first();
		if($subject->update($input)) {
			return redirect()->route('admin.subject.edit', $subject->slug)->with('success', 'Matéria editada com sucesso!');
		} else {
			return redirect()->route('admin.subject.edit', $subject->slug)->with('danger', 'Erro ao alterar a matéria. Por gentileza, tente novamente.');
		}
	}

	public function delete($slug) {
		$subject = $this->subjectModel->where('slug', $slug)->first();
		if($subject->delete()) {
			return redirect()->route('admin.subject.list')->with('success', 'Matéria excluída com sucesso!');
		} else {
			return redirect()->route('admin.subject.list')->with('danger', 'Erro ao excluír a matéria. Por gentileza, tente novamente.');
		}
	}

	public function situation($slug, $situation) {
		$subject = $this->subjectModel->where('slug', $slug)->first();
		$subject->situation = $situation;
		if($subject->save()) {
			return redirect()->route('admin.subject.list')->with('success', 'Situação alterada com sucesso!');
		} else {
			return redirect()->route('admin.subject.list')->with('danger', 'Erro ao alterar a situação, tente novamente.');
		}
	}
}
