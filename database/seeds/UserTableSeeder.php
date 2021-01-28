<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$users = [
					['name' => 'Erick', 'email' => 'mo@vortege.com', 'password' => '123123'],
					['name' => 'Mike', 'email' => 'mike@vortege.com', 'password' => '123123'],
					['name' => 'Agil', 'email' => 'agil@vortege.com', 'password' => '123123'],
					['name' => 'Chelsy', 'email' => 'Chelsy@vortege.com', 'password' => '123123'],
					['name' => 'Budi', 'email' => 'Budi@vortege.com', 'password' => '123123'],
				];

		foreach ($users as $user)
		{
			$data = new User;
			$data->fill($user);
			if (!$data->save())
			{
				dd($data->getErrors());
			}
		}
	}
}
