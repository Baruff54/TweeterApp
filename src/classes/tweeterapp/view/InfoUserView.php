<?php

namespace Tweeter\tweeterapp\view;

use Tweeter\mf\view\Renderer;
use Tweeter\tweeterapp\view\TweeterView;

class InfoUserView extends TweeterView implements Renderer
{
    public function render(): string
    {
        $content = "<h2>Liste des followers</h2>";
        $content .= "Nombre de follower : ".count($this->data);
        foreach ($this->data as $user) {
            $url = $this->router->urlFor('user', ['idUser' => $user->id]);
            $content .= "<div class='tweet'>
                            <a href='$url'>$user->fullname</a>
                        </div>";
        }

        return $content;
    }
}
