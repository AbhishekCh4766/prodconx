<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Models\Content;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

use Validator;

class ContentController extends Controller
{
	
	/**
	 * The UserRepository instance.
	 *
	 * @var App\Repositories\UserRepository
	 */
	protected $user_gestion;	
	
	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @param  App\Repositories\RoleRepository $role_gestion
	 * @return void
	 */
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
 			$contents = $this->user_gestion->getContentList();
			return view('admin.content.contentList',compact('contents'));       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.content.contentAdd');
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
					'Name'             => $request->name,
					'Description'      => $request->description,
					'Short Description'=> $request->short_description,
					'Meta Title'       => $request->meta_title,
					'Meta Keyword'     => $request->meta_keyword,
					'Meta Description' => $request->meta_description,
				),
				array(
					'Name'                 => 'required',
					'Description'          => 'required',
					'Short Description'    => 'required',
					'Meta Title'           => 'required',
					'Meta Keyword'         => 'required',
					'Meta Description'     => 'required',					
				)
		);

		if ($validator->fails())
		{
				return Redirect::back()->withInput()->withErrors($validator);
		}
		else{
			$content_id = $this->user_gestion->addContent($request);
			if($content_id)
			    return redirect('contents')->with('status', 'Content added Successfully !!!');	
			else
				return Redirect::back()->withInput()->with('status',"Please check something went wronge." );
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
	    $content = $this->user_gestion->getContent($id);
		
		//echo'<pre>';print_r($email);die;
		
		return view('admin.content.contentEdit',compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		echo 'here';
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
		
		$content = $this->user_gestion->updateContent($request, $id);
		return redirect('/contents')->with('status', 'Content updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		echo('delete');
        //
    }
}
