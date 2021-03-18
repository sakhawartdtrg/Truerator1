<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Conversation;
use App\Models\ConversationMessages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\FacebookTrait;
use App\Models\Leads;
use App\Models\LeadSources;

class ChatController extends BaseController
{
    public $relation_id ;
    public $pages ;
    public $page_id;
    use FacebookTrait;
    public function __construct()
    {
        // return $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->page_id = '107019688133508';
            $app_id = config('services.facebook.client_id');
            $app_secret = config('services.facebook.client_secret');
            $redirect = config('services.facebook.redirect');
            $this->relation_id= Auth::user()->id;
            $fb = new \Facebook\Facebook([
                'app_id' => $app_id,
                'app_secret' => $app_secret,
                'default_graph_version' => 'v2.10',
            ]);
          
            if (isset(Auth::user()->token)) {
                $fb->setDefaultAccessToken(Auth::user()->token);
            }
            $this->api = $fb;
            try {
                // Returns a `Facebook\FacebookResponse` pages access token object
                $response = $this->api->get('/' . $this->page_id . '?fields=access_token',Auth::user()->token);
                
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
            $this->pages = $response->getGraphNode()->asArray();
            // return $next($request);
            return $next($request);
        });
        
        // instantiated the facebook graph api

        
        
        // print_r(Auth::user());
        // exit;
        
    }

    public function index()
    {
        return view('chat');
    }

    public function conversation_list($type=0){
        // type is opened or closed
        
        $conversations = Conversation::where('status',$type)
            ->with('lead')->whereHas("lead",function($q) {
                $q->where("relation_id","=",$this->relation_id);
            })->get();
        return $this->sendResponse($conversations, 'user conversation list');
    }
    public function conversation($conversation_id=""){
        $conversations = Conversation::where('id',$conversation_id)->with('lead')->first();
        return $this->sendResponse($conversations, 'user conversation data');
    }

    public function send_message(Request $request){
        // print_r($request->all());
        // exit;
        $conversation = Conversation::where('id',$request->conversation_id)->first();
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v9.0/me/messages?access_token='.$this->pages['access_token']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $data = ['recipient'=>['id'=>$conversation->recipient_id],'message'=>['text'=>$request->item['message']]];
        $data = \json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
       
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        // $graphNode = $response->getGraphNode();
        $data = ['conversation_id'=>$request->conversation_id,'message'=>$request->item['message'],'message_type'=>'text','sender_id'=>$this->relation_id];
        $message = ConversationMessages::create($data);

        if($message){
            return $this->sendResponse($message,'message sent');
        }else{
            return $this->sendError($message,'message failed');
        }
    }

    public function messages($conversation_id=""){
        // echo '<pre>';
        $messages = ConversationMessages::where('conversation_id',$conversation_id)->count();
        if(!$messages){
            $conversation = Conversation::where('id',$conversation_id)->first();
            // print_r($conversation);
            // exit;
            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $this->api->get('/'.$conversation->tx_id.'?fields=messages{message,from}',
                    $this->pages['access_token']
                );
            } catch (FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
            $response = $response->getGraphNode()->asArray();
           
            if(!empty($response)){
                foreach(array_reverse($response['messages']) as $message){

                    if($conversation->recipient_id == $message['from']['id'] ){
                        $sender_id = $conversation->lead_id;
                    }else{
                        $sender_id = $this->relation_id;
                    }
                    $data = ['conversation_id'=>$conversation_id,'message'=>$message['message'],'message_type'=>'text','sender_id'=>$sender_id];
                    $message = ConversationMessages::create($data);
                }
            }
            
        }
        $messages = ConversationMessages::where('conversation_id',$conversation_id)->with(['user' => function($query) {
            return $query->select(['id','email','first_name','last_name']);
        }])
        ->orderby('created_at','asc')->get();
        return $this->sendResponse($messages, 'user messages data');
    }


    public function get_conversation()
	{
		// print_r(auth()->user());
		// exit;
		echo '<pre>';
        // pull the page id from the database
		// this is the test account page id in live user will add his page id to the system which we will use for rest of the calls.
        // https://developers.facebook.com/docs/graph-api/reference/page/
        // $page_id = '101987291964285';
		

		
        // for getting the conversations of the pages use this endpoint and create leads.
        // https://developers.facebook.com/docs/graph-api/reference/v9.0/conversation#edges
      
		try {
			// Returns a `Facebook\FacebookResponse` object
			$conversation_response = $this->api->get(
				'/' . $this->page_id . '/conversations?fields=senders{name,email},id',
				$this->pages['access_token']
			);
		} catch (FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch (FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
        $conversation_response = $conversation_response->getGraphEdge()->asArray();
        // print_r($conversation_response);
        // exit;
        $type = LeadSources::where('page_id',$this->page_id)->first();
        // print_r($type);
        // exit;  
		if(!empty($conversation_response)){
           
            foreach($conversation_response as $response){
                $participant = $response['senders'][0];
                if(!Leads::where('tx_id',$response['id'])->first()){
                    
                    $lead = Leads::create(['relation_id'=>$this->relation_id,'type_id'=>$type->id,'name'=>$participant['name'],'email'=>$participant['email']]);
                    Conversation::create(['tx_id'=>$response['id'],'lead_id'=>$lead->id,'type_id'=>$type->id,'status'=>1,'recipient_id'=>$participant['id']]);
                }
            }
        }
	}

    public function get_messages(){
        // echo '<pre>';

        exit;
    }
}
