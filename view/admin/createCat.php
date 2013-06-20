
        <form action="createCat" method="POST">
            Create new category:  <br /> <hr />
            Name: <br/>
            <input type="text" name="name" />
            <input type="submit" name="create_category" value="Save" />
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
 