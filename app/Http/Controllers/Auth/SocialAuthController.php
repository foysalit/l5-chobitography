<?php namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\SocialAuth;

use Illuminate\Http\Request;

class SocialAuthController extends Controller {

	public function init(SocialAuth $authenticateUser, Request $request, $provider = null) {
       return \Socialize::with('facebook')->redirect();
       //return $authenticateUser->execute($request->all(), $this, $provider);
    }
	public function login(SocialAuth $authenticateUser, Request $request, $provider = null) {
       $user = \Socialize::with('facebook')->user();
       dd($user);
    }
}
