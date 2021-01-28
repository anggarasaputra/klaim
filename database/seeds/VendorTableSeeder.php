<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Vendor;

class VendorTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$vendors = [
					['name' => 'Prudential'],
					['name' => 'Manulife'],
					['name' => 'AIA'],
					['name' => 'Sequislife'],
					['name' => 'AXA'],
					['name' => 'Reliance'],
					['name' => 'Garda Oto'],
				];

		foreach ($vendors as $vendor)
		{
			$data = new Vendor;
			$data->fill($vendor);
			if (!$data->save())
			{
				dd($data->getErrors());
			}
		}
	}
}
