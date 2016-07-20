<div style="margin-left: 100px;margin-top: 100px" id="content">
    <ur>
        <?php
        foreach($res as $val){
            ?>
            <li><a href="javascript:void(0)" class="dian" zhi="<?php $val['v_name'] ?>"><?php echo $val['v_name'] ?></a></li>
        <?php
        }
        ?>
    </ur>
</div>