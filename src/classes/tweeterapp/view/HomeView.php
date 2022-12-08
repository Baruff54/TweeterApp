<?php

namespace Tweeter\tweeterapp\view;

use Tweeter\mf\view\Renderer;
use Tweeter\tweeterapp\view\TweeterView;

class HomeView extends TweeterView implements Renderer
{

    public function render(): string
    {
        $content = "";
        foreach ($this->data as $tweet) {
            $user = $tweet->author()->first();
            $url = $this->router->urlFor('view', ['id' => $tweet->id]);
            $url2 = $this->router->urlFor('user', ['idUser' => $tweet->author]);
            $content .= "<div class='tweet'>
                            <a href='$url'><div class='tweet-text'>$tweet->text</div></a>
                            <div class='tweet-footer'>
                                <span class='tweet-timestamp'>$tweet->created_at</span>
                                <span class='tweet-author'>
                                    <a href='$url2'>$user->fullname</a>
                                </span>
                            </div>
                        </div>";
        }

        return $content;
    }
}
