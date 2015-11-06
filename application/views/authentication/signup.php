<?php
/**
 * Created by PhpStorm.
 * User: subhegde
 * Date: 1/10/15
 * Time: 12:40 PM
 */
?>
<div class="main-contents-with-3col">
    <form id="signup-frm" name="signUpFrm" action="signup" method="post" ng-app="signUp" ng-controller="signUpCtrl">
        <div id="sign-up-block" >
            <fieldset>
                <legend>Create New Account with us</legend>
                <table border="0">
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
</script>