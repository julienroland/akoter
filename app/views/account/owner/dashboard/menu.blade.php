<div class="menu-agence account-submenu">
    <ul>

        <li {{Helpers::isActive( 'dashboard_location' )}}>
            <a class="tooltip-ui-s" title="{{trans('dashboard.title_home')}}" href="{{route('dashboard_location',array(Auth::user()->slug, $location->id))}}">{{trans('general.home')}}</a>
        </li>
        <li {{Helpers::isActive( 'dashboard_location' )}}>
            <a class="tooltip-ui-s" title="{{trans('dashboard.title_edit')}}" href="{{route('index_localisation_building',array(Auth::user()->slug, $location->id))}}">{{trans('general.edit')}}</a>
        </li>
        <li {{Helpers::isActive( 'dashboard_location' )}}>
            <a class="tooltip-ui-s" title="{{trans('dashboard.title_tenants')}}" href="{{route('dashboard_tenants',array(Auth::user()->slug, $location->id))}}">{{trans('general.tenants')}}</a>
        </li>
    </ul>
</div>