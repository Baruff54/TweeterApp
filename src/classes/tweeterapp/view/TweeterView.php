<?php

namespace Tweeter\tweeterapp\view;

use Tweeter\mf\view\AbstractView;
use Tweeter\mf\view\Renderer;
use Tweeter\tweeterapp\auth\TweeterAuthentification;

abstract class TweeterView extends AbstractView implements Renderer
{
    protected function makeBody(): string
    {
        $content = $this->render();
        $bottomMenu = $this->renderBottomMenu();
        $topMenu = $this->renderTopMenu();
        $mainContent = "<header class='theme-backcolor1'>
                            <h1>Tweeter</h1>
                            $topMenu
                        </header>
                        <section>
                            <article class='theme-backcolor2'>$content</article>
                            $bottomMenu
                        </section>
                        <footer class='theme-backcolor1'>La super app créée en Licence Pro ©2022</footer>";

        return $mainContent;
    }

    public function renderBottomMenu()
    {
        $url = $this->router->urlFor('saveTweet');
        if (isset($_SESSION['user_profile'])) {
            return "<nav id='menu' class='theme-backcolor1'>
                        <div id='nav-menu'>
                            <div class='button theme-backcolor2'>
                                <a href='$url'>New</a>
                            </div>
                        </div>
                    </nav>";
        }
    }

    public function renderTopMenu()
    {
        $urlLogin = $this->router->urlFor('login');
        $urlLogout = $this->router->urlFor('logout');
        $urlHome = $this->router->urlFor('home');
        $urlRegister = $this->router->urlFor('signup');
        $urlFollowing = $this->router->urlFor('following');

        if (isset($_SESSION['user_profile'])) {
            return "<nav id='navbar'>
                       <a class='tweet-control' href='$urlHome'><img alt='home' src='../Tweeter/html/home.png'></a>
                       <a class='tweet-control' href='$urlFollowing'><img alt='following' src='../Tweeter/html/followees.png'></a>
                       <a class='tweet-control' href='$urlLogout'><img alt='logout' src='../Tweeter/html/logout.png'></a> 
                    </nav>";
        } else {
            return "<nav id='navbar'>
                        <a class='tweet-control' href='$urlHome'><img alt='home' src='../Tweeter/html/home.png'></a>
                        <a class='tweet-control' href='$urlLogin'><img alt='login' src='../Tweeter/html/login.png'></a>
                        <a class='tweet-control' href='$urlRegister'><img alt='signup' src='../Tweeter/html/signup.png'></a>
                    </nav>";
        }
    }
}
