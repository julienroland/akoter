<div class="mapManage">
  <div class="switchView">
      <a  class="researchBtn" href="">{{ucfirst(trans('form.search'))}}</a>
      <a class="ListingBtn active" href="">{{trans('form.listing')}}</a>
    </div>
  <div class="research">
    <div class="text">
      <h3 aria-level="3" role="heading" class="title">{{trans('general.how_work')}}</h3>
      <!--ajouter dans page cms-->
      <p>
        Vous pouvez indiquer une <strong>localitée</strong> dans le formulaire et paramétrer la largeur du filtre. 

        Vous pouvez également cliquer sur les <strong>icônes</strong> de la carte pour cibler une location.

        Vous pouvez également <strong>lister</strong> tous les <strong>kots</strong> en cliquant sur le bouton juste en dessous.
      </p>
    </div>

    {{Form::submit(ucfirst(trans('form.search')),array('class'=>'bigSubmit','tabindex'=>'6'))}}
  </div>
  <div class="oneBuilding">

  
    <div class="slider">
    <ul class="rslides" id="slider">
      <li><img src="http://placehold.it/300x150" alt=""></li>
      <li><img src="http://placehold.it/200x100" alt=""></li>
      <li><img src="http://placehold.it/250x120" alt=""></li>
    </ul>
    </div>
    <ul id="slider-pager">
      <li>
        <a href="#">
         <img src="http://placehold.it/50x30" alt="">
       </a>
     </li>
      <li>
        <a href="#">
         <img src="http://placehold.it/50x30" alt="">
       </a>
     </li>
      <li>
        <a href="#">
         <img src="http://placehold.it/50x30" alt="">
       </a>
     </li>
   </ul>
   <div class="typeLocationList">
    <ul>
      <li>
        <a href="javascript:void()">
          <div class="type">
            <img src="http://placehold.it/100x50" alt="">
            <span class="number">
              3
            </span>
          </div>
          <div class="price">
            <span class="cheap">300€</span>/<span class="expensive">300€</span>
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:void()">
          <div class="type">
            <img src="http://placehold.it/100x50" alt="">
            <span class="number">
              3
            </span>
          </div>
          <div class="price">
            <span class="cheap">300€</span>/<span class="expensive">300€</span>
          </div>
        </a>
        <div class="oneLocation">
          <ul>
            <li>
              <a href="">
                <div class="infosLocation">
                  <img src="http://placehold.it/50x30" alt="">
                  <div class="priceOne">
                    200€
                  </div>
                </div>
                <span class="btn-one" href="">{{trans('general.see')}}</span>
              </a>
            </li> 
          </ul>
        </div>
      </li>

    </ul>
  </div>
</div>
</div>