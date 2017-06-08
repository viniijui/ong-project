<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Patrimony;
use OngSystem\Reserve;
use OngSystem\SubjectTime;
use OngSystem\Subject;
use OngSystem\Event;

class ReserveController extends Controller
{
	private $reserveModel;
	private $patrimonyModel;
	private $subjectTimeModel;
	private $subjectModel;
	private $eventModel;

	public function __construct(Reserve $reserveModel, Patrimony $patrimonyModel, SubjectTime $subjectTimeModel, Subject $subjectModel, Event $eventModel)
	{
		$this->eventModel = $eventModel;
		$this->reserveModel = $reserveModel;
		$this->patrimonyModel = $patrimonyModel;
		$this->subjectTimeModel = $subjectTimeModel;
		$this->subjectModel = $subjectModel;
	}

	public function roll($type='', $aux='') {
		if ($type == 'evento') {
			if($aux == '') abort(404);
			$event = $this->eventModel->where('slug', $aux)->first();
			if (!$this->eventModel->where('slug', $aux)->first()) abort(404);
			$data = $this->reserveModel->where('event_id', $event->id)->get();
			$create_modify = true;
			$title = 'Reserva de patrimonios para: '.$event->name;
		} else {
			$title = 'Reserva de patrimonios';
			if (\Auth::user()->hasRole('teacher')) {
				$pass_add = true;
				$data = $this->reserveModel->where('user_id', \Auth::user()->id)->get();
			}
		}

		$create = true;
		$icon = 'fa fa-check-square-o';
		$controller = 'admin.reserve';
		$no_edit = true;
		$delete_modify = true;
		$table_content = array(
			"Patrimonio" => 'patrimony_name',
			"Dia" => 'day_br'
		);
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create', 'no_edit', 'create_modify', 'aux', 'delete_modify', 'pass_add'));
	}

	public function create($type='', $aux='') {
		$title = 'Reservar de patrimonios';
		$icon = 'fa fa-check-square-o';
		$route_form = 'admin.reserve.store';
		$back = 'admin.reserve.list';
		if ($type != 'evento') {
			$teacher = getTeacherByUserID();
			if ($teacher !== false) {
				$subject = $this->subjectTimeModel->where(['teacher_id' => $teacher->id, 'situation' => 1])->get();
			} else {
				$subject = $this->subjectTimeModel->where('situation', 1)->get();
			}
			if ($subject) {
				$options = [];
				foreach ($subject as $row) {
					$options[$row->id] = getSubjectNameByID($row->subject_id).' - '.$row->year.' - '.($row->half == '1-semestre' ? '1º Semestre' : '2º Semestre');
				}
			}
		}
		$patrimony = $this->patrimonyModel->get();
		if ($patrimony) {
			$array_patrimony = [];
			foreach ($patrimony as $row) {
				$array_patrimony[$row->slug] = $row->name." | ".$row->key;
			}
		}
		return view('reserve.form', compact('title', 'icon', 'route_form', 'back', 'type', 'options', 'array_patrimony', 'aux'));
	}

	public function store(Request $request) {
		$input = $request->all();
		if (isset($input['event'])) {
			$event = $this->eventModel->where('slug', $input['event'])->first();
			$input['event_id'] = $event->id;
		}
		if (isset($input['subject'])) {
			$input['subject_time_id'] = $input['subject'];
		}
		$input['user_id'] = \Auth::user()->id;
		$patrimony = $this->patrimonyModel->where('slug', $input['patrimony'])->first();
		$input['patrimony_id'] = $patrimony->id;

		$reserve = $this->reserveModel->create($input);
		return redirect()->route('admin.reserve.create');
	}

	public function edit($slug) {
		$icon = 'fa fa-check-square-o';
		$route_form = ['admin.reserve.update', $slug];
		$back = 'admin.reserve.list';
		$data = $this->reserveModel->where('slug', $slug)->first();
		$title = 'Editar patrimonio: '.$data->name;
		return view('reserve.form', compact('title', 'icon', 'route_form', 'back', 'data'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$reserve = $this->reserveModel->where('slug', $slug)->first();
		$reserve->update($input);
		return redirect()->route('admin.reserve.edit', $reserve->slug);
	}

	public function delete($id) {
		$reserve = $this->reserveModel->where('id', $id)->first();
		if ($reserve->event_id != '') {
			$event = $this->eventModel->where('id', $reserve->event_id)->first();
		}
		$reserve->delete();
		if (isset($event)) {
			return redirect()->route('admin.reserve.list', ['type' => 'evento', 'aux' => $event->slug]);
		}
		return redirect()->route('admin.reserve.list');
	}
}
