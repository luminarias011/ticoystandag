<ul class="menu-sub">
  @if (isset($menu))
  @foreach ($menu as $submenu)

  {{-- active menu method --}}
  @php  
  $activeClass = null;
  $active = 'active open';
  $currentRouteName = Route::currentRouteName();

  if ($currentRouteName === $submenu->slug) {
  $activeClass = 'active';
  }
  elseif (isset($submenu->submenu)) {
  if (gettype($submenu->slug) === 'array') {
  foreach($submenu->slug as $slug){
  if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
  $activeClass = $active;
  }
  }
  }
  else{
  if (str_contains($currentRouteName,$submenu->slug) and strpos($currentRouteName,$submenu->slug) === 0) {
  $activeClass = $active;
  }
  }
  }
  @endphp

  <li class="menu-item {{$activeClass}}">
    <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}" class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
      @if (isset($submenu->icon))
      <i class="{{ $submenu->icon }}"></i>
      @endif
      <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}
      {{-- ! badge HERE --}}
      @if (__($submenu->name) === 'Room Booking')
      @if (bookedRooms() !== 0)
      <span class="badge rounded-pill badge-center h-px-10 w-px-10 bg-danger small"><span style="padding-top: 1px; padding-right: 0.7px; font-size: 11px">{{ bookedRooms() }}</span></span>
      @endif
      @endif
      </div>
    </a>

    {{-- submenu --}}
    @if (isset($submenu->submenu))
    @include('layouts.sections.menu.submenu',['menu' => $submenu->submenu])
    @endif
  </li>
  @endforeach
  @endif
</ul>
