<!--- CONTENT ---->
<div class="container">
    <?php
    $categories = $args["categories"];

    $html = "<table class='table'>";
    $html .= "<tr>";
    $html .= "<td>Id</td>";
    $html .= "<td>Title</td>";
    $html .= "<td>Description</td>";
    $html .= "<td>";

    if (isset($_SESSION['isLoggedIn']) && true === $_SESSION['isLoggedIn']) {
        $html .= "<a href='/add/category' class='btn btn-primary'>Add category</a>";
    }
    $html .= "</td>";
    $html .= "</tr>";
    foreach ($categories as $category) {
        $html .= "<tr>";
        $html .= "<td>" . $category->getId() . "</td>";
        $html .= "<td><a href='/get/items/by/category?category_id=" . $category->getId() . "'>" . $category->getTitle() . "</a></td>";
        $html .= "<td>" . $category->getDescription() . "</td>";
        $html .= "<td>";

        if (isset($_SESSION['isLoggedIn']) && true === $_SESSION['isLoggedIn']) {

            $html .= "<a href='/edit/category?id=" . $category->getId() . "' class='btn btn-success'>Edit</a>";
            $html .= "<a href='/delete/category?id=" . $category->getId() . "' class='btn btn-danger'>Delete</a>";
        }

        $html .= "</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    echo $html;
    ?>
</div>

