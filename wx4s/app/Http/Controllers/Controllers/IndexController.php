<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use App\User;
use DB;
class IndexController extends Controller
{    
    public $app = '';
    public function __construct(){
         $options = [
                    'debug'  => true,
                    'app_id' => 'wxe2f66d1dbc04eb3a',
                    'secret' => 'd08a227000764143c3c66aa443b143fe',
                    'token'  => 'chenghaineng',
                    // 'aes_key' => null, // 可选
                    'log' => [
                        'level' => 'debug',
                        'file'  => 'F:\Bool\Tools\xampp\htdocs\src\fx/easywechat.log', // XXX: 绝对路径！！！！
                    ],
                    //...
        ];
        $this->app = new Application($options);
    }

    /*public function welcome(){
        return view('welcome');
    }*/

    public function index()
    {       

        //服务端验证      
        /*
        $app = new Application($options);
        $response = $app->server->serve();
        return $response;
        */
        // ...
        
        $server = $this->app->server;        

        $server->setMessageHandler(function($message){
            // 注意，这里的 $message 不仅仅是用户发来的消息，也可能是事件
            // 当 $message->MsgType 为 event 时为事件
            if ($message->MsgType == 'event') {              
                return $this->eventReply($message);
            }elseif($message->MsgType == 'text'){
                return $this->textReply($message);
            }
        });
        $response = $server->serve();
        $response->send(); // Laravel 里请使用：return $response;

    }


    public function eventReply($message){ 
        $userModel = new User();
        $openid = $message->FromUserName;
        $userService = $this->app->user;
        //得到userinfo对象
        $userinfo = $userService->get($openid); 
        switch ($message->Event) {
                    case 'subscribe': 
                        //判断用户是否已存在
                        $user = $userModel->where("openid",$openid)->first(); 

                        if($user){
                            $user->subscribe = 1;
                            $user->save();
                        }else{                            
                            $userModel->openid = $openid;                   
                            $userModel->nickname = $userinfo->nickname;
                            $userModel->sex = $userinfo->sex;
                            $userModel->city = $userinfo->city;
                            $userModel->subscribe_time = $userinfo->subscribe_time;
                            $userModel->subscribe = $userinfo->subscribe; 
                            $userModel->save();
                        }

                        
                        return  $userinfo->nickname.",欢迎关注".'<br>'.$openid.'<br>'.$userinfo->sex.'<br>'.$userinfo->city.'<br>'.$userinfo->subscribe_time.'<br>'.$userinfo->subscribe;      
                        break;

                    case 'unsubscribe':
                        $user = $userModel->where("openid",$openid)->first();
                        $user->subscribe = 0;
                        $user->save(); 
                        break;

                    default:
                        # code...
                        break;
                } 
                }
    


    public function textReply($message){


                       
    }

}
