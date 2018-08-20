<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;

class CommonFunctions extends Model {


    public static function role_name($role_id) {

    	$roleID = explode(',', $role_id);

    	$rolename ="";

    	for($i=0;$i<count($roleID);$i++){

 		$data = DB::table('tbl_roles')			
			->where('tbl_roles.id', $roleID[$i])				
            ->first();

         $rolename .= $data->role_name.',';   
            
        }    
        return rtrim($rolename,',');
    }

    public function getweather(){
        $ip = '122.173.106.89'; 
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

        $jsonurl = "http://api.openweathermap.org/data/2.5/weather?q=".$query['city'].",".$query['countryCode']."&appid=de998a59911b265b46b4eb77150e8cca";
        $json = file_get_contents($jsonurl);

        $weather = json_decode($json);

        $kelvin = $weather->main->temp;
        $country = $weather->sys->country;
        $state = $weather->name;

        $data = array(
            'temperature' => $kelvin - 273.15,
            'country' => $country,
            'state' => $state,
            'main' => $weather->weather[0]->main
        );
        return $data;
    }
}
