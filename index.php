<?php

define('ROOTPATH', __DIR__);

require __DIR__.'/app/app.php';

app::init();
app::$kernel->launch();
