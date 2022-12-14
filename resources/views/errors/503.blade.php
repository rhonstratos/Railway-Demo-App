@extends('errors::custom-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))

@section('full_message', __('The page you are looking for might have been removed or is temporarily unavailable.'))
@section('image')
src="{{ asset('assets/Errors/503.svg') }}" alt="Work illustrations by Storyset: https://storyset.com/work"
@endsection
