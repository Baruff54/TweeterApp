<?php

namespace Tweeter\tweeterapp\control;

use Tweeter\mf\router\Router;
use Tweeter\tweeterapp\view\SignupView;
use Tweeter\mf\control\AbstractController;
use Tweeter\tweeterapp\auth\TweeterAuthentification;

class SignupController extends AbstractController
{
    public function execute(): void
    {
        switch ($this->request->method) {
            case 'GET':
                $SignupView = new SignupView();
                $SignupView->makePage();
                break;
            case 'POST':
                if (isset($this->request->post['username']) && isset($this->request->post['password']) && isset($this->request->post['fullname'])) {
                    $username = filter_var($this->request->post['username'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $fullname = filter_var($this->request->post['fullname'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $password = filter_var($this->request->post['password'], FILTER_SANITIZE_SPECIAL_CHARS);
                    TweeterAuthentification::register($username, $password, $fullname);
                    Router::executeRoute('home');
                } else {
                    Router::executeRoute('signup');
                }
                break;
        }
    }
}
