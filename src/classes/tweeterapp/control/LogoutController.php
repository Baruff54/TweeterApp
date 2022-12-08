<?php

namespace Tweeter\tweeterapp\control;

use Tweeter\mf\auth\AbstractAuthentification;
use Tweeter\mf\control\AbstractController;
use Tweeter\mf\router\Router;

class LogoutController extends AbstractController
{
    public function execute(): void
    {
        AbstractAuthentification::logout();

        Router::executeRoute('home');
    }
}
