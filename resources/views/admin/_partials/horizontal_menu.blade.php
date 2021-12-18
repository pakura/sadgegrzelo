<nav class="navbar horizontal-menu{{$cmsSettings->get('layout_boxed') ? '' : ' navbar-fixed-top'}} {{$cmsSettings->get('horizontal_menu_minimal')}}"><!-- set fixed position by adding class "navbar-fixed-top" -->
  <div class="navbar-inner">
    <!-- Navbar Brand -->
    <div class="navbar-brand">
      <a href="{{ cms_url('/') }}" class="logo">
        <span class="name">CMS</span>
      </a>
      <a href="#" data-toggle="settings-pane" data-animate="true">
        <i class="fa fa-gear"></i>
      </a>
    </div>
    <!-- Mobile Toggles Links -->
    <div class="nav navbar-mobile">
      <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
      <div class="mobile-menu-toggle">
        <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
        <a href="#" data-toggle="settings-pane" data-animate="true">
          <i class="fa fa-gear"></i>
        </a>
        <!-- data-toggle="mobile-menu-horizontal" will show horizontal menu links only -->
        <!-- data-toggle="mobile-menu" will show sidebar menu links only -->
        <!-- data-toggle="mobile-menu-both" will show sidebar and horizontal menu links -->
        <a href="#" data-toggle="mobile-menu-horizontal">
          <i class="fa fa-bars"></i>
        </a>
      </div>
    </div>
    <div class="navbar-mobile-clear"></div>
    <!-- main menu -->
    <ul class="navbar-nav {{$cmsSettings->get('horizontal_menu_click')}}">
      @include('admin._partials.menu')
    </ul>
    <!-- notifications and other links -->
    <ul class="nav nav-userinfo navbar-right">
    @if (count($languages = languages()) > 1)
      <!-- Added in v1.2 -->
        <li class="dropdown hover-line language-switcher">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('assets/libs/images/flags/flag-'.language().'.png') }}" alt="flag-{{language()}}" />
          </a>
          <ul class="dropdown-menu languages">
            @foreach ($languages as $key => $value)
              <li>
                <a href="{{$value['url']}}">
                  <img src="{{ asset('assets/libs/images/flags/flag-'.$key.'.png') }}" alt="flag-{{$key}}" />
                  {{ $value['full_name'] }}
                </a>
              </li>
            @endforeach
          </ul>
        </li>
      @endif
      <li class="dropdown xs-left">
        <a href="#" data-toggle="dropdown" class="notification-icon notification-icon-messages">
          <i class="fa fa-calendar"></i>
          @if (($calendarEventsCount = count($calendarEvents)) > 0)
            <span class="badge badge-orange">{{$calendarEventsCount}}</span>
          @endif
        </a>
        @if ($calendarEventsCount)
          <ul class="dropdown-menu notifications">
            <li class="top">
              <p class="small">
                You have <strong>{{$calendarEventsCount}}</strong> upcoming event{{$calendarEventsCount > 1 ? 's' : ''}}.
              </p>
            </li>
            <li>
              <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                @foreach ($calendarEvents as $item)
                  <li {!!($date = date('d F Y', strtotime($item->start))) == date('d F Y') ? ' class="active"' : ''!!}>
                    <a href="{{cms_route('calendar.index', ['gotoDate' => $item->start])}}">
                      <i class="fa fa-calendar-o icon-color-{{$item->color}}"></i>
                      <span class="line">
                    <strong>{{$item->title}}</strong>
                  </span>
                      <span class="line small time">
                    Date: {{$date}}
                  </span>
                      @if ($item->time_start)
                        <span class="line small time">
                    Time: {{date('H:i', strtotime($date))}}
                  </span>
                      @endif
                    </a>
                  </li>
                @endforeach
              </ul>
            </li>
            <li class="external">
              <a href="{{cms_route('calendar.index')}}">
                <span>View calendar</span>
                <i class="fa fa-link-ext"></i>
              </a>
            </li>
          </ul>
        @endif
      </li>
      <li>
        <form method="post" action="{{cms_route('lockscreen')}}" id="set-lockscreen">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="put">
          <button type="submit" class="btn btn-link" title="Lockscreen">
            <i class="fa fa-lock"></i>
          </button>
        </form>
      </li>
      <li>
        <a href="{{web_url('/')}}" target="_blank"><i class="fa fa-desktop"></i></a>
      </li>
      <li class="dropdown user-profile">
        <a href="#" data-toggle="dropdown">
          <img src="{{ Auth::guard('cms')->user()->photo }}" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
          <span>
            {{Auth::guard('cms')->user()->first_name}} {{Auth::guard('cms')->user()->last_name}}
            <i class="fa fa-angle-down"></i>
          </span>
        </a>
        <ul class="dropdown-menu user-profile-menu list-unstyled">
          <li>
            <a href="{{cms_route('cmsUsers.show', [$userId = Auth::guard('cms')->id()])}}">
              <i class="{{icon_type('cmsUsers')}}"></i>
              Profile
            </a>
          </li>
          <li>
            <a href="{{cms_route('cmsUsers.edit', [$userId])}}">
              <i class="fa fa-edit"></i>
              Edit
            </a>
          </li>
          <li>
            <a href="#help">
              <i class="fa fa-info"></i>
              Help
            </a>
          </li>
          <li class="last">
            <form action="{{cms_route('logout')}}" method="post">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <button>
                <i class="fa fa-sign-out"></i>
                Logout
              </button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
