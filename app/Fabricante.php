<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{

	protected $table = 'Vehiculos';
	protected $fillable = array('nombre', 'telefono');

	public function vehiculos(){
		$this->hasMany('Vehiculo');
	}




}