<script src="jq.js"></script>
<input type="button" value="音频" class="yin" style="width: 40%;float: left;background-color: #ffffff">
<input type="button" value="视频" class="shi"  style="width: 40%;float: left;background-color: #ffffff">
<!--音乐-->
<div class="m" style="width: 100%">
    <div class="mo" style="width: 40%;height: 500px;background-color: #2aabd2;float: left;text-align: center">
        <h1 >音频</h1>
        <table style="width: 100%">
            <?php foreach($data['music'] as $k=>$v){?>
            <tr >
                <td dir="<?php echo $v['v_src']?>" class="mu"><?php echo $v['v_name']?></td>
            </tr>
            <?php }?>
        </table>
    </div>

    <div class="mt" style="width: 40%;height: 500px;background-color: honeydew;float: left">
        <audio src="" controls="controls" id="mb">
        </audio>
    </div>
</div>
<!--视频-->
<div class="v " style="width: 100%;display: none">
    <div class="vo" style="width: 40%;height: 500px;background-color: #2aabd2;float: left;text-align: center">
        <h1 >视频</h1>
        <table style="width: 100%">
            <?php foreach($data['video'] as $k=>$v){?>
                <tr >
                    <td dir="<?php echo $v['v_src']?>" class="vu"><?php echo $v['v_name']?></td>
                </tr>
            <?php }?>
        </table>
    </div>
    <input type="hidden" class="id" id="<?php echo \Yii::$app->session['uname'] ?>">
    <div class="vt" style="width: 40%;height: 500px;background-color: honeydew;float: left">
            <video src=""  autoplay="autoplay"  id="vb" width="530px" height="500px">
            </video>
    </div>
</div>
<script>
    /*
    监听正在播放的广告，
    */

    /*
    * 切换音乐*/
    $('.mu').click(function(){
        var dir=$(this).attr('dir');
        $('#mb').attr('src',dir);
    })
    /*
    * 切换视频*/
    $('.vu').click(function(){
        var dir=$(this).attr('dir');
        var id=$(".id").attr('id');
        if(id){
            $("#vb").attr("src",'./assets/video/guang.mp4');
            var video=document.getElementById("vb");
            video.addEventListener("ended",function(){
                $(this).attr("src",dir);
                $(this).attr("controls","controls")
            })
        }else{
            $('#vb').attr('src',dir);
        }
    })
     /*
    * 切换类型
    * */
    $('.yin').click(function(){
        $(this).css('background','red');
        $('.shi').css('background','white');
        $('.m').show();
        $('.v').hide();
    })
    $('.shi').click(function(){
        $(this).css('background','red');
        $('.yin').css('background','white');
        $('.v').show();
        $('.m').hide();
    })
 </script>
