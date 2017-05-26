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
			"Responsavel" => 'organizer',
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
		$event = $this->eventModel->create($input);
		return redirect()->route('admin.event.edit', $event->slug);
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
		$event->update($input);
		return redirect()->route('admin.event.edit', $event->slug);	
	}

	public function situation($slug, $situation) {
		$event = $this->eventModel->where('slug', $slug)->first();
		$event->situation = $situation;
		$event->save();	
		return redirect()->route('admin.event.list');	
	}
}
