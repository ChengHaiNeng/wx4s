<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>个人信息</title>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\weui.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\weui.mini.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\add\weui.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\add\weui2.css"/>
        <link rel="stylesheet" href="http://chn.ittun.com\weui\dist\style\add\weui3.css"/>
    </head>
    <body ontouchstart style="background-color: #f8f8f8;">
        <div class="weui_cells_title">萬利汽车生活馆祝您车行万里，一路平安！</div>
            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>姓名</p>
                    </div>
                    <div class="weui_cell_ft">
                        {{$userinfo->name}}
                    </div>
                </div>
            </div>

            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>电话</p>
                    </div>
                    <div class="weui_cell_ft">
                        {{$userinfo->mobile}}
                    </div>
                </div>
            </div>

            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>邮箱</p>
                    </div>
                    <div class="weui_cell_ft">
                        {{$userinfo->email}}
                    </div>
                </div>
            </div>

            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>年龄</p>
                    </div>
                    <div class="weui_cell_ft">
                        {{$userinfo->age}}
                    </div>
                </div>
            </div>

            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>车牌号</p>
                    </div>
                    <div class="weui_cell_ft">
                        {{$userinfo->carno}}
                    </div>
                </div>
            </div>

            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>里程</p>
                    </div>
                    <div class="weui_cell_ft">
                        {{$userinfo->miles}}
                    </div>
                </div>
            </div>

            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>会员卡号</p>
                    </div>
                    <div class="weui_cell_ft">
                         {{$userinfo->cardno}}
                    </div>
                </div>
            </div>

            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>会员卡类型</p>
                    </div>
                    <div class="weui_cell_ft">
                         @if($userinfo->cardtype==1)
                        金卡
                        @endif

                         @if($userinfo->cardtype==2)
                        银卡
                        @endif

                        @if($userinfo->cardtype==3)
                        基础卡
                        @endif
                    </div>
                </div>
            </div>
            <a href="http://chn.ittun.com/fullfill" class="weui_btn weui_btn_primary">修改资料</a>

    </body>
</html>