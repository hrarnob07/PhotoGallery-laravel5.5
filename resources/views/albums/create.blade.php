@extends('layouts.app')

@section('content')
<h2>Create Form</h2>
	{!! Form::open(['action' => 'AlbumsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}

	{{Form::text('name', '',['placeholder'=>'album name'])}}
	{{Form::textarea('description', '',['placeholder'=>'album description'])}}
	{{Form::file('cover_img')}}
	{{Form::submit('submit')}}

{!! Form::close() !!}
@endsection