@extends('errors::custom-layout')

@section('title', __('Page Not Found'))
@section('code', '404')
@section('message', __('Page Not Found'))

@section('full_message', __('The page you are looking for might have been removed or is temporarily unavailable.'))
@section('image')
src="{{ asset('assets/Errors/404.svg') }}" alt="Web illustrations by Storyset: https://storyset.com/web"
@endsection
