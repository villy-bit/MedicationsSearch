<?
require_once CONFIG.'/routes.php';

//D:\OSPanel\home\blog.loc\core\router.php
$uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

if(in_array($uri, array_keys($routes)) && file_exists(CONTROLLERS."/{$routes[$uri]}"))
{
    require_once CONTROLLERS."/{$routes[$uri]}";
}
else
{
    abort();
}

?>