@section('styles')
    <link rel="stylesheet" href="{{ asset('frontEnd/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('frontEnd/css/framework.css') }}">
@endsection

<div id="menu-1" class="menu-wrapper menu-light menu-sidebar-left menu-large">
    <div class="menu-scroll">
        
        <a href="{{ url("/") }}" class="">
            <img src="{{ asset('frontEnd/images/logo.png') }}" alt="" style="width: 80%; left: 5px;">
        </a>
        <div class="menu">
            @if (Auth::check())
                <a class="menu-item active-item" href="{{ route('userprofile',Auth::user()->id) }}"><i class="font-15 fa color-night-light fa-user"></i><strong>{{Auth::user()->name}}</strong></a>
            @else
            <a class="menu-item active-item btn btn-primary" href="{{ route('client-login') }}"><i class="font-15 fa color-night-light fa-user"></i><strong>login</strong></a>
            @endif
            
            <em class="menu-divider">Navigation<i class="fa fa-bars"></i></em>
            <div class="dark-mode-toggle"><a href="#" class="toggle-2 toggle-trigger"><strong><u></u>Dark Mode</strong><i class="bg-green-dark"></i><span></span><i class="bg-gray-light"></i></a></div>
<div class="dark-menu-toggle"><a href="#" class="toggle-2 toggle-trigger"><strong><u></u>Dark Menu</strong><i class="bg-green-dark"></i><span></span><i class="bg-gray-light"></i></a></div>
            <a class="menu-item active-item" href="{{ url("/") }}"><i class="font-15 fa color-night-light fa-home"></i><strong>Home</strong></a>
             <a class="menu-item close-menu " href="{{ route('marquee-regist') }}"><i class="font-14 fa fa-request"></i><strong>Marquee Registration</strong></a>
            <a class="menu-item close-menu " href="#"><i class="font-14 fa color-orange-dark fa-times"></i><strong>Close</strong></a>
            @if (Auth::check())
            <a class="menu-item close-menu " href="{{ route('client.logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="font-14 fa  fa-info-circle"></i><strong>Logout</strong></a>
            <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
            @endif
        </div>
    </div>
</div>
<div id="header" class="header-logo-right header-dark">
    <a href="{{ url("/") }}" class="header-logo"> 
        <img src="{{ asset('frontEnd/images/logo.png') }}" alt="" style="width: 120%; right: 25px;">
    </a>
    <a href="#" class="header-icon header-icon-1 hamburger-animated" data-deploy-menu="menu-1"></a>  
</div>