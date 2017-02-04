<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>维修预约</title>
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
    <div class="weui_cells_title">请提前一天预约</div>
    {!!csrf_field() !!}
            
    
    <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">车牌号</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="carno" type="text" @if($yyinfo) value="{{$yyinfo->carno}}" @else value="" @endif placeholder="请输入车牌号"/>
                </div>
            </div>
    <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">送修人</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name ="name" class="weui_input" type="text" @if($yyinfo) value="{{$yyinfo->name}}" @else value="" @endif placeholder="请输入姓名" />
                </div>
            </div>
    <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">送修人手机</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="mobile" type="text" @if($yyinfo) value="{{$yyinfo->mobile}}" @else value="" @endif placeholder="请输入手机号"/>
                </div>
            </div>
    <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">公里数</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="miles" type="text" @if($yyinfo) value="{{$yyinfo->miles}}" @else value="" @endif placeholder="请输入里程(km)"/>
                </div>
            </div>

    <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">预约日期</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="date" type="date" value="" placeholder=""/>
                </div>
            </div>

    <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">预约时间</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="time" type="time" value="" placeholder="请输入预约时间"/>
                </div>
            </div>
    <div class="weui_btn_area">
        <input type="submit" id="submit"  value="预约"  placeholder="" class="weui_btn weui_btn_primary" />
    </div>
    </form>
    </div>
    
    <script type="text/javascript">
    $(function(){


        /*$("form").submit(function(){
            var carno = $("input[name=time]").val();
            var carno = carno.replace(/-/g,'/'); 
            var myDate = new Date(carno);
            var mytime=myDate.getTime();
            
            });*/
            $("form").submit(function(){
                //取得用户填写的信息
                //姓名
                var name = $("input[name=name]").val();
                //手机号
                var mobile = $("input[name=mobile]").val();       
                //里程
                var miles = $("input[name=miles]").val();
                //车牌号
                var carno = $("input[name=carno]").val();
                //预约日期
                var date = $("input[name=date]").val();
                //预约时间
                var time = $("input[name=time]").val();

                //将今天的日期换算为时间戳，用来做提前一天提交的作用
                var time_sub = date.replace(/-/g,'/'); 
                var date = new Date(time_sub);
                var time_sub = date.getTime();
                //现在的时间
                var date_now = new Date();
                var time_now = date_now.getTime();

                





                //判断用户是否有空白信息未填
                if(name&&mobile&&miles&&carno&&date&&time){                    
                    //验证手机号是否合法
                    var reg_mobile = /^1[3|4|5|7|8][0-9]{9}$/; //手机验证规则
                    var flag_mobile = reg_mobile.test(mobile); 
                    if(!flag_mobile){
                        alert('请检查手机号长度或者格式！')
                        return false;
                    }
                    if(time_sub-time_now<86400){
                    alert('请提前一天预约');
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
