<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
class AlbumsController extends Controller
{

    public function index()
    {
        $albums=Album::with('Photos')->get();
        return view('albums.index')->with('albums',$albums);
    }

 
    public function create()
    {
      
        return view('albums.create');
    }


    public function store(Request $request)
    {
       $this->validate($request,[
        'name'=>'required',
        'cover_img'=>'image|max:1999'
    ]);
    

     $filenameWithExt = $request->file('cover_img')->getClientOriginalName();

      // Get just the filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

      // Get extension
      $extension = $request->file('cover_img')->getClientOriginalExtension();

      // Create new filename
      $filenameToStore = $filename.'_'.time().'.'.$extension;

      // Uplaod image
      $path= $request->file('cover_img')->storeAs('public/album_covers', $filenameToStore);

      // Create album
      $album = new Album;
      $album->name = $request->input('name');
      $album->description = $request->input('description');
      $album->cover_img = $filenameToStore;

      $album->save();
      return redirect('/albums')->with('success','Album added');
    }


    public function show($id){
      $album = Album::with('Photos')->find($id);
      return view('albums.show')->with('album', $album);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
