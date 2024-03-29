<div class="sidebar" data-color="blue" data-image="{{ asset('img/sidebar-5.jpg') }}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ env('APP_URL') }}" class="simple-text logo-mini">
                {{ env('APP_LOGO', 'IWAN') }}
            </a>
            <a href="{{ env('APP_URL') }}" class="simple-text logo-normal">
                {{ env('APP_NAME', 'IWAN') }}
            </a>
        </div>

        <ul class="nav">
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link" href={{ route('home') }}>
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#admin" @if($activeButton =='admin') aria-expanded="true" @endif>
                    <i class="nc-icon nc-grid-45"></i>
                    <p>{{ __('Admin') }}<b class="caret"></b></p>
                </a>
                <div class="collapse  @if($activePage =='admin') show @endif" id="admin">
                    <ul class="nav">
                        <li class="nav-item @if($activeButton == 'permissions') active @endif">
                            <a class="nav-link" href={{ route('admin.permissions.index') }}>
                                <span class="sidebar-mini">{{ __('P') }}</span>
                                <span class="sidebar-normal">{{ __('Permissions') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activeButton == 'roles') active @endif">
                            <a class="nav-link" href={{ route('admin.roles.index') }}>
                                <span class="sidebar-mini">{{ __('R') }}</span>
                                <span class="sidebar-normal">{{ __('Roles') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activeButton == 'users') active @endif">
                            <a class="nav-link" href={{ route('admin.users.index') }}>
                                <span class="sidebar-mini">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __('Users') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#componentsExamples" @if($activeButton =='components') aria-expanded="true" @endif>
                    <i class="nc-icon nc-app"></i>
                    <p>
                        {{ __('Components') }}
                        <b class="caret"></b>
                    </p>
                </a>
                {{-- <div class="collapse @if($activeButton =='components') show @endif" id="componentsExamples">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'buttons') active @endif">
                            <a class="nav-link" href="{{route('page.index', 'components.buttons')}}">
                                <span class="sidebar-mini">{{ __('B') }}</span>
                                <span class="sidebar-normal">{{ __('Buttons') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'grid') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'components.grid') }}">
                                <span class="sidebar-mini">{{ __('GS') }}</span>
                                <span class="sidebar-normal">{{ __('Grid System') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'panels') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'components.panels') }}">
                                <span class="sidebar-mini">{{ __('P') }}</span>
                                <span class="sidebar-normal">{{ __('Panels') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'sweet-alert') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'components.sweet-alert') }}">
                                <span class="sidebar-mini">{{ __('SA') }}</span>
                                <span class="sidebar-normal">{{ __('Sweet Alert') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'notifications') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'components.notifications') }}">
                                <span class="sidebar-mini">{{ __('N') }}</span>
                                <span class="sidebar-normal">{{ __('Notifications') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'icons') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'components.icons') }}">
                                <span class="sidebar-mini">{{ __('I') }}</span>
                                <span class="sidebar-normal">{{ __('Icons') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'typography') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'components.typography') }}">
                                <span class="sidebar-mini">{{ __('T') }}</span>
                                <span class="sidebar-normal">{{ __('Typography') }}</span>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#formsExamples"  @if($activeButton == 'forms') aria-expanded="true" @endif>
                    <i class="nc-icon nc-notes"></i>
                    <p>
                        {{ __('Forms') }}
                        <b class="caret"></b>
                    </p>
                </a>
                {{-- <div class="collapse @if($activeButton == 'forms') show @endif" id="formsExamples">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'regular-forms') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'forms.regular-forms') }}">
                                <span class="sidebar-mini">{{ __('Rf') }}</span>
                                <span class="sidebar-normal">{{ __('Regular Forms') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'extended-forms') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'forms.extended-forms') }}">
                                <span class="sidebar-mini">{{ __('Ef') }}</span>
                                <span class="sidebar-normal">{{ __('Extended Forms') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'validation-forms') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'forms.validation-forms') }}">
                                <span class="sidebar-mini">{{ __('Vf') }}</span>
                                <span class="sidebar-normal">{{ __('Validation Forms') }}</span>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'wizard') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'forms.wizard') }}">
                                <span class="sidebar-mini">{{ __('W') }}</span>
                                <span class="sidebar-normal">{{ __('Wizard') }}</span>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tablesExamples" @if($activeButton == 'tables') aria-expanded="true" @endif>
                    <i class="nc-icon nc-paper-2"></i>
                    <p>
                        {{ __('Tables') }}
                        <b class="caret"></b>
                    </p>
                </a>
                {{-- <div class="collapse @if($activeButton == 'tables') show @endif" id="tablesExamples">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'regular') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'tables.regular') }}">
                                <span class="sidebar-mini">{{ __('RT') }}</span>
                                <span class="sidebar-normal">{{ __('Regular Tables') }}</span>
                            </a>
                        </li>
                        <li class="nav-item  @if($activePage == 'extended') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'tables.extended') }}">
                                <span class="sidebar-mini">{{ __('ET') }}</span>
                                <span class="sidebar-normal">{{ __('Extended Tables') }}</span>
                            </a>
                        </li>
                        <li class="nav-item  @if($activePage == 'bootstrap') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'tables.bootstrap') }}">
                                <span class="sidebar-mini">{{ __('BT') }}</span>
                                <span class="sidebar-normal">{{ __('Bootstrap Table') }}</span>
                            </a>
                        </li>
                        <li class="nav-item  @if($activePage == 'datatables') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'tables.datatables') }}">
                                <span class="sidebar-mini">{{ __('DT') }}</span>
                                <span class="sidebar-normal">{{ __('DataTables.net') }}</span>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#mapsExamples" @if($activeButton == 'maps') aria-expanded="true" @endif>
                    <i class="nc-icon nc-pin-3"></i>
                    <p>
                        {{ __('Maps') }}
                        <b class="caret"></b>
                    </p>
                </a>
                {{-- <div class="collapse @if($activeButton == 'maps') show @endif" id="mapsExamples">
                    <ul class="nav">
                        <li class="nav-item  @if($activePage == 'google') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'maps.google') }}">
                                <span class="sidebar-mini">{{ __('GM') }}</span>
                                <span class="sidebar-normal">{{ __('Google Maps') }}</span>
                            </a>
                        </li>
                        <li class="nav-item  @if($activePage == 'vector') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'maps.vector') }}">
                                <span class="sidebar-mini">{{ __('VM') }}</span>
                                <span class="sidebar-normal">{{ __('Vector maps') }}</span>
                            </a>
                        </li>
                        <li class="nav-item  @if($activePage == 'fullscreen') active @endif">
                            <a class="nav-link" href="{{ route('page.index', 'maps.fullscreen') }}">
                                <span class="sidebar-mini">{{ __('FSM') }}</span>
                                <span class="sidebar-normal">{{ __('Full Screen Map') }}</span>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            {{-- </li>
            <li class="nav-item @if($activePage == 'charts') active @endif">
                <a class="nav-link" href="{{ route('page.index', 'charts') }}">
                    <i class="nc-icon nc-chart-bar-32"></i>
                    <p>{{ __('Charts') }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'calendar') active @endif">
                <a class="nav-link" href="{{ route('page.index', 'calendar') }}">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>{{ __('Calendar') }}</p>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
                    <i class="nc-icon nc-puzzle-10"></i>
                    <p>
                        {{ __('Pages') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="pagesExamples">
                    <ul class="nav">
                        {{-- <li class="nav-item  ">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __('User Page') }}</span>
                            </a>
                        </li> --}}
                        <li class="nav-item  ">
                            <a class="nav-link" href="#lbd">
                                <span class="sidebar-mini">{{ __('MCS') }}</span>
                                <span class="sidebar-normal">{{ __('More coming soon...') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>