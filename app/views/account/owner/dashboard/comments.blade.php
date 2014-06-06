@extends('account.owner.dashboard.layout')

@section('dashboard')

<div class="comments_location">
    <div class="comments">
        <?php $i=0; ?>
        @foreach($comments as $comment)
        <?php $translation = $comment->translation->lists('value','key'); ?>

        <div class="comment {{$i !== 0 && $i%2 != 0 ? 'striped' : ''}}">
            <div class="user vcard" id="hcard-{{$comment->user->first_name}}-{{$comment->user->name}}">
                <div class="photo">
                    @if(Helpers::isOk($comment->user->photo))
                    <img class="thumbnail" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$comment->user->id.'/'.Config::get('var.profile_dir').$comment->user->photo}}" >
                    @else
                    @if(Auth::user()->civility == 0)

                    <img class="thumbnail" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserM')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">

                    @else 

                    <img class="thumbnail" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserF')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
                    @endif
                    @endif
                </div>
                <span class="fn n name"><span class="given-name">{{$comment->user->first_name}}</span> <span class="family-name">{{$comment->user->name}}</span></span>
                <a class="email section" href="mailto:{{$comment->user->email}}">{{$comment->user->email}}</a>
                <div class="adr section">
                    <div class="street-address">{{$comment->user->address}}</div>
                    <span class="locality">{{$comment->user->locality}}</span>

                    <span class="region">{{$comment->user->region->translation[0]->value}}</span>

                    <span class="postal-code">{{$comment->user->postal}}</span>

                </div>

            </div>
            <span class="date">{{trans('locations.comment_publish',array('date'=>Helpers::beTime($comment->created_at)))}}</span>
            <div class="icons rating" >
                <span class="section">{{Helpers::getRating($comment->rating)}} {{Lang::get('locations.stars')}}</span>
                <span class="icon {{Helpers::isStar( 1, $comment->rating )}} " aria-hidden="true"></span>
                <span class="icon {{Helpers::isStar( 2, $comment->rating )}}" aria-hidden="true"></span>
                <span class="icon {{Helpers::isStar( 3, $comment->rating )}}" aria-hidden="true"></span>
                <span class="icon {{Helpers::isStar( 4, $comment->rating )}}" aria-hidden="true"></span>
                <span class="icon {{Helpers::isStar( 5, $comment->rating )}}" aria-hidden="true"></span>
            </div>
            <span class="title">{{$translation['title']}}</span>
            <p>
                {{$translation['text']}}
            </p>
            <div class="actions">
                @if($comment->validate == 1)
                <div class="desactivate">

                    <a href="{{route('dashboard_desactiveComment', array(Auth::user()->slug, $location->id,$comment->id))}}" class="icon icon-nope tooltip-ui-w" title="{{trans('dashboard.desactivateComment')}}"></a>

                </div>
                @else
                <div class="activate">

                    <a href="{{route('dashboard_activeComment', array(Auth::user()->slug, $location->id, $comment->id))}}" class="icon icon-approve tooltip-ui-w" title="{{trans('dashboard.activateComment')}}"></a>

                </div>
                @endif
                <div class="delete">

                  <a href="{{route('dashboard_deleteComment', array(Auth::user()->slug, $location->id, $comment->id))}}" class="icon icon-remove11 tooltip-ui-w" title="{{trans('dashboard.deleteComment')}}"></a>

              </div>

          </div>

      </div>
      <?php $i++; ?>
      @endforeach
  </div>

</div>            
@stop