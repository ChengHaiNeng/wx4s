<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



//填写个人信息
    public function fullfill(){
        if(empty($_POST)){
            //根据openid从数据中取出数据回显到资料填写页面
            $userModel = new User();
            $se = session('userinfo'); 
            $openid = $se->original['openid'];
            $userinfo = $userModel->where('openid',$openid)->first();
            return view('fullfill')->with("userinfo",$userinfo);
        }else{
            //取出post中的数据
            $user['name'] = $_POST['name'];
            $user['mobile'] = $_POST['mobile'];
            $user['email'] = $_POST['email'];
            $user['age'] = $_POST['age'];
            $user['carno'] = $_POST['carno'];
            $user['cardno'] = $_POST['cardno'];
            $user['cardtype'] = $_POST['cardtype'];
            $user['miles'] = $_POST['miles'];

            $userModel = new User();
            $se = session('userinfo'); 
            $openid = $se->original['openid'];
            $rs = $userModel->where('openid',$openid)->update($user);
            if($rs){
                return view('info/fillsucc');
            }else{
                return view('info/fillfail');
            }
        }
    }


//展示个人信息
    public function infolist(){
        //根据openid从数据中取出数据回显到资料填写页面
            $userModel = new User();
            $se = session('userinfo'); 
            $openid = $se->original['openid'];
            $userinfo = $userModel->where('openid',$openid)->first();
            return view('infolist')->with("userinfo",$userinfo);
    }


//公司静态展示
    public function company(){
            return view('info.company');
    }
}