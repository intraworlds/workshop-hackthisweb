<h1>IW Coin - registration</h1>
<?php if ($registerError): ?>
    <div class="alert alert-danger" role="alert">
        Your login or password are not valid.
    </div>
<?php
endif;
    unset($registerError);
?>
<form method="POST" action="index.php">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <button type="submit" name="submit" value="register" class="btn btn-primary">Register</button>
</form>
