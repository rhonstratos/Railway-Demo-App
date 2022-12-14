@extends('errors::custom-layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

@section('full_message', __('The page you are looking for might have been removed or is temporarily unavailable.'))
@section('image')
src="{{ asset('assets/Errors/403.svg') }}" alt="User illustrations by Storyset: https://storyset.com/user"
@endsection
