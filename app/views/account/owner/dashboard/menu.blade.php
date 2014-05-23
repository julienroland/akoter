<div class="menu-agence account-submenu">
    <ul>

        <li {{Helpers::isActive( 'dashboard_location' )}}>
            <a href="{{route('dashboard_location',array(Auth::user()->slug, $location->id))}}">{{trans('general.home')}}</a>
        </li>
        <li {{Helpers::isActive( 'dashboard_location' )}}>
            <a href="{{route('dashboard_location',array(Auth::user()->slug, $location->id))}}">{{trans('general.edit')}}</a>
        </li>
        <li {{Helpers::isActive( 'dashboard_location' )}}>
            <a href="{{route('dashboard_location',array(Auth::user()->slug, $location->id))}}">{{trans('general.tenants')}}</a>
        </li>
    </ul>
</div>