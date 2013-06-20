<div class="row" style="background:#eeeeee;padding:20px;">
        <form action="changeCatName" method="POST">
            New name: <br /> <hr style=""/>
            <input type="text" name="category_name" value="<?php echo $category->name ?>"/>
            <input type="hidden" name="category_id" value="<?php echo $category->id ?>" />
            <input type="submit" name="category_change" value="Save" />
        </form>

        <div style="color:#E84848">
            <?php
            if(!empty($_SESSION['errors'])){
                foreach ($_SESSION['errors'] as $error){
                    echo $error ."<br />";
                }
                unset($_SESSION['errors']);
            }
            ?>
        </div>
</div>