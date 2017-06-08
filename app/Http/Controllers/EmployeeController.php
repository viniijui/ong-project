<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Employee;
use OngSystem\User;
use DB;

class EmployeeController extends Controller
{
	private $employeeModel;
	private $userModel;
	public function __construct(Employee $employeeModel, User $userModel)
	{
		$this->employeeModel = $employeeModel;
		$this->userModel = $userModel;
	}

	public function roll()
	{
		$data = $this->employeeModel->get();
		$create = true;
		$title = 'Funcionarios';
		$icon = 'fa fa-user-circle';
		$controller = 'admin.employee';
		$table_content = array(
			"Nome" => 'name',
			"Situação" => 'situation'
		);
		return view('table', compact('data', 'title', 'icon', 'table_content', 'controller', 'create'));
	}

	public function create() {
		$title = 'Cadastrar funcionario';
		$icon = 'fa fa-user-circle';
		$route_form = 'admin.employee.store';
		$back = 'admin.employee.list';
		$user = \DB::connection('mysql')->select(DB::raw('
			SELECT u.id, u.name FROM users as u WHERE u.id NOT IN (SELECT  DISTINCT(user_id) FROM role_user) GROUP BY u.id'
		));
		$userArray = [];
		foreach ($user as $row) {
			$userArray[$row->id] = $row->name;
		}
		return view('employee.form', compact('title', 'icon', 'route_form', 'back', 'userArray'));
	}

	public function store(Request $request) {
		$input = $request->all();
		setRoleToUser($input['user_id'], 'employee');
		$employee = $this->employeeModel->create($input);
		return redirect()->route('admin.employee.edit', $employee->slug);
	}

	public function edit($slug) {
		$icon = 'fa fa-user-circle';
		$route_form = ['admin.employee.update', $slug];
		$back = 'admin.employee.list';
		$data = $this->employeeModel->where('slug', $slug)->first();
		$title = 'Editar funcionario: '.$data->name;
		$user = $this->userModel->where('id', $data->user_id)->first();
		return view('employee.form', compact('title', 'icon', 'route_form', 'back', 'data', 'user'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$employee = $this->employeeModel->where('slug', $slug)->first();
		if($employee->update($input)) {
			return redirect()->route('admin.employee.edit', $employee->slug)->with('success', 'Registro alterado com sucesso!');
		} else {
			return redirect()->route('admin.employee.edit', $employee->slug)->with('danger', 'Erro ao alterar registro, tente novamente.');
		}
	}

	public function situation($slug, $situation) {
		$employee = $this->employeeModel->where('slug', $slug)->first();
		$employee->situation = $situation;
		if($employee->save()) {
			return redirect()->route('admin.employee.list')->with('success', 'Situação alterada com sucesso!');
		} else {
			return redirect()->route('admin.employee.list')->with('danger', 'Erro ao alterar situação, tente novamente.');
		}
	}

	public function delete($slug) {
		$employee = $this->employeeModel->where('slug', $slug)->first();
		$employee->delete();
		return redirect()->route('admin.employee.list');
	}
}
