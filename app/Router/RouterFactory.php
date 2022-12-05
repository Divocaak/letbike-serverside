<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;
use Apitte\Presenter\ApiRoute;
use Nette\Application\IRouter;
use Nette\Application\Routers\Route;

final class RouterFactory
{
	use Nette\StaticClass;
	
	public static function createRouter(): IRouter
    {
        $router = new RouteList;
        $router[] = new ApiRoute('api');
        $router[] = new Route('<presenter>/<action>', 'Homepage:default');
        return $router;
    }
}
