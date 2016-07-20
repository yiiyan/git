<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<!DOCTYPE html>
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" style=""><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="./assets/js/commonss.css">
    <link rel="stylesheet" type="text/css" href="./assets/js/mainss.css">
    <script type="text/javascript" src="./assets/js/modernizrss.js"></script>
</head>
<body>

<div class="container clearfix">

    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="file:///jscss/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">IP管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="/jscss/admin/design/index" method="post">
                    <table class="search-tab">
                        <tbody><tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="search-sort" id="">
                                    <option selected="selected" value="">全部</option>
                                    <option value="19">精品界面</option><option value="20">推荐界面</option>
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                        </tbody></table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="index.php?r=index/add"><i class="icon-font"></i>新增IP</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tbody>
                        
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>规则名：</th>
                            <th>关键字：</th>
                            <th>内容：</th>
                            <th><center>操作</center></th>
                        </tr>
                        
                        <?php
                        foreach($model as $key => $val) {
                            ?>
                            <tr>
                                <td class="tc"><input name="id[]" value="59" type="checkbox"></td>
                
                                <td><?php echo $val['rename'] ?></td>
                                <td><?php echo $val['rekeyword'] ?></td>
                                <td><?php echo $val['trcontent'] ?></td>
                                <td><center>
                                    <a class="link-del" href="index.php?r=reply/dele&id=<?php echo $val['reid']?>" >删除
                                    &nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="link-del" href="index.php?r=reply/up&id=<?php echo $val['reid'] ?>" >修改</a>
                                    </center>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>

                        </tbody></table>
                    <div class="list-page"><?= LinkPager::widget([ 'pagination' => $pages,  ]) ?></div> 
                </div>
            </form>

        </div>
    </div>
    <!--/main-->
</div>


</body></html>

<script type="text/javascript" src="./assets/js/modernizrss.js"></script>