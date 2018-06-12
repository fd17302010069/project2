<?php
function myAlert($notice,$haveOkButton=true){
    ?>
    <div class="shield">
        <div class="alert_content">
            <div class="alert_header">提示</div>
            <div class="alert_body"><?php echo $notice?></div>
            <div class="alert_footer">
                <?php
                    if($haveOkButton){
                        ?>
                        <button class="okButton" type="button">确认</button>
                        <?php
                    }
                    else{
                        ?>请等待页面跳转......<?php
                    }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>