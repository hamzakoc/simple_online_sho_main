<!--- CONTENT ---->
<div class="container">

    <div class="row">

        <!--- LEFT SIDE --->
        <div class="col-md-2">
            <b>Categories</b>

            <ul class="list-group">
                <?php
                $categories = $args['categories'];
                foreach ($categories as $category) {
                    $html = '<li class="list-group-item">';
                    $html .= '<a href="/get/items/by/category?category_id=' . $category->getId() . '">' . $category->getTitle() . '</a>';
                    $html .= '</li>';
                    echo $html;
                }
                ?>
            </ul>
        </div>

        <!--- RIGHT SIDE --->
        <div class="col-md-10">
            <b>Items</b>
            <?php

            if (isset($_SESSION['isLoggedIn']) && true === $_SESSION['isLoggedIn']) {
                echo "<a href='/add/item' class='btn btn-primary'>Add item</a>";
            }

            $items = $args["items"];

            foreach ($items as $item) {

                $html = '<div class="card mb-3">';
                $html .= '<div class="row no-gutters">';
                $html .= '<div class="col-md-4">';
                $html .= '<img src="/uploads/' . $item->getImage() . '" onerror="this.src=\'/images/item.jpg\'" class="card-img" alt="...">';
                $html .= '</div>';
                $html .= '<div class="col-md-8">';
                $html .= '<div class="card-body">';
                $html .= '<h5 class="card-title">' . $item->getTitle() . '</h5>';
                $html .= '<p class="card-text">' . $item->getDescription() . '</p>';
                $html .= '<p class="card-text">' . $item->getPrice() . '.00 $</p></p>';

                if (isset($_SESSION['isLoggedIn']) && true === $_SESSION['isLoggedIn']) {
                    $html .= "<p class='card-text'><a href='/edit/item?id=" . $item->getId() . "' class='btn btn-success'>Edit</a>"
                        . "<a href='/delete/item?id=" . $item->getId() . "' class='btn btn-danger'>Delete</a>" .
                        "</p>";
                }
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                echo $html;
            }
            ?>


        </div>
    </div>
</div>
