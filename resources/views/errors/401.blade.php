@extends('errors::custom-layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))

@section('full_message', __('The page you are looking for might have been removed or is temporarily unavailable.'))
@section('image')
src="{{ asset('assets/Errors/401.svg') }}" alt="Web illustrations by Storyset: https://storyset.com/web"
@endsection
