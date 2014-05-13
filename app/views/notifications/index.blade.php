 <div class="errorsNotifications "><!--.noError-->
  <div class="tab">
    <a href="">
      <span class="icon icon-map25"></span>
      <div class="newNumber"><span class="number">0</span></div>
    </a>
  </div>
  <div class="content">
    <div class="wrapper">
      <div class="head">
        <span role="heading" class="titleMessageError"><span class="numberTitle">0</span> problème(s) rencontré(s)</span>
      </div>
      <ul class="list">

        @if(isset($globalErrors) )
        
        <li class="notSee"><a href=""><div class="iconError"><img src="img/reseaux/fb.jpg" alt="Erreur sur les annonces"></div><span class="textError">{{$globalErrors->errors}}</span></a></li>
        @endif
      </ul>
    </div>
  </div>
</div>