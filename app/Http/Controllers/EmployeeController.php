<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;
use OngSystem\Employee;

class EmployeeController extends Controller
{
	private $employeeModel;
	public function __construct(Employee $employeeModel)
	{
		$this->employeeModel = $employeeModel;
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
		return view('employee.form', compact('title', 'icon', 'route_form', 'back'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$employee = $this->employeeModel->create($input);
		return redirect()->route('admin.employee.edit', $employee->slug);
	}
	
	public function edit($slug) {
		$icon = 'fa fa-user-circle';
		$route_form = ['admin.employee.update', $slug];
		$back = 'admin.employee.list';
		$data = $this->employeeModel->where('slug', $slug)->first();
		$title = 'Editar funcionario: '.$data->name;
		return view('employee.form', compact('title', 'icon', 'route_form', 'back', 'data'));
	}

	public function update(Request $request, $slug) {
		$input = $request->all();
		$employee = $this->employeeModel->where('slug', $slug)->first();
		$employee->update($input);
		return redirect()->route('admin.employee.edit', $employee->slug);	
	}

	public function situation($slug, $situation) {
		
		$employee = $this->employeeModel->where('slug', $slug)->first();
		$employee->situation = $situation;
		$employee->save();	
		return redirect()->route('admin.employee.list');	

	}
}
