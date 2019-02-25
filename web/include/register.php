<?php
    $passwordMatch = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $_REQUEST['password']);
    if ($passwordMatch===0): ?>
        <div class="alert alert-danger" role="alert">
            Password must be longer than 8 characters and must contain digits, alphabetic and some capitals.
        </div>
    <?php
    endif;

    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $_REQUEST['password'])===false): ?>
        <div class="alert alert-danger" role="alert">
            Some error occurred when password was verified.
        </div>
    <?php
    endif;

    if ($passwordMatch===1):
        $result = $model->createUser($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['password']);
        if ($result===true):?>
        <div class="alert alert-success" role="alert">
            Registration was successful.
        </div>
    <?php
        else:?>
            <div class="alert alert-danger" role="alert">
                Registration failed.
            </div>
    <?php
        endif;
    endif;


