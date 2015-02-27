<?php namespace Chobito\Kernel;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Entity extends Model
{
	public static function findByUid ($uuid) {
		return self::find(hex2bin($uuid)); 	
	} 
}
