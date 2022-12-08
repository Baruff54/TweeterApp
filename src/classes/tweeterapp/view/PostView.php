<?php

namespace Tweeter\tweeterapp\view;

use Tweeter\mf\view\Renderer;
use Tweeter\tweeterapp\view\TweeterView;

class PostView extends TweeterView implements Renderer
{
    public function render(): string
    {

        $url = $this->router->urlFor('saveTweet');

        $content = "<form action='$url' method='POST'>
                        <textarea id='tweet-form' name='text' placeholder='Enter your tweet...'>
                        </textarea>
                        <div>
                            <input id='send_button' type='submit' name='send' value='Send'>
                        </div>
                    </form>";
        return $content;
    }
}
