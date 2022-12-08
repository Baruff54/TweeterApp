<?php
session_start();
ini_set('display_errors', 1);


require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager;
use Tweeter\mf\router\Router;
use Tweeter\mf\view\AbstractView;
use Tweeter\tweeterapp\auth\TweeterAuthentification;

$data = parse_ini_file("conf/config.ini");

/* une instance de connexion  */
$db = new Manager();

$db->addConnection($data); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();           /* établir la connexion */

$router = new Router();

$router->addRoute('home', 'list_tweets', 'Tweeter\tweeterapp\control\HomeController', TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('view', 'view_tweet', 'Tweeter\tweeterapp\control\TweetController', TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('user', 'view_user_tweets', 'Tweeter\tweeterapp\control\UserController', TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('saveTweet', 'post_tweet', 'Tweeter\tweeterapp\control\PostController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('signup', 'signup', 'Tweeter\tweeterapp\control\SignupController', TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('following', 'view_following', 'Tweeter\tweeterapp\control\FollowingController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('login', 'login', 'Tweeter\tweeterapp\control\LoginController', TweeterAuthentification::ACCESS_LEVEL_NONE);
$router->addRoute('logout', 'logout', 'Tweeter\tweeterapp\control\LogoutController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('info', 'info', 'Tweeter\tweeterapp\control\InfoUserController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->setDefaultRoute('list_tweets');

AbstractView::addStyleSheet("./html/style.css");
AbstractView::setAppTitle('Tweeter');

$router->run();