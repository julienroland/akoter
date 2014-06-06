@extends('account.owner.dashboard.layout')
@section('dashboard')
<div class="tenants">
    <div class="current">
            <h3 aria-level="3" role="heading" class="title">{{trans('dashboard.currentTenant')}}</h3>
            
        @foreach($tenants as $tenant)

        <div class="tenant">
            <div class="infos">
                <div class="thumbnail">

                    @if( $tenant->photo && Helpers::isOk($tenant->photo) )
                    <a href="{{route('account_home', $tenant->slug)}}" title="{{trans('account.show', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}">
                        <img src="{{Config::get('var.path').Config::get('var.images_dir').Config::get('var.users_dir').$tenant->id.'/'.Config::get('var.profile_dir').$tenant->photo}}" alt="{{trans('account.imageProfile', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
                    </a>
                    @else 
                    @if($tenant->civilty == 0)
                    <a href="{{route('account_home', $tenant->slug)}}" title="{{trans('account.show', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}">
                        <img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserM')}}" alt="{{trans('account.imageProfile', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
                    </a>
                    @else 
                    <a href="{{route('account_home', $tenant->slug)}}" title="{{trans('account.show', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}">
                        <img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserF')}}" alt="{{trans('account.imageProfile', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
                    </a>
                    @endif
                    @endif
                </div>
                <span class="name">{{$tenant->first_name.' '.$tenant->name}}</span>
            </div>
        </div>

        @endforeach
    </div>
    <div class="all">
        @foreach($all as $tenant)

        <div class="tenant">
            <div class="infos">
                <div class="thumbnail">

                    @if( $tenant->photo && Helpers::isOk($tenant->photo) )
                    <a href="{{route('account_home', $tenant->slug)}}" title="{{trans('account.show', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}">
                        <img src="{{Config::get('var.path').Config::get('var.images_dir').Config::get('var.users_dir').$tenant->id.'/'.Config::get('var.profile_dir').$tenant->photo}}" alt="{{trans('account.imageProfile', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
                    </a>
                    @else 
                    @if($tenant->civilty == 0)
                    <a href="{{route('account_home', $tenant->slug)}}" title="{{trans('account.show', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}">
                        <img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserM')}}" alt="{{trans('account.imageProfile', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
                    </a>
                    @else 
                    <a href="{{route('account_home', $tenant->slug)}}" title="{{trans('account.show', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}">
                        <img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserF')}}" alt="{{trans('account.imageProfile', array('name'=>$tenant->first_name. ' ' .$tenant->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
                    </a>
                    @endif
                    @endif
                </div>
                <span class="name">{{$tenant->first_name.' '.$tenant->name}}</span>
            </div>
        </div>

        @endforeach
    </div>
</div>

@stop