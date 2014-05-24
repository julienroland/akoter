@extends('admin.layout.layout')

@section('container')
<div class="jumbotron">
	<div class="hero">
		<div class="wrapper">

			<h2 aria-level="2" role="heading" >Contactez un utilisateur par rapport à son bâtiment</h2>
	
		</div>
	</div>
	<div class=" formContainer large">
		
		@include('includes.success')
		@include('includes.errors')

		{{Form::open(array('url'=>array('admin/building/sendMessage', $building->id, $user->id),'class'=>'mainType rules','data-rules'=>json_encode(array('name'=>'required | alpha', 'email'=>'email | required','text'=>'required'))))}}
		
		<div class="form-group form-group-lg">

			<p><b>Destinataire:</b> {{$user->first_name. ' ' .$user->name}} < {{$user->email}} ></p>
			
		</div>
		<div class="form-group form-group-lg">
			<label for="subject">Sujet *</label>
			<input type="text" value="Votre annonce n°: {{$building->id}} sur Akoter" name="subject"  class="form-control" id="subject" />
		</div>
		
		<div class="form-group form-group-lg">
			<label for="text">Message *</label>
			<textarea name="text" class="editor form-control" id="text" >Bonjour {{$user->first_name.' '.$user->name}},<br>
			Nous vous contactons au sujet de votre annonce n°:{{$building->id}} posté sur notre site Akoter.
			</textarea>
		</div>

		<div class="form-group">
			<label for="translate">Traduire dans sa langue ?</label>
			<input type="checkbox" name="translate" id="translate">
		</div>
		<div class="form-group form-group-lg ">
			{{Form::submit('Envoyer',array('class'=>'btn btn-primary large'))}}
		</div>
		{{Form::close()}}
	</div>

</div>

@stop