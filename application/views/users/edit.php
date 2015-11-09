<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/11/15
 * Time: 12:20 PM
 */


?>


<div id="main-contents-with-3col">
    <form id="create-user-frm" name="create-user-frm" action="<?php echo site_url('users/save') ?>" method="post" ng-app="signUp" ng-controller="signUpCtrl">
        <div id="edit-user-blocks" >
            <fieldset>
                <legend><?php echo $pageTitle ?></legend>
                <table border="0" width="500">
                    <tr>
                        <td>First Name</td>
                        <td>
                            <input type="text" name="first_name" id="first_name" ng-model="firstName" required>
                            <div class="mandatory" ng-show="signUpFrm.firstName.$dirty && signUpFrm.firstName.$invalid">
                                <span ng-show="myForm.firstName.$error.required">Enter your first name.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="last_name" id="last_name" ng-model="last_name" required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" id="email" ng-model="email" required></td>
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
                            <input type="submit" value="Create">
                            <input type="button" value="Cancel">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </form>
</div>

<script>
    var app = angular.module("signUp",[]);
    app.controller('signUpCtrl', function($scope){

    })
    alert($("#"))
</script>