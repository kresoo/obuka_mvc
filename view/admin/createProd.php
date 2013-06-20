
        <form action="createProd" method="POST">
           <h3>  Create new product: </h3> <hr />
            <h4> Name:<h4> 
            <input type="text" name="name"  /><br />
           <h4>  Description:<h4> 
            <input type="text" name="description" /><br />
           <h4>  Price:<h4> 
            <input type="text" name="price" /><br />
            <h4> Barcode:<h4> 
            <input type="text" name="barcode" v/><br />
            <h4> Quantity:<h4> 
            <input type="text" name="qty" /><br />
            <h4> Category: <h4> 
            <select multiple name="category_id[]">
                <?php
                $category = new Model_Category();
                $allCategories = $category->findAll();
                foreach ($allCategories as $category):
                    ?>
                    <option value="<?php echo $category->id ?>"> <?php echo $category->name ?> </option>
                <?php endforeach; ?>

            </select> <br /><br />
            <input class="btn btn-success" type="submit" name="create_product" value="Save" />
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
