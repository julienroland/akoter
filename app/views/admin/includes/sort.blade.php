{{Form::open(array('method'=>'get','url'=>Route::current()->getUri()))}}

{{Form::bsearch('search','Rechercher par mots clefs',Input::has('search') ? Input::get('search'):'')}}
{{Form::bsubmit('Filtrer')}}
{{Form::close()}}