<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <form method="post" action="{{url('test/handle')}}">

                    {{csrf_field()}}


                    <table class="add_tab">
                        <tbody>
                        <tr>
                            <th width="120"><i class="require">*</i>原密码：</th>
                            <td>
                                <input type="password" name="oldpassword"></i>请输入原始密码</span>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require">*</i>新密码：</th>
                            <td>
                                <input type="password" name="newpassword"> </i>新密码6-20位</span>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require">*</i>确认密码：</th>
                            <td>
                                <input type="password" name="newpassword_confirmation"> </i>再次输入密码</span>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <input type="submit" value="提交">
                                <input type="button" class="back" onclick="history.go(-1)" value="返回">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
