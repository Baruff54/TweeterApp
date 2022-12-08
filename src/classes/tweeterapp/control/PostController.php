<?php

namespace Tweeter\tweeterapp\control;

use Tweeter\tweeterapp\view\PostView;
use Tweeter\mf\control\AbstractController;
use Tweeter\mf\router\Router;
use Tweeter\tweeterapp\auth\TweeterAuthentification;
use Tweeter\tweeterapp\model\Tweet;

class PostController extends AbstractController
{

    public function execute(): void
    {
        switch ($this->request->method) {
            case 'GET':
                $PostView = new PostView();
                $PostView->makePage();
                break;
            case 'POST':
                $idUser = TweeterAuthentification::connectedUser();
                if (isset($this->request->post['text'])) {
                    $text_tweet = filter_var($this->request->post['text'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $t = new Tweet();
                    $t->text = $text_tweet;
                    $t->author = $idUser;
                    $t->save();
                }
                Router::executeRoute('home');
                break;
        }
    }
}
