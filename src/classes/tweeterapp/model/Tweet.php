<?php

namespace Tweeter\tweeterapp\model;

use Illuminate\Database\Eloquent\Model;



class Tweet extends Model
{

    protected $table = 'tweet';  /* le nom de la table */
    protected $primaryKey = 'id';     /* le nom de la clé primaire */
    public $timestamps = true;    /* si vrai la table doit contenir
                                    les deux colonnes updated_at, created_at */

    public function author()
    {
        return $this->belongsTo('Tweeter\tweeterapp\model\User', 'author');
    }

    public function likedBy()
    {
        return $this->belongsToMany('Tweeter\tweeterapp\model\User', 'Tweeter\tweeterapp\model\Like', 'tweet_id', 'user_id');
    }
}
