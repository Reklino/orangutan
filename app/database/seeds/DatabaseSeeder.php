<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(		'username' => 'Jacob',     'password' => Hash::make('Gro^^1in'),      'role' => '1',      'group' => 'csc',     'email' => 'jacob.davidson@halifaxmediagroup.com'	));
        User::create(array(     'username' => 'Tess',      'password' => Hash::make('Password'),      'role' => '1',      'group' => 'csc',     'email' => 'tess@something.com' ));
        User::create(array(     'username' => 'Ethan',      'password' => Hash::make('Stinky'),      'role' => '2',      'group' => 'csc',     'email' => 'ethan@whaaat.com' ));
        User::create(array(     'username' => 'Josh',      'password' => Hash::make('Gro^^1in'),      'role' => '3',      'group' => 'csc',     'email' => 'josh@mackalack.com' ));
        User::create(array(     'username' => 'Sager',      'password' => Hash::make('Gro^^1in'),      'role' => '3',      'group' => 'csc',     'email' => 'sager@compy.com' ));
    }

}
