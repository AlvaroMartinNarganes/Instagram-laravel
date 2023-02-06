@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <x-listar-post :posts="$posts" />
@endsection
