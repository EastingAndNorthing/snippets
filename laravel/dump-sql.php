<?php

$addSlashes = str_replace('?', "'?'", $actual->toSql());
$sql = vsprintf(str_replace('?', '%s', $addSlashes), $actual->getBindings());
dd($sql);
