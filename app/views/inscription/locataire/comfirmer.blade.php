@extends('layout')

@section('container')

<ul>
	<li>{{link_to_route('inscriptionLocataire','etape1')}}</li>

</ul>
<?php var_dump(Session::get('infosCompte'))	; ?>
<p>
	{{('Merci de votre inscription, veuillez prendre conscience des ')}}
	{{link_to_route('cgu','conditions général')}}
	{{('Un mail vous serra envoyé à l\'adresse suivante :')}}
</p>
	{{Form::open(array('url'=>'inscription/locataire/valider'))}}

	{{Form::submit('J\'ai pris conscience et je valide mon inscription')}}
	{{(link_to_route('showIndex','J\'annule mon inscription'))}}
	{{Form::close()}}

@stop