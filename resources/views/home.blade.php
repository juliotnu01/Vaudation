@extends('layouts.app')

@section('content')
    
        <auth-component user_auth="{{ Auth::id() }}" />
@endsection
