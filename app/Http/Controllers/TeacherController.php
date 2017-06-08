<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Teacher;
use OngSystem\User;
use DB;

class TeacherController extends Controller
{
	private $teacherModel;
	private $userModel;

	public function __construct(Teacher $teacherModel, User $userModel)
	{
		$this->teacherModel = $teacherModel;
		$this->userModel = $userModel;
	}

	public function roll()
	{
		$data = $this->teacherModel->get();
		$create = true;
		$title = 'Professores';
		$icon = 'fa fa-user-circle-o';
		$controller = 'admin.teacher';
		$table_content = array(
			"Nome" => 'name',
			"Situação" => 'situation'
		);
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create'));
	}

	public function create() {
		$title = 'Cadastrar professor';
		$icon = 'fa fa-user-circle-o';
		$route_form = 'admin.teacher.store';
		$back = 'admin.teacher.list';
		$user = \DB::connection('mysql')->select(DB::raw('
			SELECT u.id, u.name FROM users as u WHERE u.id NOT IN (SELECT  DISTINCT(user_id) FROM role_user) GROUP BY u.id'
		));
		$userArray = [];
		foreach ($user as $row) {
			$userArray[$row->id] = $row->name;
		}

		return view('teacher.form', compact('title', 'icon', 'route_form', 'back', 'userArray'));
	}

	public function store(Request $request) {
		$input = $request->all();
		setRoleToUser($input['user_id'], 'teacher');
		$teacher = $this->teacherModel->create($input);
		return redirect()->route('admin.teacher.edit', $teacher->slug);
	}

	public function edit($slug) {
		$icon = 'fa fa-user-circle-o';
		$route_form = ['admin.teacher.update', $slug];
		$back = 'admin.teacher.list';
		$data = $this->teacherModel->where('slug', $slug)->first();
		$title = 'Editar professor: '.$data->name;
		$user = $this->userModel->where('id', $data->user_id)->first();
		return view('teacher.form', compact('title', 'icon', 'route_form', 'back', 'data', 'user'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$teacher = $this->teacherModel->where('slug', $slug)->first();
		$teacher->update($input);
		return redirect()->route('admin.teacher.edit', $teacher->slug);
	}

	public function situation($slug, $situation) {

		$teacher = $this->teacherModel->where('slug', $slug)->first();
		$teacher->situation = $situation;
		$teacher->save();
		return redirect()->route('admin.teacher.list');

	}
}
