<?php

require '../../vendor/autoload.php';

use App\Model\RegisterModel;
use Core\Database;

    require '../view/user/register.php';
    if (isset($_POST['submit']))
    {
        RegisterModel::createUserModel();
    }

