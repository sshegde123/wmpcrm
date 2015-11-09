<?php
/**
 * Created by PhpStorm.
 * User: subhegde
 * Date: 14/9/15
 * Time: 12:30 PM
 */
?>
<div id="page-left-block">
    <ul>
        <li>
            <?php echo anchor(site_url('users'),'All Users'); ?>
        </li>
        <li>
            <?php echo anchor(site_url('orders'),'All Orders'); ?>
        </li>
        <li>
            <?php echo anchor(site_url('users/changepassword'),'Change Password'); ?>
        </li>
        <li>
            <?php echo anchor(site_url('contacts'),'All Contacts'); ?>
        </li>
    </ul>
</div>