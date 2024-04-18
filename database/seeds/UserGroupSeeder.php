<?php

use App\UserGroup;
use Illuminate\Database\Seeder;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (UserGroup::count() == 0) {
    		$data = [
		    			[
				        'name' 			=> "Super User",
				        'slug' 			=> "Super-User",
				        'description' 	=> "Super Admin Access Configuration"
				    	],
				    	[
				        'name' 			=> "Site Admin",
				        'slug' 			=> "Site-Admin",
				        'description' 	=> "Site Admin test description"
				    	],
				    	[
				        'name' 			=> "Marquee Owner",
				        'slug' 			=> "Marquee-Owner",
				        'description' 	=> "Marquee Owner Description"
				    	],
				    	[
				        'name' 			=> "App client",
				        'slug' 			=> "App-client",
				        'description' 	=> "App Client test description"
				    	],
    				];
		    UserGroup::insert($data);
		}else{
			echo "*user_groups* Table Already has Data\n";
		}
    }
}
