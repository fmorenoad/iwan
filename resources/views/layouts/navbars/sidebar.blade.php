<div class="sidebar" data-color="blue" data-image="{{ asset('img/sidebar-4.jpg') }}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{env('APP_URL')}}" class="simple-text logo-mini">
                {{ __('IW') }}
            </a>
            <a href="{{env('APP_URL')}}" class="simple-text logo-normal">
                {{ __('iWan PRO') }}
            </a>
        </div>
        <div class="user">
            <div class="photo">
                <img src="{{ auth()->user()->profilePicture() }}" />
            </div>
            <div class="info ">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>{{ auth()->user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                        <a class="profile-dropdown" href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini"><i class="w3-xxlarge fa fa-user"></i></span>
                                <span class="sidebar-normal">{{ __('My Profile') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="profile-dropdown" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="sidebar-mini">{{ __('LG') }}</span>
                                    <span class="sidebar-normal">{{ __('Log out') }}</span>
                                </a>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link" href={{ route('home') }}>
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('receipt.index') }} @if($activeButton =='receipt') aria-expanded="true" @endif>
                    <i class="nc-icon nc-delivery-fast"></i>
                    <p>
                        {{ __('Entry Control') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#production" @if($activeButton =='production') aria-expanded="true" @endif>
                    <i class="nc-icon nc-app"></i>
                    <p>
                        {{ __('Production') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse  @if($activeButton =='production') show @endif" id="production">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'production') active @endif">
                            <a class="nav-link" href={{ route('production.index') }}>
                                <span class="sidebar-mini"><i class="nc-icon nc-single-02"></i></span>
                                <span class="sidebar-normal">{{ __('Production') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#labelled" @if($activeButton =='labelled') aria-expanded="true" @endif>
                    <i class="nc-icon nc-tag-content"></i>
                    <p>
                        {{ __('labelled') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse  @if($activeButton =='labelled') show @endif" id="labelled">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'labelled') active @endif">
                            <a class="nav-link" href={{ route('labelled.index') }}>
                                <span class="sidebar-mini"><i class="nc-icon nc-single-02"></i></span>
                                <span class="sidebar-normal">{{ __('labelled') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#certification" @if($activeButton =='certification') aria-expanded="true" @endif>
                    <i class="nc-icon nc-zoom-split"></i>
                    <p>
                        {{ __('certification') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse  @if($activeButton =='certification') show @endif" id="certification">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'certification') active @endif">
                            <a class="nav-link" href={{ route('request.index') }}>
                                <span class="sidebar-mini"><i class="nc-icon nc-single-02"></i></span>
                                <span class="sidebar-normal">{{ __('request') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#dispatch" @if($activeButton =='dispatch') aria-expanded="true" @endif>
                    <i class="nc-icon nc-send"></i>
                    <p>
                        {{ __('dispatch') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse  @if($activeButton =='dispatch') show @endif" id="dispatch">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'dispatch') active @endif">
                            <a class="nav-link" href={{ route('dispatch.index') }}>
                                <span class="sidebar-mini"><i class="nc-icon nc-single-02"></i></span>
                                <span class="sidebar-normal">{{ __('dispatch') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#admin" @if($activeButton =='admin') aria-expanded="true" @endif>
                    <i class="nc-icon nc-puzzle-10"></i>
                    <p>
                        {{ __('Admin') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse  @if($activeButton =='admin') show @endif" id="admin">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'admin') active @endif">
                            <a class="nav-link" href={{ route('users.index') }}>
                                <span class="sidebar-mini"><i class="nc-icon nc-single-02"></i></span>
                                <span class="sidebar-normal">{{ __('Users') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'admin') active @endif">
                            <a class="nav-link" href={{ route('enterprises.index') }}>
                                <span class="sidebar-mini"><i class="nc-icon nc-bank"></i></span>
                                <span class="sidebar-normal">{{ __('Enterprises') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#config" @if($activeButton =='config') aria-expanded="true" @endif>
                    <i class="nc-icon nc-settings-gear-64"></i>
                    <p>
                        {{ __('config') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse  @if($activeButton =='config') show @endif" id="config">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'config') active @endif">
                            <a class="nav-link" href={{ route('roles.store') }}>
                                <span class="sidebar-mini"><i class="nc-icon nc-layers-3"></i></span>
                                <span class="sidebar-normal">{{ __('Roles') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'config') active @endif">
                            <a class="nav-link" href={{ route('permissions.index') }}>
                                <span class="sidebar-mini"><i class="nc-icon nc-key-25"></i></span>
                                <span class="sidebar-normal">{{ __('Permissions') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
