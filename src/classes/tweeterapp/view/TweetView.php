<?php

namespace Tweeter\tweeterapp\view;

use Tweeter\mf\view\Renderer;
use Tweeter\tweeterapp\view\TweeterView;

class TweetView extends TweeterView implements Renderer
{

    public function render(): string
    {

        $tweet = $this->data;
        $url = $this->router->urlFor('view', ['id' => $tweet->id]);
        $url2 = $this->router->urlFor('user', ['idUser' => $tweet->author]);
        $user = $tweet->author()->first();
        $content = "<div class='tweet'>
                        <a href='$url'><div class='tweet-text'>$tweet->text</div></a>
                        <div class='tweet-footer'>
                            <span class='tweet-timestamp'>$tweet->created_at</span>
                            <span class='tweet-author'>
                                <a href='$url2'>$user->fullname</a>
                            </span>
                        </div>
                        <div class='tweet-footer'>
                            <hr>
                            <span class='tweet-score tweet-control'>$tweet->score</span>
                        </div>
                    </div>";

        return $content;
    }
}
