<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$role = new Role();
		$role->nombre = 'admin';
		$role->save();
		$role = new Role();
		$role->nombre = 'user';
		$role->save();
	}
}
