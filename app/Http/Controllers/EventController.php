<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Event;

class EventController extends Controller
{
	private $eventModel;
	public function __construct(Event $eventModel)
	{
		$this->eventModel = $eventModel;
	}

	public function roll() {
		$data = $this->eventModel->get();
		$create = true;
		$title = 'Eventos';
		$icon = 'fa fa-calendar';
		$controller = 'admin.event';
		$table_content = array(
			"Nome" => 'name',
			"Reserva de patrimonios" => 'patrimony_reserve',
			"Local" => "place",
			"Situação" => 'situation'
		);
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create'));
	}

	public function create() {
		$title = 'Cadastrar evento';
		$icon = 'fa fa-calendar';
		$route_form = 'admin.event.store';
		$back = 'admin.event.list';
		return view('event.form', compact('title', 'icon', 'route_form', 'back'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$event = $this->eventModel->fill($input);
		if($event->save()) {
			return redirect()->route('admin.event.edit', $event->slug)->with('success', 'Evento cadastrado com sucesso!');
		} else {
			return redirect()->route('admin.event.edit', $event->slug)->with('danger', 'Erro ao cadastrar evento. Por gentileza, tente novamente.');
		}
	}

	public function edit($slug) {
		$icon = 'fa fa-calendar';
		$route_form = ['admin.event.update', $slug];
		$back = 'admin.event.list';
		$data = $this->eventModel->where('slug', $slug)->first();
		$title = 'Editar evento: '.$data->name;
		return view('event.form', compact('title', 'icon', 'route_form', 'back', 'data'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$event = $this->eventModel->where('slug', $slug)->first();
		if(	$event->update($input)) {
			return redirect()->route('admin.event.edit', $event->slug)->with('success', 'Evento alterado com sucesso!');
		} else {
			return redirect()->route('admin.event.edit', $event->slug)->with('danger', 'Erro ao alterar evento. Por gentileza, tente novamente.');
		}
	}

	public function delete($slug) {
		$event = $this->eventModel->where('slug', $slug)->first();
		if(	$event->delete()) {
			return redirect()->route('admin.event.list')->with('success', 'Evento excluído com sucesso!');
		} else {
			return redirect()->route('admin.event.list')->with('danger', 'Erro ao excluír evento. Por gentileza, tente novamente.');
		}
	}

	public function situation($slug, $situation) {
		$event = $this->eventModel->where('slug', $slug)->first();
		$event->situation = $situation;
		if(	$event->save()) {
			return redirect()->route('admin.event.list')->with('success', 'Situação alterada com sucesso!');
		} else {
			return redirect()->route('admin.event.list')->with('danger', 'Erro ao alterar situação. Por gentileza, tente novamente.');
		}
	}
}
