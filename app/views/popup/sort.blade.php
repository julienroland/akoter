
<div class="short">

	<div class="wrapper">

		{{Form::open(array('method'=>'get','route'=>'listLocation','class'=>'mainType','id'=>'filterKot'))}}
		<a href="" class="clearAll">{{trans('form.clearAll')}}</a>
		
		
		<div class="baseShort">
			
			<div class="group label">
				<div class="typeLocation">
					{{Form::label('typeLocation', trans('form.typeLocation'))}}
					<div class="field">
						{{Form::select('typeLocation',$typeLocation, isset(Session::get('filter')['typeLocation']) ? Session::get('filter')['typeLocation'] : '' ,array('class'=>'select','data-placeholder'=>trans('form.typeLocation')))}}
					</div>
				</div>
			</div>	
			<div class="group price">
				<span class="label">{{trans('form.pricing')}}</span>
				<div class="field">
					{{Form::label('min_price', trans('form.price_min'),array('aria-hidden'=>'false'))}}
					<div class="input-price">
						{{Form::input('number','min_price', isset(Session::get('filter')['min_price']) ? Session::get('filter')['min_price'] : '' ,array('min'=>'100','title'=>trans('form.price_min'),'max'=>'1500','step'=>'5','placeholder'=>trans('form.min')))}}
					</div>
				</div>
				<span class="icon icon-map25"></span>
				<div class="field">
					{{Form::label('max_price', trans('form.price_max'), array('aria-hidden'=>'false'))}}
					<div class="input-price">
						{{Form::input('number','max_price',isset(Session::get('filter')['max_price']) ? Session::get('filter')['max_price'] : '' ,array('min'=>'100','title'=>trans('form.price_min'),'max'=>'1000','step'=>'5','placeholder'=>trans('form.max')))}}
					</div>
				</div>
			</div>
			<div class="group date">
				<span class="label">{{trans('form.date')}}</span>
				<div class="field">
					{{Form::label('start_date', trans('form.start_date'),array('aria-hidden'=>'false'))}}

					{{Form::text('start_date',isset(Session::get('filter')['start_date']) ? Session::get('filter')['start_date'] : '' ,array('class'=>'datepicker','title'=>trans('form.start_date'),'placeholder'=>trans('form.start_date2')))}}

				</div>
				<div class="field">
					{{Form::label('end_date', trans('form.end_date'),array('aria-hidden'=>'false'))}}
					<div class="input-date">
						{{Form::text('end_date',isset(Session::get('filter')['end_date']) ? Session::get('filter')['end_date'] : '' ,array('class'=>'datepicker','title'=>trans('form.end_date'),'placeholder'=>trans('form.end_date2')))}}
					</div>
				</div>
			</div>
			<div class="group label charge">
					<span class="label">{{trans('form.charge')}}</span>
					<div class="field">
						{{Form::select('charge', Config::get('var.charges'),isset(Session::get('filter')['charge']) ? Session::get('filter')['charge'] : '' , array('class'=>'select selectCharge','data-placeholder'=>trans('form.charge')))}}
					</div>
					<!--<div class="field">
						<div class="input-price">
							{{Form::input('number','price_charge',isset(Session::get('filter')['price_charge']) ? Session::get('filter')['price_charge'] : '' ,array('id'=>'input-chargePrice','placeholder'=>trans('form.pricing')) )}}
						</div>
					</div>-->	
				</div>

				<div class="group label">
					{{Form::label('size',trans('form.superficy'))}}
					<div class="input-size">
						{{Form::input('number','size',isset(Session::get('filter')['size']) ? Session::get('filter')['size'] : '' ,array('placeholder'=>trans('form.superficy'),'title'=>trans('form.superficy')))}}
					</div>
				</div>

				
				<div class="group label particularity">
					<span class="label">{{trans('form.particularity')}}</span>
					<div class="field">

						@foreach($particularity  as $key => $value )

						{{Form::checkbox('particularity['.$key.']','true',isset(Session::get('filter')['particularity['.$key.']']) ? true : false , array('title'=>$value,'id'=>'particularity['.$key.']'))}}
						{{Form::label('particularity['.$key.']',' ',array('title'=>$value,'class'=>Helpers::toSlug($value).' spe'))}}

						@endforeach

					</div>
				</div>

			{{Form::hidden('filter','true')}}
			{{Form::hidden('listKot',isset($listKot) ? $listKot : '')}}
			<div class="group">

				<div class="field">
					{{Form::submit(trans('form.filter'))}}
				</div>
				
			</div>	
			{{Form::close()}}

		</div>
		
	

	</div>

</div>
