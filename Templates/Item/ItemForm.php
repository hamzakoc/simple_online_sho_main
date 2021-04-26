<!--- CONTENT ---->
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <br><br><br>

            <?php
            $item = $args['item'];
            $id = $item ? $item->getId() : '';
            $title = $item ? $item->getTitle() : '';
            $description = $item ? $item->getDescription() : '';
            $price = $item ? $item->getPrice() : '';
            $categoryId = $item ? $item->getCategoryId() : '';
            $image = $item ? $item->getImage() : '';

            $categories = $args['categories'];
            ?>
            <form action="<?php 0 < (int) $id ? '/edit/item' : '/add/item'; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group row">
                    <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $title;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="inputDescription" name="description"><?php echo $description;?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputDescription" class="col-sm-2 col-form-label">Categories</label>
                    <div class="col-sm-10">
                        <select name="categoryId" class="custom-select mr-sm-2" id="inputDescription">
                            <?php
                            $options = '';
                            foreach ($categories as $category) {
                                $options .= sprintf(' <option value="%d" %s>%s</option>',
                                    $category->getId(),
                                    (int)$category->getId() === (int)$categoryId ? 'selected' : 'false',
                                    $category->getTitle());
                            }

                            echo $options;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input name="price" type="text" placeholder="price" class="form-control" id="inputPrice" value="<?php echo $price;?>">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="inputPicture" class="col-sm-2 col-form-label">Picture</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="inputPicture" name="image">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                        <a href="/get/items" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
