@extends('layouts.app')

@section('title', 'Features')

@section('content')
    <h2>Features</h2>
    <ul>
        @foreach ($features as $feature)
            <li>{{ $feature }}</li>
        @endforeach
    </ul>
@endsection
