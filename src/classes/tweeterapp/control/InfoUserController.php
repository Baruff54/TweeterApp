<?php

namespace Tweeter\tweeterapp\control;

use Tweeter\tweeterapp\model\User;
use Tweeter\mf\control\AbstractController;
use Tweeter\mf\auth\AbstractAuthentification;
use Tweeter\tweeterapp\view\InfoUserView;

class InfoUserController extends AbstractController
{
    public function execute(): void
    {
        $idUser = AbstractAuthentification::connectedUser();

        $user = User::where('id', '=', $idUser)->first();

        $follows = $user->followedBy()->get();
        
        $FollowingView = new InfoUserView($follows);
        $FollowingView->makePage();
    }
}
