<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//top.php"; ?>

<div id="single-link-header">
    <h1><a href="<?php echo $data['link']->url; ?>"><?php echo $data['link']->description; ?></a></h1>
    <div class="link-bar">
        <p class="link-bar-comments">
            Postat av <a href=""><?php echo $data['link']->author; ?></a> - <?php echo $data['link']->date; ?>
        </p>
        <p class="link-rating">
            <a href="?vote=down&id=<?php echo $data['link']->id; ?>">-</a>[<?php echo $data['link']->rating; ?>] <a href="?vote=up&id=<?php echo $data['link']->id; ?>">+</a>
        </p>
    </div>
</div>
<div id="nr-comments">
    <h3><?php echo $data['link']->nrOfComments; ?> Kommentarer</h3>
</div>

<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//error.php"; ?>

<?php if( !empty($data['comments']) ): ?>
    <?php $data['i'] = 1; ?>

    <?php foreach($data['comments'] as $k1=>$v1): ?>
        <div class="comment">
            <div class="comment-user">
                <!-- användare och datum-->
                <h4>#<?php echo $data['i']; ?> <span><?php echo $v1->author; ?></span></h4>
                <p><?php echo $v1->date; ?></p>
                
                <?php if( $data['isLoggedIn'] == true && $v1->isOwner ): ?>
                    <p><a href="?delete=<?php echo $v1->id; ?>">Ta bort</a> - <a href="?edit=<?php echo $v1->id; ?>#form">Redigera</a></p>
                <?php endif; ?>
                
            </div>
            
            <!-- kommentartext-->
            <div class="comment-text">
                <p>
                    <?php echo $v1->comment; ?>
                </p>
            </div>
            <div class="clear"></div>
        </div>
        <?php $data['i'] = $data['i'] + 1; ?>
        
    <?php endforeach; ?>
    
<?php else: ?>
    <p>inga kommentarer</p>
<?php endif; ?>

<?php if( $data['isLoggedIn'] ): ?>

    <div id="add-comment">
        <a name="form"></a>   
        <form action="http://127.0.0.1:8888/doophp/app/index.php/comments/<?php echo $data['link']->id; ?>" method="post">
        <div>
            <h3>Kommentera</h3>
            <textarea name="comment"><?php if( isset($data['comment-text']) ): ?><?php echo $data['comment-text']; ?><?php endif; ?></textarea>
        </div>
        <div>
            <?php if( isset($data['isEdit']) ): ?>
                <input type="hidden" name="id" value="<?php echo $data['edit-id']; ?>" />
                <input class="action-button" type="submit" name="comment-button" value="editera" />
            <?php else: ?>
                <input class="action-button" type="submit" name="comment-button" value="kommentera" />
            <?php endif; ?>
        </div>
    </form>
    </div>

<?php endif; ?>

<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//bottom.php"; ?>