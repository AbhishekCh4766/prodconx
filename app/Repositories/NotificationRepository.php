<?php

namespace App\Repositories;

use DB;

class NotificationRepository 
{

	public function notify($last_id,$user_id){
		
		$data = DB::table('tbl_friend_requests')					
			->select('id')				
			->where('friend_id', $user_id)	
			->orderBy('id', 'desc')
			->limit(1)
            ->get();	
		
		//echo ' User ID :'.$user_id.' : ';
		
		$id	 = $data[0]->id;
		
		//echo $id . ' - ' . $last_id;

		if($id == $last_id){			
			return 0;
			
		}else{
			return $data[0]->id;
		}
		
	}


	
	
	
}
