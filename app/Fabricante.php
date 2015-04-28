<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{

	protected $table = 'fabricantes';
	protected $fillable = array('nombre', 'telefono');
	protected $hidden = ['created_at','updated_at']; //ocultan los atributos cuando se consultan en get

	public function vehiculos(){
		$this->hasMany('Vehiculo');
	}




}