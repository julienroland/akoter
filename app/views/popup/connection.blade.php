<div class="popup connection" data-type="connection">
  <div class="contentPopup">
    <a href="" class="closePopup icon-remove11" tabindex="4" title="{{trans('connections.close')}}"></a>
    <div class="wrapper">
     <h3 aria-level="3" role="heading" class="titlePopup">{{trans('connections.connect_you')}}</h3>
     <p class="intro">
      {{trans('connections.intro')}}
    </p>
    <div class="connexion">
     <div class="loginSocial">
       <div class="facebook">
         <a href="{{route('fbConnect')}}" title="{{trans('connections.connection_title',array('name'=>'Facebook'))}}">
           <div class="logo">

           </div>
           <div class="text">
             <span>{{trans('connections.connection_with',array('name'=>'Facebook'))}}</span>
           </div>
         </a>
       </div>
       <div class="loginEmail">
       <span class="or">{{strtolower(trans('connections.or'))}}</span>
         {{Form::open(array('route'=>'connection','class'=>'mainType'))}}
         <div class="field">
           {{Form::label('email_co', trans('connections.your_field',array('name'=>'email')))}}
           <div class="input-email icon-arroba">
            {{Form::email('email_co', Cookie::has('login') ? Cookie::get('login')['email']: '',array('class'=>'form-email form-icon','required', 'placeholder'=>'email@email.com','autofocus'))}}
          </div>
        </div>
        <div class="field">
         {{Form::label('password_co', trans('connections.your_password',array('name','password')))}}
         <div class="input-password icon-lock24">
         <input id="password_co" type="password" name="password_co" placeholder="{{trans('form.password')}}" required class="form-password" autocomplete="off" value="{{Cookie::has('login') ? Cookie::get('login')['password']: ''}}">
        </div>
      </div>
      <div class="field">
        {{Form::checkbox('remember','true', isset(Cookie::get('login')['remember']) ? true: false,array('id'=>'remember'))}}  
        {{Form::label('remember', trans('connections.remember_me',array('name','password')))}}

      </div>
      <div class="field">
        {{Form::submit(trans('connections.connect'))}}
      </div>
      {{Form::close()}}
    </div>
    <p class="registerYou">{{trans('general.dont_have_account')}} <a href="{{route('inscription_index')}}">{{trans('general.register_you')}}</a></p>

  </div>

</div>
</div>
</div>
</div>