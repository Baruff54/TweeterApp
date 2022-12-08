<?php

namespace Tweeter\tweeterapp\auth;

use Tweeter\mf\auth\AbstractAuthentification;
use Tweeter\mf\exceptions\AuthentificationException;
use Tweeter\tweeterapp\model\User;

class TweeterAuthentification extends AbstractAuthentification
{
    const ACCESS_LEVEL_USER = 1;
    const ACCESS_LEVEL_ADMIN = 2;

    public static function register(string $username, string $password, string $fullname, $level = self::ACCESS_LEVEL_USER): void
    {


        /* La méthode register
        *
        *    Permet la création d'un nouvel utilisateur de l'application
        *
        * Paramètres :
        *
        *    $username : le nom d'utilisateur choisi
        *    $pass : le mot de passe choisi
        *    $fullname : le nom complet
        *    $level : le niveaux d'accès (par défaut ACCESS_LEVEL_USER)
        *
        * Algorithme :
        *
        *    - Si un utilisateur avec le même nom d'utilisateur existe déjà en BD
        *        - soulever une exception
        *    - Sinon
        *        - créer un nouveau modèle ``User`` avec les valeurs en paramètre
        *           ATTENTION : utiliser self::makePassword (cf. ``AbstractAuthentification``)
        *
        */

        if (User::where('username', $username)->exists()) {
            throw new AuthentificationException("Un utilisateur existe déjà avec ce nom d'utilisateur.");
        } else {
            $user = new User();
            $user->username = $username;
            $user->fullname = $fullname;
            $user->level = $level;
            $user->password = self::makePassword($password);
            $user->save();
        }
    }

    public static function login(string $username, string $password): void
    {

        /* La méthode login
            *
            *     Permet de connecter un utilisateur qui a fourni son nom d'utilisateur
            *     et son mot de passe (depuis un formulaire de connexion)
            *
            * Paramètres :
            *
            *    $username : le nom d'utilisateur
            *    $password : le mot de passe tapé sur le formulaire
            *
            * Algorithme :
            *
            *    - Récupérer l'utilisateur avec l'identifiant $username depuis la BD
            *    - Si aucun de trouvé
            *         - soulever une exception
            *    - Sinon
            *         - réaliser l'authentification et le chargement du profil
            *            ATTENTION : utiliser self::checkPassword (cf. ``AbstractAuthentification``)
            *
        */

        $user = User::where('username', $username)->first();
        if ($user) {
            self::checkPassword($password, $user->password, $user->id, $user->level);
        } else {
            throw new AuthentificationException("Echec de l'authentification.");
        }
    }
}
