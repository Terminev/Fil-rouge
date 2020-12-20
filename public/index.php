<?php

define("ROOT", dirname(__DIR__));

require ROOT.'/Autoloader.php';
Autoloader::register();
session_start();

require ROOT.'/root.php';

