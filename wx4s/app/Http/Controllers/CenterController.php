<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CenterController extends Controller
{
    public $app = "";
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
                      'oauth' => [
                              'scopes'   => ['snsapi_userinfo'],
                              'callback' => '/login',
                          ],
                    //...
        ];
        $this->app = new Application($options);
    }
//用户中心
    public function center(Request $req){       
        if(!$req->session()->has('userinfo')){    
            $oauth = $this->app->oauth;       
            return $oauth->redirect();         
        }

        $se = session('userinfo');   
        $info = [];
        //var_dump($se);     
        //var_dump($se->original['openid']);nickname sex city
        $info['openid'] =  $se->original['openid'];
        $info['nickname'] =  $se->original['nickname'];
        $info['sex'] =  $se->original['sex'];
        $info['city'] =  $se->original['city'];
        $path = public_path();
        return view('center')->with(['info'=>$info,'path'=>$path]);

    }

    public function login(){
        $oauth = $this->app->oauth;
        $user = $oauth->user();
        session()->put('userinfo',$user);
        return redirect('center');
    }

    public function logout(){
        session()->forget('userinfo');
    }
//在线预约
    public function zxyy(Request $req){
    	if(!$req->session()->has('userinfo')){    
            $oauth = $this->app->oauth;
            //如果还没有登陆过，把它转到登录授权页面，然后登陆完了进入用户中心       
            return $oauth->redirect();         
        }
//如果已经登陆过，则可以直接进入 "在线预约页面",并且携带相关信息
        $se = session('userinfo');   
        $info = [];
        //var_dump($se);     
        //var_dump($se->original['openid']);nickname sex city
        $info['openid'] =  $se->original['openid'];
        $info['nickname'] =  $se->original['nickname'];
        $info['sex'] =  $se->original['sex'];
        $info['city'] =  $se->original['city'];
        return view('center.zxyy')->with("info",$info);
    }
}
