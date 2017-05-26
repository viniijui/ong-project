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
		$title = 'Protrimonios';
		$icon = 'fa fa-archive';
		$controller = 'admin.patrimony';
		$table_content = array(
			"Nome" => 'name',
			"Nº Patrimonio" => 'key',
			"Situação" => 'situation'
		);
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create'));	
	}

	public function create() {
		$title = 'Cadastrar patrimonio';
		$icon = 'fa fa-archive';
		$route_form = 'admin.patrimony.store';
		$back = 'admin.patrimony.list';
		return view('patrimony.form', compact('title', 'icon', 'route_form', 'back'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$patrimony = $this->patrimonyModel->create($input);
		return redirect()->route('admin.patrimony.edit', $patrimony->slug);
	}
	
	public function edit($slug) {
		$icon = 'fa fa-archive';
		$route_form = ['admin.patrimony.update', $slug];
		$back = 'admin.patrimony.list';
		$data = $this->patrimonyModel->where('slug', $slug)->first();
		$title = 'Editar patrimonio: '.$data->name;
		return view('patrimony.form', compact('title', 'icon', 'route_form', 'back', 'data'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$patrimony = $this->patrimonyModel->where('slug', $slug)->first();
		$patrimony->update($input);
		return redirect()->route('admin.patrimony.edit', $patrimony->slug);	
	}

	public function situation($slug, $situation) {
		$patrimony = $this->patrimonyModel->where('slug', $slug)->first();
		$patrimony->situation = $situation;
		$patrimony->save();	
		return redirect()->route('admin.patrimony.list');	
	}
}
