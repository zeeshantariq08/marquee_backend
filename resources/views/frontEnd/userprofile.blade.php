@extends('layouts.frontEndLayout')

@section('header')
    @include('frontEnd.header')
@endsection

@section('content')

<div class="profile-2">
                        <img class="profile-image preload-image" data-src="{{ asset('frontEnd/images/avatar.png') }}" alt="img" />
                        <div class="profile-body">
                            <h1 class="profile-heading">{{$user->name}}</h1>
                           {{--  <h2 class="profile-sub-heading"><a href="#"></a></h2> --}}
                            <a href="#" class="button button-round button-green button-round button-xs button-center-large full-top uppercase ultrabold">{{$user->email}}</a>
                            <div class="decoration decoration-margins full-top half-bottom"></div>
                            <div class="profile-stats">
                                <a href="#"><i class="fab center-text facebook-bg fa-facebook-f"></i></a>
                                <a href="#"><i class="fab center-text twitter-bg fa-twitter"></i></a>
                                <a href="#"><i class="fab center-text google-bg fa-google-plus-g"></i></a>
                                <div class="clear"></div>
                            </div>
                            
                            
                        </div>
                    </div>
@endsection

@section('footer')
    @include('frontEnd.footer')
@endsection