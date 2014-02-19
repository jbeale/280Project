<?php

namespace Users\Util;

use Users\Model\UserTable;

interface AbstractLoginHandler
{
    function __construct(UserTable $userTable);
    function login( $username,  $password);
    function logout();
}