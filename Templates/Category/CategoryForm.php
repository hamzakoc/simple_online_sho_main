<!--- CONTENT ---->
<div class="container">
    <div class="row">

        <!--- LEFT SIDE --->
        <div class="col-md-2">
            <b>Categories</b>

            <ul class="list-group">
                <li class="list-group-item">
                    <a href="#">Category 1</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Category 2</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Category 3</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Category 4</a>
                </li>
                <li class="list-group-item">
                    <a href="#">Category 5</a>
                </li>
            </ul>
        </div>

        <!--- RIGHT SIDE --->
        <div class="col-md-10">
            <br><br><br>

            <?php
            $category = $args['category'];
            $id = $category ? $category->getId() : '';
            $title = $category ? $category->getTitle() : '';
            $description = $category ? $category->getDescription() : '';
            ?>
            <form action="<?php 0 < (int) $id ? '/edit/category' : '/add/category'; ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group row">
                    <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id="inputTitle" value="<?php echo $title;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="description" class="form-control" id="inputDescription"><?php echo $description;?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary ml-10">Save</button>
                        <a href="/get/categories" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
