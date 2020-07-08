@extends('layouts.app')

@section('content')
        <auth-component v-bind:user_auth="{ a:{{Auth::id()}}, c:{{Auth::check()}} }"  />
@endsection
