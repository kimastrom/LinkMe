<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//top.php"; ?>
<div id="not-authorized">
    <h1>NOPE.</h1>
    <p>För att lägga till, kommentera och ranka länkar måste du <a href="<?php echo $data['baseurl'].'index.php/login'; ?>">logga in</a>, är du inte registrerad gör du det <a href="<?php echo $data['baseurl'].'index.php/register'; ?>">här</a></p>
</div>

<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc/bottom.php"; ?>