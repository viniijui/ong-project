<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Patrimony;

class PatrimonyController extends Controller
{
	private $patrimonyModel;
	public function __construct(Patrimony $patrimonyModel)
	{
		$this->patrimonyModel = $patrimonyModel;
	}

	public function roll() {
		$data = $this->patrimonyModel->get();
		$create = true;
		$title = 'Patrimônios';
		$icon = 'fa fa-archive';
		$controller = 'admin.patrimony';
		$table_content = array(
			"Nome" => 'name',
			"Nº Patrimônio" => 'key',
			"Situação" => 'situation'
		);

		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create'));
	}

	public function create() {
		$title = 'Cadastrar patrimônio';
		$icon = 'fa fa-archive';
		$route_form = 'admin.patrimony.store';
		$back = 'admin.patrimony.list';
		return view('patrimony.form', compact('title', 'icon', 'route_form', 'back'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$patrimony = $this->patrimonyModel->fill($input);
		if($patrimony->save()) {
			return redirect()->route('admin.patrimony.edit', $patrimony->slug)->with('success', 'Patrimônio cadastrado com sucesso!');
		} else {
			return redirect()->route('admin.patrimony.edit', $patrimony->slug)->with('danger', 'Erro ao cadastrar patrimônio. Por gentileza, tente novamente.');
		}
	}

	public function edit($slug) {
		$icon = 'fa fa-archive';
		$route_form = ['admin.patrimony.update', $slug];
		$back = 'admin.patrimony.list';
		$data = $this->patrimonyModel->where('slug', $slug)->first();
		$title = 'Editar patrimônio: '.$data->name;
		return view('patrimony.form', compact('title', 'icon', 'route_form', 'back', 'data'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$patrimony = $this->patrimonyModel->where('slug', $slug)->first();
		if($patrimony->update($input)) {
			return redirect()->route('admin.patrimony.edit', $patrimony->slug)->with('success', 'Patrimônio editado com sucesso!');
		} else {
			return redirect()->route('admin.patrimony.edit', $patrimony->slug)->with('danger', 'Erro ao editar patrimônio. Por gentileza, tente novamente.');
		}
	}

	public function delete($slug) {
		$patrimony = $this->patrimonyModel->where('slug', $slug)->first();
		if($patrimony->delete()) {
			return redirect()->route('admin.patrimony.edit', $patrimony->slug)->with('success', 'Patrimônio excluído com sucesso!');
		} else {
			return redirect()->route('admin.patrimony.edit', $patrimony->slug)->with('danger', 'Erro ao excluir patrimônio. Por gentileza, tente novamente.');
		}
	}

	public function situation($slug, $situation) {
		$patrimony = $this->patrimonyModel->where('slug', $slug)->first();
		$patrimony->situation = $situation;
		if($patrimony->save()) {
			return redirect()->route('admin.patrimony.list')->with('success', 'Situação alterada com sucesso!');
		} else {
			return redirect()->route('admin.patrimony.list')->with('danger', 'Erro ao alterar a situação. Por gentileza, tente novamente.');
		}
	}
}
