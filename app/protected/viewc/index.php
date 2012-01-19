 <?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//top.php"; ?>
 <?php foreach($data['links'] as $k1=>$v1): ?>
 
 <div class="link-wrapper">
    <h1><a href="<?php echo $v1->url; ?>"><?php echo $v1->description; ?></a></h1>
    <div class="link-bar">
        <p class="link-bar-comments">
            <a href="<?php echo $data['baseurl']; ?>index.php/comments/<?php echo $v1->id; ?>">
                [<?php echo $v1->getNrOfComments(); ?>] Kommentarer
            </a>  - Postat av <a href=""><?php echo $v1->getAuthor();?></a> <?php echo $v1->formatDate(); ?>
            
        </p>
        <p class="link-rating">
            <a href="?vote=down&id=<?php echo $v1->id; ?>">-</a> [<?php echo $v1->getRating(); ?>] <a href="?vote=up&id=<?php echo $v1->id; ?>">+</a>
        </p>
            
        <?php if($data['isLoggedIn']): ?>
            <?php if($v1->isOwner($data['user-id'])): ?>
                <p>- <span><a href="<?php echo $data['baseurl']; ?>index.php/?delete=<?php echo $v1->id; ?>">Ta bort</a></span></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?> 
    
<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc/bottom.php"; ?>