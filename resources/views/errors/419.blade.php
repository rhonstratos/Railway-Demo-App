@extends('errors::custom-layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))

@section('full_message', __('The page you are looking for might have been removed or is temporarily unavailable.'))
@section('image')
src="{{ asset('assets/Errors/419.svg') }}" alt="Work illustrations by Storyset: https://storyset.com/work"
@endsection
