<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//top.php"; ?>
<form action="<?php echo $data['baseurl']; ?>index.php/addlink" method="post">
    <div id="add-link-header">
        <h3>Lägg till en länk</h3>
    </div>
    <?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//error.php"; ?>  
    <div>
        <label for="url">Url:</label><br />
        <input name="url" type="text" style="width:230px;" value="http://"/>
        <br/><label for="description">Description:</label><br />
        <input name="description" type="text" style="width:230px;" value=""/>
        <br/>
        <select name="categories">
        <?php foreach($data['categories'] as $k1=>$v1): ?>
            <option value="<?php echo $v1->id; ?>"><?php echo $v1->category; ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div>
        <br /><input class="action-button" type="submit"" value="Add Link" />
    </div>
</form>

<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc/bottom.php"; ?>