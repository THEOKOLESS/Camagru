<?php

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if ($actual_link == 'http://localhost:8888/model/register.php')
    {
        header('Location: http://localhost:8888/index.php');
        require('model/register.php');
    }
else{
    require('model/front.php');
}