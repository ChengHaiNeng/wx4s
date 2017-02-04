<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>我的预约</title>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\weui.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\weui.mini.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\add\weui.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\add\weui2.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\add\weui3.css"/>
    </head>
    <body ontouchstart style="background-color: #f8f8f8;">
    <ul>
    @foreach($yyinfos as $yyinfo)
    <li>预约到达时间:{{$yyinfo->date}} {{$yyinfo->time}}   何时预约:{{$yyinfo->yytime}}</li>
    @endforeach
    </ul>

    <div class="weui_opr_area">
        <p class="weui_btn_area">
            <a href="http://chn.ittun.com/center" class="weui_btn weui_btn_primary">用户中心</a>
            <a href="http://chn.ittun.com/zxyy" class="weui_btn weui_btn_default">去预约</a>
        </p>
    </div>
</div>

    </body>
</html>