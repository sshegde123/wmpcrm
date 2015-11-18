<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/11/15
 * Time: 1:47 PM
 */
$i = 1;
?>
<table border="1px">
    <thead>
        <th>Sl No</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Mobile</th>
        <th>Status</th>
        <th></th>
    </thead>
    <?php foreach($all as $user): ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $user['first_name'].' '.$user['first_name']; ?></td>
            <td><?php echo $user['phone']; ?></td>
            <td><?php echo $user['mobile']; ?></td>
            <td><?php echo $user['status']; ?></td>
            <td>
                <a href="#">Edit</a> | <a href="#">Delete</a>
            </td>
        </tr>
    <?php $i++; endforeach; ?>
</table>
