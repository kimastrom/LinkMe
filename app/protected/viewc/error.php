<div class="error-wrapper">
    <?php if(!empty($data['error'])): ?>
        <?php foreach($data['error'] as $k1=>$v1): ?>
            <div class="error-msg">
                <p class="error-title"><?php echo $k1; ?></p>
                <?php if(is_array($v1)): ?>
                      <?php foreach($v1 as $f1=>$e1): ?>                   
                          <p><?php echo $e1; ?></p>
                      <?php endforeach; ?>
                <?php else: ?>
                    <p><?php echo $v1; ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
