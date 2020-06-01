<?php

include './autoload.php';

\user\User::logout();
redirect('index');