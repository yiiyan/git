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
                <form action="index.php?r=reply/reply" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                        <tr>
                            <th width="120">选择用户:</th>
                            <td>
                                <select name="aid" id="">
                                <option value="--请选这用户--">--请选这用户--</option>
                                <?php foreach($arr as $v){ ?> 
                                    <option value="<?php echo $v['aid']?>"><?php echo $v['aname']?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>规则名：</th>
                            <td>
                                <input class="common-text required" id="title" name="rename" size="50" value="" type="text" placeholder="关键字">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>关键字：</th>
                            <td>
                                <input class="common-text required" id="title" name="rekeyword" size="50" value="" type="text" placeholder="请回复">
                            </td>
                        </tr>
                         <tr>
                            <th><i class="require-red">*</i>内容：</th>
                            <td>
                                <input class="common-text required" id="title" name="trcontent" size="50" value="" type="text" placeholder="内容">
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
<script src="jq.js">

</script>
