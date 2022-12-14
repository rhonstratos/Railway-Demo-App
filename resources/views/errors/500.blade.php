@extends('errors::custom-layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

@section('full_message', __('The page you are looking for might have been removed or is temporarily unavailable.'))

@section('image')
src="{{ asset('assets/Errors/500.svg') }}" alt="Web illustrations by Storyset: https://storyset.com/web"
@endsection
