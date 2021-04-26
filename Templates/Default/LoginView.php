<!--- CONTENT ---->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($args['message']) {
                echo '<h1 class="danger">'.$args['message'].'</h1>';
            }
            ?>
            <form action="/login" method="post">
                <div class="form-group">
                    <label for="loginInput">Login</label>
                    <input name="login" type="text" class="form-control" id="loginInput">
                </div>
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input name="password" type="password" class="form-control" id="passwordInput">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>