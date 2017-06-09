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
		$student = $this->studentModel->fill($input);
		if($this->studentModel->save()) {
			return redirect()->route('admin.student.edit', $student->slug)->with('success', 'Aluno Cadastrado com sucesso!');
		} else {
			return redirect()->route('admin.student.edit', $student->slug)->with('danger', 'Erro ao cadastrar aluno, por gentileza, tente novamente.');
		}
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
		if($student->update($input)) {
			return redirect()->route('admin.student.edit', $student->slug)->with('success', 'Aluno editado com sucesso!');
		} else {
			return redirect()->route('admin.student.edit', $student->slug)->with('danger', 'Erro ao ediar aluno, por gentileza, tente novamente.');
		}
	}

	public function delete($slug) {
		$student = $this->studentModel->where('slug', $slug)->first();
		if($student->delete()) {
			return redirect()->route('admin.student.list')->with('success', 'Aluno excluído com sucesso!');
		} else {
			return redirect()->route('admin.student.list')->with('danger', 'Erro ao excluir aluno, por gentileza, tente novamente.');
		}
	}

	public function situation($slug, $situation) {

		$student = $this->studentModel->where('slug', $slug)->first();
		$student->situation = $situation;
		if($student->save()) {
			return redirect()->route('admin.student.list')->with('success', 'Situação Alterada com sucesso!');
		} else {
			return redirect()->route('admin.student.list')->with('danger', 'Erro ao alterar situação. Por gentileza, tente novamente.');
		}

	}
}
