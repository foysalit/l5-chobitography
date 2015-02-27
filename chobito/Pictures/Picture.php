<?php namespace Chobito\Pictures;

use Chobito\Kernel\Entity;

/**
* 
*/
class Picture extends Entity
{
	protected $table = 'pictures';

	protected $fillable = ['caption', 'details'];

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function getDisplayUrlAttribute($value)
	{
		return route('pictures.image', $this->id);
	}
}
