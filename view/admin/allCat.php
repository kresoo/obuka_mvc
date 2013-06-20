
        <table class="display">
            <?php foreach ($allCategories as $category) {
                ?>
                <tr>
                    <td> <?php echo $category->name; ?> </td> 
                    <td> <a href="changeCatName/id/<?php echo $category->id ?>"  > <b> Change name </b> </a> </td>
                </tr>
            <?php } ?> 
        </table>
