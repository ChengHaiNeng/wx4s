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

    public function fullfill(){
        if(empty($_POST)){
            return view('fullfill');
        }else{


            //var_dump($_POST);
            //name  mobile  email  age  carno  cardno  cardtype

            //从session中
            $se = session('userinfo'); 
            $openid = $se->original['openid']


            $userModel = new User();
            $userModel->name = $_POST['name'];
            $userMoel->mobile = $_POST['mobile'];
            $userModel->email = $_POST['email'];
            $userModel->age = $_POST['age'];
            $userModel->carno = $_POST['carno'];
            $userModel->cardno = $_POST['cardno'];
            $userModel->cardtype = $_POST['cardtype'];

            $rs = $userModel->where('openid',$openid)->save();
            if($rs){
                return view('info.fillsucc');
            }else{
                return view('info.fillfail');
            }

        }
    }
}
