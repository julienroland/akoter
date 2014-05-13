<div class="sortmenu small baseShort">
	<div class="wrapper">
	<div class="row">
		{{Form::open(array('method'=>'get','route'=>'listLocation','class'=>'mainType','id'=>'filterKot'))}}
		<div class="formSearch">
			<div class="searchBar">
			<div class="input-search icon-magnifier10">
				<input type="search" value="" name="search" placeholder="{{trans('form.search_location_keywords')}}">
				</div>
			</div>
			<div class="fieldsSearch">
				<span class="title">{{trans('form.filterBy')}}:</span>
				<ul class="filterType">
					<li class="type filterItem">
						<a href="javascript:void(0)" >{{trans('form.typeLocation')}}</a>
						<div class="alertbox">
							<div class="formSelect">
								{{Form::label('typeLocation', trans('form.typeLocation'))}}

								{{Form::select('typeLocation',$typeLocation, isset($input['typeLocation']) ? $input['typeLocation'] :(isset(Session::get('filter')['typeLocation']) ? Session::get('filter')['typeLocation'] : '') ,array('class'=>'select','data-placeholder'=>trans('form.typeLocation')))}}

							</div>
							<div class="formActions">
								<a href="" class="btn submit">{{trans('form.order')}}</a>
								<a href="" class="goOn">{{trans('form.continue')}}</a>
							</div>
						</div>
					</li>
					<li class="price filterItem"><a href="javascript:void(0)">{{trans('form.pricing')}}</a>
						<div class="alertbox">
							<div class="formSelect">
								<div class="group price">
									<div class="field">
										{{Form::label('min_price', trans('form.price_min'),array('aria-hidden'=>'false'))}}
										<div class="input-price">
											{{Form::input('number','min_price', isset($input['min_price']) ? $input['min_price'] :(isset(Session::get('filter')['min_price']) ? Session::get('filter')['min_price'] : '' ),array('min'=>'100','title'=>trans('form.price_min'),'max'=>'1500','step'=>'5','placeholder'=>trans('form.min')))}}
										</div>
									</div>
									<div class="field">
										{{Form::label('max_price', trans('form.price_max'), array('aria-hidden'=>'false'))}}
										<div class="input-price">
											{{Form::input('number','max_price',isset($input['max_price']) ? $input['max_price'] : (isset(Session::get('filter')['max_price']) ? Session::get('filter')['max_price'] : '') ,array('min'=>'100','title'=>trans('form.price_min'),'max'=>'1000','step'=>'5','placeholder'=>trans('form.max')))}}
										</div>
									</div>
								</div>

							</div>
							<div class="formActions">
								<a href="" class="btn submit">{{trans('form.order')}}</a>
								<a href="" class="goOn btn-basic">{{trans('form.continue')}}</a>
							</div>
						</div>
					</li>
					<li class="date filterItem"><a href="javascript:void(0)">{{trans('form.dates')}}</a>
						<div class="alertbox">
							<div class="formSelect">
								<div class="group date">
									<div class="field">
										{{Form::label('start_date', trans('form.start_date'),array('aria-hidden'=>'false'))}}
										<div class="input-date">
											{{Form::text('start_date',isset($input['start_date']) ? $input['start_date'] :(isset(Session::get('filter')['start_date']) ? Session::get('filter')['start_date'] : '') ,array('class'=>'datepicker','title'=>trans('form.start_date'),'placeholder'=>trans('form.start_date2')))}}
										</div>
									</div>
									<div class="field">
										{{Form::label('end_date', trans('form.end_date'),array('aria-hidden'=>'false'))}}
										<div class="input-date">
											{{Form::text('end_date',isset($input['end_date']) ? $input['end_date'] : (isset(Session::get('filter')['end_date']) ? Session::get('filter')['end_date'] : '') ,array('class'=>'datepicker','title'=>trans('form.end_date'),'placeholder'=>trans('form.end_date2')))}}
										</div>
									</div>
								</div>
							</div>
							<div class="formActions">
								<a href="" class="btn submit">{{trans('form.order')}}</a>
								<a href="" class="goOn btn-basic">{{trans('form.continue')}}</a>
							</div>
						</div>
					</li>
					<li class="charge filterItem"><a href="javascript:void(0)">{{trans('form.charges')}}</a>
						<div class="alertbox">
							<div class="formSelect">
								<div class="group charge">
									<div class="field">
										{{Form::select('charge', Config::get('var.charges'),isset($input['charge']) ? $input['min_price'] :(isset(Session::get('filter')['charge']) ? Session::get('filter')['charge'] : '') , array('class'=>'select selectCharge','data-placeholder'=>trans('form.charge')))}}
									</div>
									<div class="field">
										<div class="input-price">
											{{Form::input('number','price_charge',isset($input['price_charge']) ? $input['price_charge']:(isset(Session::get('filter')['price_charge']) ? Session::get('filter')['price_charge'] : '') ,array('id'=>'input-chargePrice','placeholder'=>trans('form.pricing')) )}}
										</div>
									</div>
								</div>
							</div>
							<div class="formActions">
								<a href="" class="btn submit">{{trans('form.order')}}</a>
								<a href="" class="goOn btn-basic">{{trans('form.continue')}}</a>
							</div>
						</div>
					</li>
					<li class="size filterItem"><a href="javascript:void(0)">{{trans('form.superficy')}}</a>
						<div class="alertbox">
							<div class="formSelect">
								<div class="input-size icon-meter2">
									{{Form::input('number','size',isset($input['size']) ? $input['size'] :(isset(Session::get('filter')['size']) ? Session::get('filter')['size'] : '') ,array('min'=>'5','title'=>trans('form.size'),'max'=>'10000','step'=>'5','placeholder'=>trans('form.min')))}}
								</div>
							</div>
							<div class="formActions">
								<a href="" class="btn submit">{{trans('form.order')}}</a>
								<a href="" class="goOn btn-basic">{{trans('form.continue')}}</a>
							</div>
						</div>
					</li>

					<li class="filterItem particularity"><a href="javascript:void(0)">{{trans('form.particularity')}}</a>
						<div class="alertbox">
							<div class="formSelect">
								<div class="group label particularity">
									<div class="field">

										@foreach($particularity  as $key => $value )

										{{Form::checkbox('particularity['.$key.']',$key,isset($input['particularity'][$key]) ? true :(isset(Session::get('filter')['particularity['.$key.']']) ? true : false ), array('title'=>$value->value,'id'=>'particularity['.$key.']'))}}
										{{Form::label('particularity['.$key.']',' ',array('title'=>$value->value,'class'=>$value->icon.' spe'))}}

										@endforeach

									</div>
								</div> 
							</div>
							<div class="formActions">
								<a href="" class="btn submit">{{trans('form.order')}}</a>
								<a href="" class="goOn btn-basic">{{trans('form.continue')}}</a>
							</div>
						</li>
					</ul>

					<div class="left orderBy"><span class="title">{{trans('form.order')}} par: </span>{{Form::select('classify',Config::get('var.filter'),isset($input['classify']) ? $input['classify'] : (isset(Session::get('filter')['classify']) ? Session::get('filter')['classify'] :''),array('class'=>'classify'))}}</div>
				</div>
			</div>
			<div class="searchSubmit">
			{{Form::submit(trans('form.search'))}}
			<div class="pannel">
				<a href="javascript:void(0)" class="toogleMap">{{trans('general.carte')}}</a>
				<a href="javascript:void(0)" class="toogleList active">{{trans('general.list')}}</a>
			</div>
			<!-- <button class="clearAll btn">{{trans('form.clearAll')}}</button> -->
		</div>
		</div>
		
		{{Form::hidden('filter','true')}}
		{{Form::hidden('city',Input::has('city') ? Input::get('city') :'')}}
		{{Form::hidden('listKot',Input::has('listKot') ? Input::get('listKot') :'')}}
		{{Form::close()}}
		</div>
	</div>