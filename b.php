<?php
$title=$_POST['title'];
$url="http://tts.baidu.com/text2audio?lan=zh&ie=UTF-8&spd=2&text=$title";
echo "<script> location.href='$url'</script>";