<div class="row" style="background:#eeeeee;padding:20px;">
        <table class="table table-striped">
            <?php foreach ($allCategories as $category) {
                ?>
                <tr>
                    <td> <?php echo $category->name; ?> </td> 
                    <td> <a class="btn btn-info"href="changeCatName/id/<?php echo $category->id ?>"  > <b> Change name </b> </a> </td>
                </tr>
            <?php } ?> 
        </table>
        
</div>