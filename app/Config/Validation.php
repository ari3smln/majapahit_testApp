<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $user = [
		'nama_user'   	=> 'required',
		'username'   	=> 'required',
		'level'   		=> 'required',
		'password'   	=> 'required'
	];

	public $user_errors = [
		'nama_user'   	=> ['required'  => 'Nama Lengkap wajib diisi.'],
		'username'   	=> ['required'  => 'Username wajib diisi.'],
		'level'   		=> ['required'  => 'Level wajib diisi.'],
		'password'   	=> ['required'  => 'Password wajib diisi.']
	];
}
