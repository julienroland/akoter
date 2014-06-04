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

    </ul>
    </div>
   <div class="typeLocationList">
    <ul>

    </ul>
  </div>
</div>
</div>