<?php

namespace Tweeter\tweeterapp\control;

use Tweeter\tweeterapp\model\Tweet;
use Tweeter\mf\control\AbstractController;
use Tweeter\tweeterapp\view\TweetView;

class TweetController extends AbstractController
{

    public function execute(): void
    {
        $id = $this->request->get["id"];
        $requete = Tweet::select()->where('id', '=', $id);
        $tweet = $requete->first();

        $TweetView = new TweetView($tweet);
        $TweetView->makePage();
    }
}
