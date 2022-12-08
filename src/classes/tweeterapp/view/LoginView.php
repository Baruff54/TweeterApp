<?php

namespace Tweeter\tweeterapp\view;

use Tweeter\mf\view\Renderer;

class LoginView extends TweeterView implements Renderer
{
    public function render(): string
    {
        $url = $this->router->urlFor('login');
        $content = "<form class='forms' action='$url' method='POST'>
                        <input class='forms-text' type='text' name='username' placeholder='Enter your username'>
                        <input class='forms-text' type='password' name='password' placeholder='Enter your password'>
                        <button class='forms-button' name='login_button' type='submit'>Login</button>
                    </form>";
        return $content;
    }
}
