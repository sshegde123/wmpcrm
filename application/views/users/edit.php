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
    <form id="create-user-frm" name="create-user-frm" action="<?php echo site_url('users/save') ?>" method="post" ng-app="signUp" ng-controller="signUpCtrl">
        <input type="hidden" id="userId" name="userId" value="1">
        <div id="edit-user-blocks" >
            <fieldset>
                <legend><?php echo $pageTitle ?></legend>
                <table border="0" width="500">
                    <tr>
                        <td>First Name</td>
                        <td>
                            <input type="text" name="first_name" id="first_name" ng-model="firstName" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="last_name" id="last_name" ng-model="last_name" required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" name="email" id="email" ng-model="email" required>
                            <div class="error" id="email-errror-msg"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" id="password" ng-model="password" required></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="cnfrm_password" id="cnfrm_password" ng-model="cnfrm_password" required></td>
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td><textarea name="address" id="address" cols="50" rows="3"></textarea> </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone" id="phone" ng-model="phone" required></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><input type="text" name="mobile" id="mobile" ng-model="mobile" required></td>
                    </tr>
                    <tr>
                        <td>Roles</td>
                        <td>
                            <input type="checkbox" name="roles[]" id="role1"/><label for="role1">Create Order</label>
                            <input type="checkbox" name="roles[]" id="role2"/><label for="role2">Create Users</label>
                            <input type="checkbox" name="roles[]" id="role3"/><label for="role3">Create Contacts</label>
                            <input type="checkbox" name="roles[]" id="role4"/><label for="role4">Process Orders</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" id="create-user-submit-btn" value="Create">
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
                $("#email-errror-msg").html("Invalid email address");
                return false;
            }
            $.ajax({
                type :"POST",
                url:baseUrl+"/users/validateUserEmail",
                data: data,
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
            if(isemailValid && isValidEmailAddress){
                $("#create-user-frm").submit();
            } else {
                if($("#email-errror-msg").html()==""){
                    $("#email-errror-msg").html("Invalid email address");
                }
            }
        });
    })

    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
</script>