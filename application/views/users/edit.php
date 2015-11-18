<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/11/15
 * Time: 12:20 PM
 */

?>


<div id="main-contents-with-3col">
    <?php echo validation_errors(); ?>
    <?php $this->load->view('templates/message'); ?>
    <form id="create-user-frm" name="create-user-frm" action="<?php echo site_url('users/save') ?>" method="post"  ng-app="signUp" ng-controller="signUpCtrl">
        <input type="hidden" id="userId" name="id" value="<?php echo isset($user_id)?$user_id:''; ?>">
        <div id="edit-user-blocks" >
            <fieldset>
                <legend><?php echo $pageTitle ?></legend>
                <table border="0">
                    <tr>
                        <td>First Name</td>
                        <td>
                            <input type="text" name="first_name" id="first_name" value="<?php echo isset($first_name)?$first_name:''; ?>" ng-model="firstName" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="last_name" id="last_name" value="<?php echo isset($last_name)?$last_name:''; ?>" ng-model="last_name" required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" name="email" id="email" value="<?php echo isset($email)?$email:''; ?>" ng-model="email" required>
                            <div class="error" id="email-errror-msg"></div>
                        </td>
                    </tr>
                    <?php if(!isset($user_id)): ?>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" id="password" ng-model="password" required></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td><input type="password" name="cnfrm_password" id="cnfrm_password" ng-model="cnfrm_password" required></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td>Address</td>
                        <td><textarea name="address" id="address" cols="50" rows="3"><?php echo isset($address)?$address:''; ?></textarea> </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone" id="phone" value="<?php echo isset($phone)?$phone:''; ?>" ng-model="phone"></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><input type="text" name="mobile" id="mobile" value="<?php echo isset($mobile)?$mobile:''; ?>" ng-model="mobile"></td>
                    </tr>
                    <tr>
                        <td>Roles</td>
                        <td>
                            <input type="checkbox" name="roles[]" id="role1" checked/><label for="role1">Create Order</label>
                            <input type="checkbox" name="roles[]" id="role2" checked/><label for="role2">Create Users</label>
                            <input type="checkbox" name="roles[]" id="role3"/><label for="role3">Create Contacts</label>
                            <input type="checkbox" name="roles[]" id="role4"/><label for="role4">Process Orders</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" id="create-user-submit-btn" value="Create">
                            <input type="button" value="Cancel">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </form>
</div>

<script type="application/javascript">
    var isemailValid = 0;
    $().ready(function(){
        $("#email").blur(function(){
            var email = $(this).val();
            var userId = $("#userId").val();
            var data = {
                "email":email,
                "id" : userId
            }
            var errorMsg = "";
            $("#email-errror-msg").html("");
            if(!isValidEmailAddress(email) || email ==""){
                //$("#email-errror-msg").html("Invalid email address");
                isemailValid = 0;
                return false;
            }
            $.ajax({
                type :"POST",
                url:baseUrl+"/users/validateUserEmail",
                data: data,
                async:false,
                dataType:"JSON",
                success: function(responseData){
                    switch(responseData.status){
                        case 0:
                            errorMsg = "Invalid email address";
                            isemailValid = 0;
                            break;
                        case 1:
                            errorMsg = "";
                            isemailValid = 1;
                            break;
                        case 2:
                            errorMsg = "Email already exists";
                            isemailValid = 0;
                            break;

                        default :
                            errorMsg = "Unable to validate email. Please try again";
                            isemailValid = 0;
                            break;
                    }
                    $("#email-errror-msg").html(errorMsg);
                }
            })
        });

        $("#create-user-submit-btn").click(function(){
            if($( "#email" ).blur()){
                if(isemailValid){
                    $("#create-user-frm").submit();
                }
            }

        });

        $( "#create-user-frm" ).validate({

            rules: {
                password: "required",
                cnfrm_password: {
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required : function(element){
                        if($("#mobile").val() ==""){
                            return true;
                        } else {
                            return false;
                        }
                    }
                },
                mobile: {
                    required: function(element){
                        if($("#phone").val() ==""){
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            }
        });
    })


    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
</script>