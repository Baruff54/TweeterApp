<?php

namespace Tweeter\tweeterapp\control;

use Tweeter\tweeterapp\model\User;
use Tweeter\mf\control\AbstractController;
use Tweeter\tweeterapp\view\UserView;

class UserController extends AbstractController
{

    public function execute(): void
    {

        $id = $this->request->get["idUser"];
        $u = User::where('id', '=', $id)->first();
        $tweets = $u->tweets()->get();
        

        $UserView = new UserView($tweets);
        $UserView->makePage();
    }
}
