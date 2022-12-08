<?php

namespace Tweeter\tweeterapp\view;

use Tweeter\mf\view\Renderer;
use Tweeter\tweeterapp\model\User;
use Tweeter\tweeterapp\view\TweeterView;

class UserView extends TweeterView implements Renderer
{

    public function render(): string
    {
        $id = $this->request->get["idUser"];
        $u = User::where('id', '=', $id)->first();

        $content = "<h2>Tweets from $u->fullname</h2>
                    <h3>$u->followers followers</h3>";
        foreach ($this->data as $tweet) {
            $url = $this->router->urlFor('view', ['id' => $tweet->id]);
            $url2 = $this->router->urlFor('user', ['idUser' => $tweet->author]);
            $content .= "<div class='tweet'>
                            <a href='$url'><div class='tweet-text'>$tweet->text</div></a>
                            <div class='tweet-footer'>
                                <span class='tweet-timestamp'>$tweet->created_at</span>
                                <span class='tweet-author'>
                                    <a href='$url2'>{$tweet->author()->first()->fullname}</a>
                                </span>
                            </div>
                        </div>";
        }

        return $content;
    }
}
