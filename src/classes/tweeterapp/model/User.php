<?php

namespace Tweeter\tweeterapp\model;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{

    protected $table = 'user';  /* le nom de la table */
    protected $primaryKey = 'id';     /* le nom de la clé primaire */
    public $timestamps = false;    /* si vrai la table doit contenir
                                    les deux colonnes updated_at, created_at */

    public function tweets()
    {
        return $this->hasMany('Tweeter\tweeterapp\model\Tweet', 'author', 'id');
    }

    public function liked()
    {
        return $this->belongsToMany('Tweeter\tweeterapp\model\Tweet', 'Tweeter\tweeterapp\model\Like', 'user_id', 'tweet_id');
    }

    public function followedBy()
    {
        return $this->belongsToMany('Tweeter\tweeterapp\model\User', 'Tweeter\tweeterapp\model\Follow', 'followee', 'follower');
    }

    public function follows()
    {
        return $this->belongsToMany('Tweeter\tweeterapp\model\User', 'Tweeter\tweeterapp\model\Follow', 'follower', 'followee');
    }
}
