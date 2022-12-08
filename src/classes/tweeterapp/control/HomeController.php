<?php

namespace Tweeter\tweeterapp\control;

use Tweeter\mf\control\AbstractController;
use Tweeter\tweeterapp\model\Tweet;
use Tweeter\tweeterapp\view\HomeView;

class HomeController extends AbstractController
{

    public function execute(): void
    {
        $request = Tweet::select();
        $tweets = $request->get();

        $HomeView = new HomeView($tweets);
        $HomeView->makePage();
    }
}
