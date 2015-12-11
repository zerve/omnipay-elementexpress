<?php
// include the composer autoloader
$autoloader = require __DIR__ . '/../vendor/autoload.php';

// Back-port https://github.com/sebastianbergmann/php-token-stream/commit/3f60c2ac940e9d0dc46cc8be369ec95d72367e06
class PHP_Token_ELLIPSIS extends PHP_Token {}
