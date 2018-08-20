<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Validator;

class MembershipController extends Controller
{
	
	protected $user_gestion;
	
	public function __construct(
		UserRepository $user_gestion)
	{
		$this->user_gestion = $user_gestion;

	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

	    $memberships = $this->user_gestion->getAllMembership();			
        return view('admin.membership.membershipList',compact('memberships'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.membership.membershipAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			$validator = Validator::make(
			  array(
					'Title'    => $request->name,
					'Price' => $request->price,
					'Duration'    => $request->duration,
					'Description'  => $request->description,
					'Status'  => $request->is_active					
				),
				array(
					'Title'    => 'required',
					'Price' => 'required',
					'Duration'    => 'required',
					'Description'    => 'required',					
					'Status'  => 'required',					
				)
		);

		if ($validator->fails())
		{
			return redirect('addMembership')->withErrors($validator);
		}
		$membership = $this->user_gestion->addMembership($request);	
		
		if($membership)
			return redirect('membership')->with('status', 'Membership plan added successfully!!');		
		else
			return redirect('membership')->with('status', 'There is some problem please check!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $membership = $this->user_gestion->getMembershipPlan($id);
		
		return view('admin.membership.membershipEdit',compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
			$validator = Validator::make(
			  array(
					'Title'    => $request->name,
					'Price' => $request->price,
					'Duration'    => $request->duration,
					'Description'  => $request->description,
					'Status'  => $request->is_active					
				),
				array(
					'Title'    => 'required',
					'Price' => 'required',
					'Duration'    => 'required',
					'Description'    => 'required',					
					'Status'  => 'required',					
				)
		);

		if ($validator->fails())
		{
			return redirect('showMembership/'.$id)->withErrors($validator);
		}
		
		$email = $this->user_gestion->updateMembershipPlan($request, $id);
		return redirect('membership')->with('status', 'Membership Plan template updated successfully !!');	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
