<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>补全资料</title>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\weui.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\weui.mini.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\add\weui.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\add\weui2.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\add\weui3.css"/>
        <script src="http://chn.ittun.com\jquery-3.1.1.js"></script>
    </head>
    <body ontouchstart style="background-color: #f8f8f8;">
    <div align="center">
	<form method="post" action="">
    <div class="weui_cells_title">萬利汽车生活馆祝您车行万里，一路平安！</div>
    {!!csrf_field() !!}
    <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">姓名</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name ="name" class="weui_input" type="text" value="{{$userinfo->name}}" placeholder="请输入姓名" />
                </div>
            </div>
    <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">电话</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="mobile" type="number" value="{{$userinfo->mobile}}" placeholder="请输入姓名"/>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">邮箱</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="email"  type="text" value="{{$userinfo->email}}" placeholder="请输入邮箱"/>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">年龄</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="age"  type="number" value="{{$userinfo->age}}" placeholder="请输入年龄"/>
                </div>
            </div>

            <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">车牌号</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="carno" type="text" value="{{$userinfo->carno}}" placeholder="请输入车牌号"/>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">里程</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="miles" type="text" value="{{$userinfo->miles}}" placeholder="请输入里程(km)"/>
                </div>
            </div>
                
            <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">会员卡号</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="cardno" type="number" value="{{$userinfo->cardno}}" placeholder="请输入会员卡号"/>
                </div>
            </div>

             <div class="weui_cell weui_cell_select weui_select_after">
                <div class="weui_cell_hd">
                    <label for="" class="weui_label">会员卡类型</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select id = "cardtype" class="weui_select" name="cardtype" value="">
                    @if($userinfo->cardtype==1)
                        <option selected= "selected" value="1">金卡</option>
                    @else
                        <option  value="1">金卡</option>
                    @endif
                    @if($userinfo->cardtype==2)
                        <option selected= "selected" value="2">银卡</option>
                    @else
                        <option value="2">银卡</option>
                    @endif
                    @if($userinfo->cardtype==3)
                        <option selected= "selected" value="3">基础卡</option>
                    @else
                        <option value="3">基础卡</option>
                    @endif
                    </select>
                </div>
            </div>            
             <div class="weui_btn_area">
        <input type="submit" id="submit"  value="提交"  placeholder="" class="weui_btn weui_btn_primary" />
    </div>
    </form>
    </div>
    <script type="text/javascript"> 
        $(function(){
            $("form").submit(function(){
                //取得用户填写的信息
                //姓名
                var name = $("input[name=name]").val();
                //手机号
                var mobile = $("input[name=mobile]").val();
                //邮箱
                var email = $("input[name=email]").val();
                //年龄
                var age = $("input[name=age]").val();
                //卡号
                var cardno = $("input[name=cardno]").val();
                //里程
                var miles = $("input[name=miles]").val();
                //卡号
                var carno = $("input[name=carno]").val();
                //卡类型
                var cardtype = $("#cardtype").val();
                //判断用户是否有空白信息未填
                if(name&&mobile&&email&&age&&cardno&&miles&&carno&&cardtype){                    
                    //验证手机号是否合法
                    var reg_mobile = /^1[3|4|5|7|8][0-9]{9}$/; //手机验证规则
                    var flag_mobile = reg_mobile.test(mobile); 
                    if(!flag_mobile){
                        alert('请检查手机号长度或者格式！')
                        return false;
                    }
                    //验证邮箱名是否合法
                    var reg_email = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;//邮箱验证规则
                    var flag_email = reg_email.test(email);
                    if(!flag_email){
                        alert('请检查邮箱格式！');
                        return false;
                    }                
                }else{
                    alert("请:①正确填写信息②将信息填满!\n以便我们更好的为您服务");
                    return false;
                }
                    });
            });                                                   
            
                     
        
        

    </script>

    


    </body>
</html>
