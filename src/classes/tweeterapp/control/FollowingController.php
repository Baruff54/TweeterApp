<?php

namespace Tweeter\tweeterapp\control;

use Tweeter\tweeterapp\model\User;
use Tweeter\tweeterapp\model\Tweet;
use Tweeter\mf\control\AbstractController;
use Tweeter\mf\auth\AbstractAuthentification;
use Tweeter\tweeterapp\model\Follow;
use Tweeter\tweeterapp\view\FollowingView;

class FollowingController extends AbstractController
{
    public function execute(): void
    {
        $idUser = AbstractAuthentification::connectedUser();

        $user = User::where('id', '=', $idUser)->first();

        $follows = $user->follows()->get();
        $allFollowsId = [];
        foreach ($follows as $follow){
            $allFollowsId[] = $follow['id'];
        }
        $tweets = Tweet::select()->whereIn('author',$allFollowsId)->orderByDesc('updated_at')->get();
        
        $FollowingView = new FollowingView($tweets);
        $FollowingView->makePage();
    }
}
