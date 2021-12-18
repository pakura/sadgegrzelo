<li>
  <a href="{{ cms_url('/') }}">
    <i class="{{icon_type('dashboard')}}" title="Dashboard"></i>
    <span class="title">Home</span>
  </a>
</li>
<li>
  <a href="{{ $menusUrl = cms_route('menus.index') }}">
    <i class="fa fa-sitemap" title="Site Map"></i>
    <span class="title">Site Map</span>
  </a>
  <ul>
    @if (! empty($menus))
      @foreach ($menus as $item)
        <li>
          <a href="{{ cms_route('pages.index', [$item->id]) }}">
            <i class="{{icon_type('pages')}}" title="Pages"></i>
            <span class="title">{{ $item->title }}</span>
          </a>
        </li>
      @endforeach
    @endif
    <li>
      <a href="{{ $menusUrl }}">
        <i class="{{icon_type('menus')}}" title="Menus"></i>
        <span class="title">Menu Management</span>
      </a>
    </li>
  </ul>
</li>
<li>
  <a href="{{ cms_route('collections.index') }}">
    <i class="{{icon_type('collections')}}" title="Collections"></i>
    <span class="title">Collections</span>
  </a>
</li>
<li>
  <a href="{{ cms_route('filemanager') }}">
    <i class="fa fa-files-o" title="File Manager"></i>
    <span class="title">File Manager</span>
  </a>
</li>
<li>
  <a href="{{ $cmsUsersUrl = cms_route('cmsUsers.index') }}">
    <i class="fa fa-users" title="User Groups"></i>
    <span class="title">User Groups</span>
  </a>
  <ul>
    <li>
      <a href="{{ $cmsUsersUrl }}">
        <i class="{{icon_type('cmsUsers')}}" title="CMS Users"></i>
        <span class="title">CMS Users</span>
      </a>
    </li>
  </ul>
</li>
<li>
  <a href="{{ $settingsUrl = cms_route('settings.index') }}">
    <i class="fa fa-gears" title="Settings"></i>
    <span class="title">Settings</span>
  </a>
  <ul>
    <li>
      <a href="{{ $settingsUrl }}">
        <i class="fa fa-gear" title="Admin Settings"></i>
        <span class="title">CMS Settings</span>
      </a>
    </li>
    <li>
      <a href="{{ cms_route('webSettings.index') }}">
        <i class="fa fa-gear" title="Web Settings"></i>
        <span class="title">Web Settings</span>
      </a>
    </li>
    <li>
      <a href="{{ cms_route('translations.index') }}">
        <i class="{{icon_type('translations')}}" title="Translations"></i>
        <span class="title">Translations</span>
      </a>
    </li>
  </ul>
</li>
<li>
  <a href="{{ $calendarUrl = cms_route('calendar.index') }}">
    <i class="fa fa-flask" title="Extra"></i>
    <span class="title">Extra</span>
  </a>
  <ul>
    <li>
      <a href="{{ cms_route('slider.index') }}">
        <i class="fa fa-photo" title="Slider"></i>
        <span class="title">Homepage Slider</span>
      </a>
    </li>
    <li>
      <a href="{{ $calendarUrl }}">
        <i class="fa fa-calendar" title="Calendar"></i>
        <span class="title">Calendar</span>
      </a>
    </li>
    <li>
      <a href="{{ cms_route('notes.index') }}">
        <i class="fa fa-file-text-o" title="notes"></i>
        <span class="title">Notes</span>
      </a>
    </li>
  </ul>
</li>