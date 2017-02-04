<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Yuyue;
use DB;

class YuyueController extends Controller
{
	//在线预约模块
    public function zxyy(){
    	if(empty($_POST)){
            //根据openid从数据中取出数据回显到资料填写页面
            $yyModel = new Yuyue();
            $se = session('userinfo'); 
            $openid = $se->original['openid'];
            //应当取出当前用户最近一条记录
            $yyinfo = DB::select(' select  * from yuyues where openid=? order by yid desc ', ["$openid"]);
            $yyinfo = $yyinfo[0];
            return view('center.zxyy')->with("yyinfo",$yyinfo);
        }else{
        	//预约到达那天
        	$thatday = $_POST['date'];
        	//当前用户openid
        	$se = session('userinfo');
            $openid = $se->original['openid'];
            //取出预约到达那天,当前用户openid在数据库中是否有记录
            $rs = DB::table('yuyues')->where(['date'=>$thatday,'openid'=>$openid])->first();
            if($rs){
				return view('info.yyfail');
				exit();            	
            }
        	$yyModel = new Yuyue(); 
            //取出post中的数据
            $yyModel->name = $_POST['name'];
            $yyModel->mobile = $_POST['mobile'];
            $yyModel->carno = $_POST['carno'];
            $yyModel->miles = $_POST['miles'];

            //预约到达的日期
            $yyModel->date = $thatday;
            //预约到达的时间
            $yyModel->time = $_POST['time'];

            //操作预约的时间
            $yyModel->yytime = time();
            

            //①将传过来的date，去数据库中，如果找到并且openid也相同，则
            //显示提交失败：您今天已预约过：提示：②是否修改预约时间,进入到另一个
            //方法修改时间
            //③如果查询预订情况的话，按照①预约日期②yytime预约时操作的时间 排序
            //group by openid 即可
            


            $yyModel->openid = $openid;                                   
            $rs = $yyModel->save();
            if($rs){
                return view('info.yysucc');
            }else{
            	var_dump('系统出现问题，请稍后再试，或与管理员联系:');
            	exit();	
            }
            
        }
    }

    //当天已经预约，需要修改预约
    public function reyy(){
    	//同一天修改预约
    	//
    	$se = session('userinfo'); 
	    $openid = $se->original['openid'];
    	if(empty($_POST)){   		
	        $yyModel = new Yuyue();
	        //应当取出当前用户最近一条记录
	        $yyinfo = DB::select(' select  * from yuyues where openid=? order by yid desc ', ["$openid"]);
            $yyinfo = $yyinfo[0];

	        return view('center.zxyy')->with("yyinfo",$yyinfo);
    	}else{
    		$yyModel = new Yuyue();
 			$yy = [];
 			$yy['name'] = $_POST['name'];
 			$yy['mobile'] = $_POST['mobile'];
 			$yy['carno'] = $_POST['carno'];
 			$yy['miles'] = $_POST['miles'];
 			$yy['date'] = $_POST['date'];  		
 			$yy['time'] = $_POST['time'];
 			$rs = $yyModel->where('openid',$openid)->update($yy);
 			if($rs){
 				return view('info.yysucc');
 			}else{
 				return view('info.yyfail2');
 			}
    	}	
    }

    //用来查看我的历史预约，显示最近的5条记录
    public function myyy(){
    	//取出openid
    	$se = session('userinfo'); 
	    $openid = $se->original['openid'];

	    $yyModel = new Yuyue();
	    //查询出该用户最近5次预约
	    $yyinfo = DB::table('yuyues')->where('openid',$openid)->orderBy('time','desc')->skip(0)->take(5)->get();
	    //将结果返回给myyy模板
	    return view('info.myyy')->with('yyinfos',$yyinfo);
    }
}
