<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

use Validator;
		

class EmailController extends Controller
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

	    $emails = $this->user_gestion->fecthAllEmailTemplates();			
        return view('admin.emailTemplateList',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.emailTemplateAdd');
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
					'Name'    => $request->name,
					'Subject' => $request->subject,
					'Text'    => $request->text,
					'Status'  => $request->is_active
				),
				array(
					'Name'    => 'required',
					'Subject' => 'required',
					'Text'    => 'required',
					'Status'  => 'required',					
				)
		);

		if ($validator->fails())
		{
			return redirect('emailTemplates')->withErrors($validator);
		}
		$emails = $this->user_gestion->storeEmailTemplate($request);	
		
		if($emails)
			return redirect('emailTemplates')->with('status', 'Email Template added successfully!!');		
		else
			return redirect('emailTemplates')->with('status', 'There is some problem please check!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
	    $email = $this->user_gestion->getEmailTemplate($id);
		
		//echo'<pre>';print_r($email);die;
		
		return view('admin.emailTemplateEdit',compact('email'));

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
					'Name'    => $request->name,
					'Subject' => $request->subject,
					'Text'    => $request->text,
					'Status'  => $request->is_active
				),
				array(
					'Name'    => 'required',
					'Subject' => 'required',
					'Text'    => 'required',
					'Status'  => 'required',					
				)
		);

		if ($validator->fails())
		{
			return redirect('showEmailTemplate/'.$id)->withErrors($validator);
		}
		
		$email = $this->user_gestion->updateEmailTemplate($request, $id);
		return redirect('emailTemplates')->with('status', 'Email template updated successfully !!');	
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
