<nav class="navbar navbar-expand-md navbar-inverse shadow-sm">

                <a style="font-size:20px;font-weight:bold;" class="navbar-brand" href="{{ route('/') }}">
                    {{ config('app.name', 'FiLo') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto p-1">
                        <li class="nav-item">
                            <a  style="font-size:15px;" class="nav-link" href="{{ route('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a style="font-size:15px;" class="nav-link" href="{{ route('/category/{id}') }}">Found Items</a>
                        </li>
                        {{-- @if(Auth::check() && Auth::user()->isAdmin == 1) --}}
                        @if(Auth::user() && !Auth::user()->isAdmin)
                        <li class="nav-item">
                            <a style="font-size:15px;" class="nav-link" href="{{ route('/post') }}">Add Found Item</a>
                        </li>
                        @endif
                        @if(Auth::check() && Auth::user()->isAdmin)
                        <li class="nav-item">
                            <a style="font-size:15px;font-weight:bold;" class="nav-link" href="{{ route('/request/{id}') }}">Admin Dashboard</a>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('/') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('/') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::check() && !Auth::user()->isAdmin)
                                    <a class="dropdown-item" href="{{ route('/profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('/home') }}">DashBoard</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endif
                                    @if(Auth::check() && Auth::user()->isAdmin)
                                        <a class="dropdown-item" href="{{ route('/category')}}">Category</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

        </nav>





