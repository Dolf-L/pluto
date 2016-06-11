<?php

use app\library\DI;

DI::mapClass('model', 'app\database\PDOModel');
DI::mapClass('filter', 'app\validation\Filtration');