<!--- TOP NAVIGATION ---->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">My Classified</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo in_array($_SESSION['url'], ['/', '/index']) ? 'active' : '' ?>">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item <?php echo in_array($_SESSION['url'], ['/get/items']) ? 'active' : '' ?>">
                <a class="nav-link" href="/get/items">Items</a>
            </li>
            <li class="nav-item <?php echo in_array($_SESSION['url'], ['/get/categories']) ? 'active' : '' ?>">
                <a class="nav-link" href="/get/categories">Categories</a>
            </li>
            <li class="nav-item <?php echo in_array($_SESSION['url'], ['/search']) ? 'active' : '' ?>">
                <a class="nav-link" href="/search" tabindex="-1">Search</a>
            </li>
        </ul>

        <?php
        if (isset($_SESSION['isLoggedIn']) && true === $_SESSION['isLoggedIn']) {
            ?>
            <span>Hello <?php echo $_SESSION['login'];?></span>
            <a href="/logout" class="my-2" style="color: white">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
                    <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
                </svg>
                Logout
            </a>
            <?php
        } else {
            ?>
            <a href="/login" class="my-2" style="color: white">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
                    <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
                </svg>
                Login
            </a>
        <?php
        }
        ?>
    </div>
</nav>
