<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Oauth_clients extends Model
{

    protected $table = 'oauth_clients';
    protected $fillable = array('id','secret', 'name');
    protected $hidden = ['created_at','updated_at']; //ocultan los atributos cuando se consultan en get

    




}