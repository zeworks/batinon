@extends('layouts.app') 
@section('content_header')
    <h1>Edit Blog Post #{{$id}}</h1>
@stop 
@section('content')
    @include('admin.blog._form')
    <div class="clearfix"></div>
@stop