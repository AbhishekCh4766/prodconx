<?php
namespace App\Http\Middleware;

use Closure;


class Loggedin
	{
			public function handle($request, Closure $next)
									{
												$api= $request->session()->get('email');
												
		
												if($api=='' )
												{
													return redirect('/login');
												}

										return $next($request);
									}
	}
?>
