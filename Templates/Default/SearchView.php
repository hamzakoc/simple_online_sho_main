<!--- CONTENT ---->
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <form class="form-inline my-2 my-lg-0" action="/search" method="get">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

        <div class="col-md-12">
            <?php
            $results = $args["results"];

            foreach ($results as $result) {

                if ($result instanceof \Entities\Item) {
                    $html = '<div class="card mt-2">';
                    $html .= '<div class="row no-gutters">';
                    $html .= '<div class="col-md-4">';
                    $html .= '<img src="/uploads/' . $result->getImage() . '" onerror="this.src=\'/images/item.jpg\'" class="card-img" alt="...">';
                    $html .= '</div>';
                    $html .= '<div class="col-md-8">';
                    $html .= '<div class="card-body">';
                    $html .= '<h5 class="card-title">' . $result->getTitle() . '</h5>';
                    $html .= '<p class="card-text">' . $result->getDescription() . '</p>';
                    $html .= '<p class="card-text">' . $result->getPrice() . '.00 $</p></p>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    echo $html;
                } else if ($result instanceof \Entities\Category) {
                    $html = '<div class="card mt-2">';
                    $html .= '<div class="card-body">';
                    $html .= '<h5 class="card-title">'. $result->getTitle() .'</h5>';
                    $html .= '<p class="card-text">'. $result->getDescription().'</p>';
                    $html .= '</div>';
                    $html .= '</div>';
                    echo $html;
                }
            }
            ?>
        </div>
    </div>
</div>