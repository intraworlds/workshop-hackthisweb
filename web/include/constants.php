<?php

//security error
define('ENABLE_XSS', false);
define('ENABLE_SQL_INJECTION', false);
define('ENABLE_PATH_TRAVERSAL', false);
define('ENABLE_REQUEST', false);

//security features
define('ENABLE_CSRF', true);
define('ENABLE_SECURE_SESSION', true);
define('ENABLE_SECURE_LOGOUT', true);
define('ENABLE_HIDE_ERROR', true);
