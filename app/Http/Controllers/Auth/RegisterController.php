<?php

namespace OngSystem\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use OngSystem\User;
use OngSystem\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

	protected function store(Request $request)
	{
		$data = $request->all();
		$messages = [
		    'confirmed' => 'As duas senhas não são iguais',
			'required' => 'O preenchimento deste campo é necessario',
			'unique' => 'Este email já está em uso. Por gentileza, tente outro.'
		];
		$validator = Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed'
		], $messages);

		if ($validator->fails()) {
			return redirect()->route('admin.user.create')
				->withErrors($validator)
				->withInput();
		}

		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
		if (isset($data['is_admin']) and $data['is_admin'] = 1) {
			setRoleToUser($user->id, 'root');
		}
		return redirect()->route('admin.user.edit', $user->id);
	}

	public function create2()
	{
		$title = 'Cadstrar usuário';
		return view('auth.register', compact('title'));
	}

	public function edit($id)
	{
		$data = User::where('id', $id)->first();
		$title = 'Editar usuário: '.$data->name;
		return view('auth.register', compact('data', 'title'));
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		$user = User::where('id', $id)->first();
		$messages = [
		    'confirmed' => 'As duas senhas não são iguais',
			'required' => 'O preenchimento deste campo é necessario'
		];
		$validator = Validator::make($data, [
			'name' => 'required|max:255',
			'password' => 'required|min:6|confirmed',
		], $messages);

		if ($validator->fails()) {
			return redirect()->route('admin.user.edit', $user->id)
				->withErrors($validator)
				->withInput();
		}

		$user->update([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);

		if (isset($data['is_admin']) and $data['is_admin'] = 1) {
			setRoleToUser($user->id, 'root');
		}

		return redirect()->route('admin.user.edit', $user->id);
	}

	public function roll()
	{
		$data = User::all();
		$title = 'Usuários:';
		$create = true;
		$icon = 'fa fa-users';
		$controller = 'admin.user';
		$delete_modify = true;
		$table_content = array(
			"Nome" => 'name',
			"E-mail" => 'email',
			"Permissões" => 'permission_role'
		);

		return view('table', compact('data', 'title', 'controller', 'table_content', 'icon', 'delete_modify'));

	}
}
