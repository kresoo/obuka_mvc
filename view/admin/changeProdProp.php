<div class="row" style="background:#eeeeee;padding:20px;">
            <form action="changeProdProp" method="POST">
                New product properties: <br /> <hr />
                Name:<br />
                <input type="text" name="name" value="<?php echo $product->name ?>" /><br />
                Description:<br />
                <input type="text" name="description" value="<?php echo $product->description ?>"/><br />
                Price:<br />
                <input type="text" name="price" value="<?php echo $product->price ?>"/><br />
                Barcode:<br />
                <input type="text" name="barcode" value="<?php echo $product->barcode ?>"/><br />
                Quantity:<br />
                <input type="text" name="qty" value="<?php echo $product->qty ?>"/><br />
                <input type="hidden" name="id" value="<?php echo $product->id ?>" />
                Category:<br />
                <select multiple name="category_id[]">
                    <?php
                    $category = new Model_Category();
                    $allCategories = $category->findAll();
                    $productCategories = explode(",", $product->category_id);
                    ?>
                    <?php foreach ($allCategories as $category): ?>
                        <?php $selected = false; ?>
                        <?php foreach ($productCategories as $key => $value): ?>
                            <?php
                            if ($category->id == $value) {
                                $selected = true;
                            }
                            ?>
                        <?php endforeach; ?>
                        <?php if ($selected): ?> 
                            <option selected="selected" value="<?php echo $category->id ?>"> <?php echo $category->name ?> </option>
                        <?php else: ?>
                            <option value="<?php echo $category->id ?>"> <?php echo $category->name ?> </option>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </select> <br /><br />
                <input type="submit" name="product_change" value="Save" />
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