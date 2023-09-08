@extends('layouts.app')

@section('title')
    Página Principal
@endsection

@section('content')

<x-listed-post :posts="$posts" />

@endsection