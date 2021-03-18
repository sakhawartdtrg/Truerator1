<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Leads;
use App\Models\LeadSources;
use App\Models\Conversation;
use Auth;

class FacebookConversation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facebook:conversation';
    public $pages ;
    public $page_id;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will pull the latest conversation with page ids';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('page_id','!=',null)->get();
        $app_id = config('services.facebook.client_id');
        $app_secret = config('services.facebook.client_secret');
        $redirect = config('services.facebook.redirect');

      
        foreach($users as $user){
            $fb = new \Facebook\Facebook([
                'app_id' => $app_id,
                'app_secret' => $app_secret,
                'default_graph_version' => 'v2.10',
            ]);
            if (isset($user->token)) {
                $fb->setDefaultAccessToken($user->token);
            }
            $this->api = $fb;
    
            try {
                // Returns a `Facebook\FacebookResponse` pages access token object
                $response = $this->api->get('/' . $user->page_id . '?fields=access_token',$user->token);
                
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
           
            try {
                // Returns a `Facebook\FacebookResponse` object
                $conversation_response = $this->api->get(
                    '/' . $user->page_id . '/conversations?fields=senders{name,email},id',
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

            $type = LeadSources::where('page_id',$user->page_id)->first();
            
            if(!empty($conversation_response)){
               
                foreach($conversation_response as $response){
                    $participant = $response['senders'][0];
                    if(!Conversation::where('tx_id',$response['id'])->count()){
                        
                        $lead = Leads::create(['relation_id'=>$user->relation_id,'type_id'=>$type->id,'name'=>$participant['name'],'email'=>$participant['email']]);
                        Conversation::create(['tx_id'=>$response['id'],'lead_id'=>$lead->id,'type_id'=>$type->id,'status'=>1,'recipient_id'=>$participant['id']]);
                    }
                }
            }
        }
        $this->info('Facebook conversation is pulled');
    }

}
