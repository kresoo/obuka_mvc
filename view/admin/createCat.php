
        <form action="createCat" method="POST">
            <h3> Create new category: </h3> <hr />
            <h4> Name: </h4> 
            <input type="text" name="name" />
            <input class="btn btn-success" type="submit" name="create_category" value="Save" />
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
 