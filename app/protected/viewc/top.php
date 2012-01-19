<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8">  
        <title><?php echo $data['title']; ?></title>
        <link rel="stylesheet" href="<?php echo $data['baseurl']; ?>global/css/style.css">
    </head>
    <body>
        <div id="header">
            <div id="header-loggo">
                <a href="<?php echo $data['baseurl']; ?>">
                    <img src="<?php echo $data['baseurl']; ?>global/img/loggo.png" alt="linkMe" />
                </a>
            </div>
            <div id="header-menu">
                <ul>
                    <li><a href="<?php echo $data['linkUrl'].'new'; ?>">Nya</a></li>
                    <li><a href="<?php echo $data['linkUrl'].'hot'; ?>">Heta</a></li>
                    <li><a href="<?php echo $data['linkUrl'].'commented'; ?>">Kommenterade</a></li>
                    <li><a href="<?php echo $data['baseurl']; ?>index.php/addlink">Lägg till länk</a></li>
                    <?php if($data['isLoggedIn']): ?>
                    <li><a href="<?php echo $data['baseurl']; ?>index.php/logout">Logga ut</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo $data['baseurl']; ?>index.php/login">Logga in</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div id="category-menu">
            <ul>
            <?php foreach($data['categories'] as $k1=>$v1): ?>
                <li>
                    <a href="<?php echo $data['baseurl']; ?>index.php/c/<?php echo $v1->category; ?>"><?php echo $v1->category; ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
        <div id="login-wrapper">
            <?php /*if($data['isLoggedIn']): ?>
                <a href="<?php echo $data['baseurl']; ?>index.php/logout">Logga ut</a>
            <?php else: ?>
                <?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//login.php"; ?>
            <?php endif; */?>
        </div> 
        <div id="content-wrapper">