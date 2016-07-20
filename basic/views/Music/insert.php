<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="./assets/js/commonss.css">
    <link rel="stylesheet" type="text/css" href="./assets/js/mainss.css">
    <script type="text/javascript" src="./assets/js/modernizrss.js"></script>
</head>
<body>

<div class="container clearfix">
    <include file="Public:left" />
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">作品管理</a><span class="crumb-step">&gt;</span><span>新增作品</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="index.php?r=music/insert" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                        <tr>
                            <th><i class="require-red">*</i>新增文件：</th>
                            <td>
                                <select name="type" id="">
                                    <option value="1">音频</option>
                                    <option value="2">视频</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>新增文件：</th>
                            <td>
                                <input type="file"  name="img[]" multiple>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <input class="btn btn-primary btn6 mr10" value="提交" id="button" type="submit">
                                <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button" >
                            </td>
                        </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>
<script src="jq.js"></script>
