<?php
$this->load->helper('common_helper');
?>
<div id="page-header-block">
    <div id="logo"> Logo Comes here</div>
    <div id="header-right">
        <?php if(isLoggedIn()): ?>
            <?php echo "Logged in as ". $first_name." ".$last_name; ?> |
            <?php echo anchor(site_url('customer/logout'),'Logout') ?>
        <?php else: ?>
            <?php echo anchor(site_url('login/signup'),'Sign Up') ?> |
            <?php echo anchor(site_url('login'),'Sign In') ?>
        <?php endif; ?>
    </div>
</div>
<div id="page-main-contents"> <!-- closed in footer -->

