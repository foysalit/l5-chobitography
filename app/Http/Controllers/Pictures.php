<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PictureUpload as UploadRequest;
use Chobito\Pictures\Storage as PictureStorage;
use Chobito\Pictures\Picture;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class Pictures extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pictures = Picture::all();
		return view('pictures.list')->with('pictures', $pictures);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function upload()
	{
		return view('pictures.upload');
	}

	public function showImage($id)
	{
		$picture = Picture::findByUid($id);
		return response()->download($picture->path);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function uploadSave(UploadRequest $req)
	{
		$storage = new PictureStorage($req->all());
		return redirect()->route('pictures');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
