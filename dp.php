<?php

require 'libs/rb-mysql.php';
R::setup( 'mysql:host=localhost;dbname=authorithation',
    'root', '' );
session_start();

?>