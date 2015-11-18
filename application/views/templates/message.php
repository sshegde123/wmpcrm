<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/11/15
 * Time: 2:06 PM
 */
$successMsg = $this->session->flashdata('successMsg');
$errorMsg = $this->session->flashdata('errorMsg');
?>

<?php if($successMsg): ?>
    <div class="success-msg"><?php echo $successMsg; ?></div>
<?php endif; ?>

<?php if($errorMsg): ?>
    <div class="error"><?php echo $errorMsg; ?></div>
<?php endif; ?>