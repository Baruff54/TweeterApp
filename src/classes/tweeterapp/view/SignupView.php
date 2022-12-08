<?php

namespace Tweeter\tweeterapp\view;

use Tweeter\mf\view\Renderer;
use Tweeter\tweeterapp\view\TweeterView;

class SignupView extends TweeterView implements Renderer
{
    public function render(): string
    {
        $url = $this->router->urlFor('signup');
        $content = "<form class='forms' action='$url' method='POST'>
                        <input class='forms-text' type='text' name='fullname' placeholder='Enter your fullname'>
                        <input class='forms-text' type='text' name='username' placeholder='Enter your username'>
                        <input class='forms-text' type='password' name='password' placeholder='Enter a password'>
                        <input class='forms-text' type='password' name='password_verify' placeholder='Retype the password'>
                        <button class='forms-button' name='login_button' type='submit'>Create</button>
                    </form>";
        return $content;
    }
}
