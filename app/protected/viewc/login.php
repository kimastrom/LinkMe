    <?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//top.php"; ?>
    <?php if(!empty($data['error'])): ?>
        <span><?php if(!is_array($data['error'])) { echo $data['error'];}?></span>
        <?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//error.php"; ?>
    <?php endif; ?>
    
    <div id="login-wrapper">
        <h2>Logga in</h2>
        <form action="<?php echo $data['baseurl']; ?>index.php/login" method="post" name="login-form">
            <label for="username">Användarnamn</label><br />
            <input class="login-input" type="text" value="" name="username" /><br />
            <label for="password">Lösenord</label><br /> 
            <input class="login-input" type="password" value="" name="password" /><br />
            <input class="action-button" type="submit" value="Logga in" name="login-submit" />
            <a href="<?php echo $data['baseurl']; ?>index.php/register" style="float:right">
                <button class="action-button">Registrera dig</button>
            </a>
        </form>

    </div>
    
<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc/bottom.php"; ?>