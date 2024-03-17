@extends('layout')

@section('content')
    @foreach ($items as $item)
        {{ $item }}
    @endforeach

    {{$items->links()}}
@endsection
