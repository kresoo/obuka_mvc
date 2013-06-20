
        <form action="createProd" method="POST">
            Create new product: <br /> <hr />
            Name:<br />
            <input type="text" name="name"  /><br />
            Description:<br />
            <input type="text" name="description" /><br />
            Price:<br />
            <input type="text" name="price" /><br />
            Barcode:<br />
            <input type="text" name="barcode" v/><br />
            Quantity:<br />
            <input type="text" name="qty" /><br />
            Category: <br />
            <select multiple name="category_id[]">
                <?php
                $category = new Model_Category();
                $allCategories = $category->findAll();
                foreach ($allCategories as $category):
                    ?>
                    <option value="<?php echo $category->id ?>"> <?php echo $category->name ?> </option>
                <?php endforeach; ?>

            </select> <br /><br />
            <input type="submit" name="create_product" value="Save" />
        </form>
                <div>
            <?php
            if(!empty($_SESSION['errors'])){
                foreach ($_SESSION['errors'] as $error){
                    echo $error ."<br />";
                }
                unset($_SESSION['errors']);
            }
            ?>
        </div>
