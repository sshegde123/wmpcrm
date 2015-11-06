<?php
/**
 * Created by PhpStorm.
 * User: subhegde
 * Date: 14/9/15
 * Time: 12:38 PM
 */
//echo md5("123456");
?>
<div id="main-contents-with-3col">
    <div id="login-block" class="main-contents">
        <?php echo form_open('login',array('id'=>'login-form','method'=>'post')); ?>
        <fieldset>
            <legend>Login</legend>
            <div class="error" >
                <?php echo $loginMsg; ?>
                <?php echo validation_errors(); ?>
            </div>
            <div class="input-box">
                <label for="user-name">Username<span class="mandatory">*</span> </label>
                <input type="text" maxlength="50" name="userName" required id="userName">
            </div>

            <div class="input-box">
                <label for="password">Password<span class="mandatory">*</span> </label>
                <input type="password" maxlength="50" required  name="password" id="password">
            </div>

            <div>
                <input type="submit" value="Login">
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="application/javascript">
    /*$().ready(function(){
        $("#login-form").validate({
            rules : {
                userName : "required",
                password : "required"
            },
            messages : {
                userName : "Please enter User Name",
                password : "Please enter Password"
            }
        })
    });*/
</script>