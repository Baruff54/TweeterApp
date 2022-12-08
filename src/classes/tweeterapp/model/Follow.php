<?php

namespace Tweeter\tweeterapp\model;

use Illuminate\Database\Eloquent\Model;



class Follow extends Model
{

    protected $table = 'follow';  /* le nom de la table */
    protected $primaryKey = 'id';     /* le nom de la clé primaire */
    public $timestamps = false;    /* si vrai la table doit contenir
                                    les deux colonnes updated_at, created_at */

    public function tweetsFollow()
    {
        return $this->hasMany('Tweeter\tweeterapp\model\Tweet', 'author', 'followee');
    }
}
