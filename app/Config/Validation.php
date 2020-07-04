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
		'nama_lengkap'  => 'required',
		'noHp'   		=> 'required',
		'alamat'   		=> 'required',
		'email'   		=> 'required',
		'username'   	=> 'required',
		'level'   		=> 'required',
		'password'   	=> 'required'
	];

	public $user_errors = [
		'nama_lengkap'  => ['required'  => 'Nama Lengkap wajib diisi.'],
		'noHp'  		=> ['required'  => 'No Hp wajib diisi.'],
		'alamat'  		=> ['required'  => 'Alamat wajib diisi.'],
		'email'  		=> ['required'  => 'Email wajib diisi.'],
		'username'   	=> ['required'  => 'Username wajib diisi.'],
		'level'   		=> ['required'  => 'Level wajib diisi.'],
		'password'   	=> ['required'  => 'Password wajib diisi.']
	];

	public $produk = [
		'nama_produk'  			=> 'required',
		'deskripsi_produk'   	=> 'required',
		'harga_produk'   		=> 'required',
		'stok_produk'   		=> 'required'
	];

	public $produk_errors = [
		'nama_produk' 		 	=> ['required'  => 'Nama produk wajib diisi.'],
		'deskripsi_produk'  	=> ['required'  => 'deskripsi produk wajib diisi.'],
		'harga_produk'  		=> ['required'  => 'harga produk wajib diisi.'],
		'stok_produk'  			=> ['required'  => 'stok produk wajib diisi.']
	];

	public $hadiah = [
		'nama_hadiah'  		=> 'required',
		'poin'   			=> 'required'
	];

	public $hadiah_errors = [
		'nama_hadiah' 		 	=> ['required'  => 'Nama Hadiah wajib diisi.'],
		'poin'  				=> ['required'  => 'poin wajib diisi.']
	];
}
