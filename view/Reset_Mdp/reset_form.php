<?php $title = 'Reset MDP - Camagru'; ?>
<?php ob_start(); ?>
    <?php include("view/message.php");?>
        <br />
        <form method="post" action="" name="update">
        <input type="hidden" name="action" value="update" />
        <br /><br />
        <label><strong>Enter New Password:</strong></label><br />
        <input type="password" name="pass1" maxlength="45" />
        <br /><br />
        <label><strong>Re-Enter New Password:</strong></label><br />
        <input type="password" name="pass2" maxlength="45" />
        <br /><br />
        <input type="hidden" name="email" value="<?php echo $email;?>"/>
        <input type="submit" value="submit" />
        </form>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>