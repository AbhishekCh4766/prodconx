<?php

namespace App\Repositories;
use App\Models\Content;
use DB;

class PackageRepository 
{

	/**
	 * The Role instance.
	 *
	 * @var App\Models\Role
	 */	

	/**
	 * Create a new UserRepository instance.
	 *
   	 * @param  App\Models\User $user
	 * @param  App\Models\Role $role
	 * @return void
	 */
	public function __construct()
	{


	}

	public function getAllUserPaymentHistory($user_id){
		
		$order = DB::table('tbl_user_memberships')
            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_user_memberships.user_id')
            ->join('tbl_orders', 'tbl_orders.id', '=', 'tbl_user_memberships.order_id')				
            ->join('tbl_membership_palns', 'tbl_membership_palns.id', '=', 'tbl_orders.membership_plan_id')		
            ->select('tbl_users.username','tbl_orders.total_amount','tbl_membership_palns.title','tbl_orders.id','tbl_user_memberships.start_date','tbl_user_memberships.end_date','tbl_orders.payment_method','tbl_users.first_name','tbl_users.last_name','tbl_users.email','tbl_users.phone','tbl_membership_palns.price','tbl_orders.amount','tbl_orders.tax','tbl_orders.discount','tbl_membership_palns.duration') 
			->where('tbl_users.id',$user_id)		
            ->get();

		return $order;		
		
		
	}
	

	
}
