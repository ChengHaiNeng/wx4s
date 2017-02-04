<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use App\User;
use App\Yuyue;
use DB;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Text;
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



//当发来的信息为event事件时候处理的返回
    public function eventReply($message){ 
        $userModel = new User();
        $yuyueModel = new Yuyue();
        $openid = $message->FromUserName;
        $userService = $this->app->user;
        //得到userinfo对象
        $userinfo = $userService->get($openid);
        
        switch ($message->Event) {
                    case 'subscribe': 
                        //判断用户是否已存在
                        $user = $userModel->where("openid",$openid)->first(); 
                        //判断预约表中是否已有记录
                    /*    $yuyue = $yuyueModel->where("openid",$openid)->first();
                        if(!$yuyue){
                            //如果没有记录，则插入一条记录
                            $yuyueModel->openid = $openid; 
                            $yuyueModel->save();
                        }
                    */

                        if($user){
                            $user->subscribe = 1;
                            $user->save();
                        }else{
                        //关注后将数据插入users表                         
                            $userModel->openid = $openid;                   
                            $userModel->nickname = $userinfo->nickname;
                            $userModel->sex = $userinfo->sex;
                            $userModel->city = $userinfo->city;
                            $userModel->subscribe_time = $userinfo->subscribe_time;
                            $userModel->subscribe = $userinfo->subscribe; 
                            $userModel->save();
                           
                        }
                        //多图文消息
                        $news1 = new News([
                                'title'=>'您有一张优惠券(万利汽车生活馆)',
                                'description'=>'您有一张优惠券',
                                
                                'image'=>'http://chn.ittun.com/images/yhq.png',
                            ]);
                        $news2 = new News([
                                'title'=>"下次保养日期为:2018-11-31",
                                'description'=>"保养日期：您上次保养日期为:xxx,保养内容:XXX \n 下次保养里程为XXX",
                                
                                'image'=>'http://chn.ittun.com/images/xcby.png',
                            ]);
                        $news3 = new News([
                                'title'=>'下次保险日期为:2015-11-11',
                                'description'=>'下次保险日期为:2015-11-11',                                
                                'image'=>'http://chn.ittun.com/images/xcbx.png',
                            ]);
                        $news4 = new News([
                                'title'=>'下次年审日期为:2017-11-22',
                                'description'=>'下次年审日期为:2017-12-11',
                                
                                'image'=>'http://chn.ittun.com/images/xcns.png',
                            ]);                      
                        return   [$news1,$news2,$news3,$news4]; 
                        /*$userinfo->nickname.",欢迎关注".'<br>'.$openid.'<br>'.$userinfo->sex.'<br>'.$userinfo->city.'<br>'.$userinfo->subscribe_time.'<br>'.$userinfo->subscribe;  */    
                        break;

                    case 'unsubscribe':
                        $user = $userModel->where("openid",$openid)->first();
                        $user->subscribe = 0;
                        $user->save(); 
                        break;
                    case 'CLICK':
                    	if($message->EventKey=="zxyy"){

                    		$news1 = new News([
                                'title'=>'点此预约',
                                'description'=>'请提前一天预约，如预约未成功可致电：18888888888',
                                'image'=>'http://chn.ittun.com/images/yhq.png',
                            ]);
                    		return   [$news1];

                    	}
                    	break;
                    default:
                        # code...
                        break;
                } 
            }    


//当发来的信息为text消息时候处理的返回
    public function textReply($message){
        if($message->Content=="wifi"||$message->Content=="密码"){
            $text = new Text(
            ['content'=>"欢迎光临万利汽车生活馆！\nWIFI名称:万利汽车生活馆 \n密码:66666666"]);
            return $text;
        }

                       
    }
}
