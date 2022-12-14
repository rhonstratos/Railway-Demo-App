@extends('errors::custom-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))

@section('full_message', __('The page you are looking for might have been removed or is temporarily unavailable.'))
@section('image')
src="{{ asset('assets/Errors/429.svg') }}" alt="Web illustrations by Storyset: https://storyset.com/web"
@endsection
