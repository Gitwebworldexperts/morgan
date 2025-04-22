<!-- nav mobile -->
    @php
        $headerSection = getHeaderSection();
        $headerSections = json_decode($headerSection->navigation_links, true);
        $first_button_name = $headerSections['buttons']['first_button_name'] ?? null;
        $first_button_url = $headerSections['buttons']['first_button_url'] ?? null;
        $second_button_name = $headerSections['buttons']['second_button_name'] ?? null;
        $second_button_url = $headerSections['buttons']['second_button_url'] ?? null;
        $dropdown_urls = $headerSections['dropdown_urls'] ?? [];
    @endphp


        <nav class="sidebar" id="accordion-menu">
            <div class="authfy-body">
                <div class="menu-logo-box"> <img src="{{asset(siteLogo())}}"> </div>
                <ul class="navbar-nav">
                    {!! headerNav() !!}
                    @if(isset($dropdown_urls) && !empty($dropdown_urls))
                        @foreach ($dropdown_urls as $url => $name)
                        @if(isset($name[0]) && isset($name[1]) && $name[1] == '1')
                        <li class="nav-item"> <a class="nav-link" href="{{ $url }}">{{ $name[0] }}</a> </li>
                        @endif
                        @endforeach                        
                    @endif
                </ul>
                <div class="menu-btn-grup"> 
                    @if ($first_button_name && $first_button_url)
                        <a class="btn border-btn" href="{{ $first_button_url }}"><img src="{{asset('img/home.svg')}}" class="">{{ $first_button_name }}</a> 
                    @endif

                    @if ($second_button_name && $second_button_url)
                        <a class="btn green-btn" href="{{ $second_button_url }}"><img src="{{asset('img/user.svg')}}" class=""><span>{{ $second_button_name }}</span></a>
                    @else
                    @guest
                    <a class="btn green-btn" href="{{ route('login') }}"><img src="{{asset('img/user.svg')}}" class=""><span>Log In</span></a>
                    @else
                    <a class="btn green-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="{{asset('img/user.svg')}}" class=""><span>Log Out</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                    @endif
                </div>
            </div>
        </nav>