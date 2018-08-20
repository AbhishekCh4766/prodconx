<?php

namespace App\Repositories;

use DB;

class FriendListRepository 
{

	public function getList($user_id){
		
		$user = DB::table('tbl_friend_requests')
        ->join('tbl_users', 'tbl_users.id' , '=',  'tbl_friend_requests.friend_id' )	
		->select('tbl_users.id','tbl_users.first_name','tbl_users.last_name')

		->where('tbl_friend_requests.user_id',$user_id)	
		->orderBy('id', 'DESC')
		->get();		

		return $user;		
		
	}
	
	public function getUserChat($id ,$user_id){
		
		$user = DB::table('tbl_conversations')
        ->join('tbl_conversation_message', 'tbl_conversation_message.c_id' , '=',  'tbl_conversations.id' )
		->select('tbl_conversations.id','text','time','user_id')
		->where(function($query) use ($id,$user_id)
			{
				$query->where('user_from', '=', $id)
				->Where('user_to', '=',  $user_id );	
			
			})
		->Orwhere(function($query) use($id,$user_id) 
			{
				$query->where('user_from', '=', $user_id)
				->Where('user_to', '=', $id);
			
			})

		->get();		
		return $user;	

		//Select a. * ,b.* FROM `tbl_conversations` as a , `tbl_conversation_message` as b WHERE (a.`user_to` = 1 AND a.`user_from`  = 7) OR (a.`user_to` = 7 AND a.`user_from`  = 1) GROUP BY b.id		
		
	}
	
	public function getUserName($id){
		
		$user = DB::table('tbl_users')
		->select('first_name','last_name')
		->where('id', $id)			
		->first();
		
		//echo'<pre>';print_r($user);die;
		
		return $user;

	}
	public function savechat($request,$user_id){
		
		$c_id = DB::table('tbl_conversations')->insertGetId(
			['user_to' => $user_id, 
			 'user_from' => $request->id
			]
		);

		$id = DB::table('tbl_conversation_message')->insertGetId(
			['user_id' => $user_id, 
			  'c_id'   => $c_id,		
			  'is_from_sender' => 0,
			 'text' => $request->text, 
			 'is_read' => 0,
			 'is_delete' => 0,
			]
		);
		
		return $id;

	}

	public function getUserChatLastMessage($last_msg_id,$id,$user_id){
		
		$user = DB::table('tbl_conversations')
        ->join('tbl_conversation_message', 'tbl_conversation_message.c_id' , '=',  'tbl_conversations.id' )
		->select('tbl_conversations.id','text','time','user_id')
		->where(function($query) use ($id,$user_id)
			{
				$query->where('user_from', '=', $user_id)
				->Where('user_to', '=',  $id );	
			
			})
		->where('tbl_conversations.id','>',$last_msg_id)	
		->get();	
		
		return $user;			
		
		
	}
	
}
