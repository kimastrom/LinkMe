<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//top.php"; ?>
<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//error.php"; ?>   
    <div id="login-wrapper">
        <h2>Registrera dig</h2>
        <form action="<?php echo $data['baseurl']; ?>index.php/register" method="post" name="login-form">
            <label for="username">Användarnamn</label><br />
            <input class="login-input" type="text" value="" name="username" /><br />
            <label for="password">Lösenord</label><br /> 
            <input class="login-input" type="password" value="" name="password" /><br />
            <label for="password">Upprepa lösenord</label><br /> 
            <input class="login-input" name="repeatpassword" type="password" /><br />
            <input class="action-button" type="submit" value="Registrera dig" name="register-submit" />
            <a href="<?php echo $data['baseurl']; ?>index.php/login" style="float:right">
                <button class="action-button">Logga in</button>
            </a> 
        </form>
    </div>
    
<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc/bottom.php"; ?>

