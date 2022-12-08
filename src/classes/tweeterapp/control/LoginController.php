<?php

namespace Tweeter\tweeterapp\control;

use Tweeter\mf\router\Router;
use Tweeter\tweeterapp\view\LoginView;
use Tweeter\mf\control\AbstractController;
use Tweeter\tweeterapp\auth\TweeterAuthentification;

class LoginController extends AbstractController
{

    public function execute(): void
    {
        switch ($this->request->method) {
            case 'GET':
                $LoginView = new LoginView();
                $LoginView->makePage();
                break;
            case 'POST':
                if (isset($this->request->post['username']) && isset($this->request->post['password'])) {
                    $username = filter_var($this->request->post['username'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $password = filter_var($this->request->post['password'], FILTER_SANITIZE_SPECIAL_CHARS);

                    TweeterAuthentification::login($username, $password);
                    Router::executeRoute('following');
                } else {
                    Router::executeRoute('login');
                }
                break;
        }
    }
}
