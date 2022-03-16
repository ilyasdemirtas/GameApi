<?php

spl_autoload_register(function ($className) {
    $namespace = str_replace("\\","/",__NAMESPACE__);
    $className = str_replace("\\","/",$className);
    $className = str_replace('GameApi/', '', $className);
    $class = (empty($namespace)?"":$namespace."/")."{$className}.php";
    include_once($class);
});
