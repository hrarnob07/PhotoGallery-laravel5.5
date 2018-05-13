<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;

class PhotoController extends Controller
{
   
    public function index()
    {
        //
    }

 
    public function create($id)
    {
      //return "hr";
        return view('photos.create')->with('album_id',$id);
    }

   public function store(Request $request){
   $this->validate($request, [
        'title' => 'required',
        'photo' => 'image|max:1999'
      ]);

      // Get filename with extension
      $filenameWithExt = $request->file('photo')->getClientOriginalName();

      // Get just the filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

      // Get extension
      $extension = $request->file('photo')->getClientOriginalExtension();

      // Create new filename
      $filenameToStore = $filename.'_'.time().'.'.$extension;

      // Uplaod image
      $path= $request->file('photo')->storeAs('public/photos/'.$request->input('album_id'), $filenameToStore);

      // Upload Photo
      $photo = new Photo;
      $photo->album_id = $request->input('album_id');
      $photo->title = $request->input('title');
      $photo->description = $request->input('description');
      $photo->size = $request->file('photo')->getClientSize();
      $photo->photo = $filenameToStore;

      $photo->save();

      return redirect('/albums/'.$request->input('album_id'))->with('success', 'Photo Uploaded');
    }

     public function show($id)
    {
     //  return "hr";
      $photo = Photo::find($id);
      return view('photos.show')->with('photo', $photo);
    }
    
 
public function destroy($id)
{
 $photo = Photo::find($id);
      $photo->delete();
       return redirect('/')->with('success', 'Photo Deleted');

}
}