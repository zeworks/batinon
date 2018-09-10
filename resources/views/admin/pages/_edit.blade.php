@extends('adminlte::page') 
@section('content_header')
    <h1>Edit Page #{{$id}}</h1>
@stop 
@section('content')
    @include('admin.pages._form')
    <div class="clearfix"></div>
@stop