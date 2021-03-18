<?php

namespace App\Traits;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;


trait FacebookTrait
{
    private $api;
	public function __construct()
	{
		$this->middleware(function ($request, $next) {
            // Intiating the facebook graph api
            // the app creds can be pulled from env my env was returning null so I made a configration file and pulled the value from there
			$app_id = config('services.facebook.client_id');
			$app_secret = config('services.facebook.client_secret');
			$redirect = config('services.facebook.redirect');
            // instantiated the facebook graph api
            $fb = new \Facebook\Facebook([
				'app_id' => $app_id,
				'app_secret' => $app_secret,
				'default_graph_version' => 'v2.10',
			]);
			if (isset(Auth::user()->token)) {
				$fb->setDefaultAccessToken(Auth::user()->token);
			}
			$this->api = $fb;
			return $next($request);
		});
	}

	public function conversation()
	{
		// print_r(auth()->user());
		// exit;
		echo '<pre>';
        // pull the page id from the database
		// this is the test account page id in live user will add his page id to the system which we will use for rest of the calls.
        // https://developers.facebook.com/docs/graph-api/reference/page/
        // $page_id = '101987291964285';
        $page_id = '107019688133508';
		echo 'here';

		try {
			// Returns a `Facebook\FacebookResponse` pages access token object
			$response = $this->api->get('/' . $page_id . '?fields=access_token',auth()->user()->token);
			
		} catch (FacebookResponseException $e) {
            // you can use toaster to display the error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch (FacebookSDKException $e) {
            // you can use toaster to display the error
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
        // pull the array of pages of users access_token.
		$pages = $response->getGraphNode()->asArray();
        // for getting the conversations of the pages use this endpoint and create leads.
        // https://developers.facebook.com/docs/graph-api/reference/v9.0/conversation#edges

		try {
			// Returns a `Facebook\FacebookResponse` object
			$conversation_response = $this->api->get(
				'/' . $page_id . '/conversations?fields=participants{name,email},id',
				$pages['access_token']
			);
		} catch (FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch (FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
        $conversation_response = $conversation_response->getDecodedBody();
		print_r($conversation_response);
		exit;
	}
}