<?php namespace Chobito\Pictures;

use Auth;

/**
* 
*/
class Storage
{
	private $dir;

	public function __construct($data)
	{
		$this->dir = storage_path() .'/uploads/';

		$picture = new Picture;
		$picture->id = 
		$picture->caption = $data['caption'];
		$picture->details = $data['details'];
		$picture->path = $this->saveImage($data['image']);

		$user = Auth::user();
		$user->pictures()->save($picture);
	}

	private function saveImage($image)
	{
		$moved = $image->move($this->dir);
		return $moved->getRealPath();
	}
}
