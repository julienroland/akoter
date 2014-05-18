;(function( $ ){

	var
	$form = $('form.rules'),
	$input = $('form.rules input:not([data-validator="false"],[autocomplete="off"],[type="submit"],[type="reset"])'),
	$showPassword = $('.showPassword'),
	sBasePath = '/',
	sOneRule,
	bValid = false
	;

	$(function(){

		$form.on('submit', validate );

		$input.keydown( validateOne );
		$input.keyup( validateOne );
		$input.focus( validateOne );

	});

	var validateOne = function( ){

		if(typeof sOneRule === "undefined"){

			sOneRule = JSON.parse($(this).parents('form.rules').attr('data-rules'));
		}

		var sName = $(this).attr('name');

		var sValue = $(this).val();

		if(sName.indexOf('[') > -1){

			sName = sName.substring(sName.lastIndexOf("[")+1,sName.lastIndexOf("]"))

		}

		var sRule = sOneRule[sName];

		var $that = $(this);

		if(sValue !== ""){

			if(sName ==="password-ck" || sName ==="password_ck"){

				sValue = $(this).val()+':'+$that.parents('form').find('input[name="password"]').val();
			}	
			if(sName==="email_bc"){

				sValue = $(this).val()+':'+$that.parents('form').find('input[name="email"]').val();
			}
			
		}
		if(sValue !==""){

			var sPath = sBasePath+'getOneValidation/' + sName + '/'+ sRule +'/'+ sValue;

		}else{

			var sPath = sBasePath+'getOneValidation/' + sName + '/'+ sRule;

		}
		console.log(sPath)
		$.ajax({

			url:sPath,
			dataType:'json',
			type:"post",
			success: function( oData ){

				if($.isPlainObject( oData)){

					var oError = oData;

					var sData = '';

					$that.find('input').removeClass('form-error').siblings('icon-required').removeClass('error').siblings('.clear').remove();

					$that.siblings('.messageError').remove();

					$.each(oError.field, function( key, value ){

						$that.addClass('form-error').siblings('icon-required').addClass('error');

					});

					for (var i in oError.message){

						if($that.next('.icon-required').length < 1){

							$that.after('<span class="'+ sName +' messageError">'+ oError.message[i] +'<span>');

						}else{

							$that.next('.icon-required').after('<div class="clear"></div><span class="'+ sName +' messageError">'+ oError.message[i] +'<span>');

						}

					}

				}else{

					$that.siblings('.messageError').remove();

					$that.removeClass('form-error').siblings('icon-required').addClass('error');
				}

			}

		});


	};

	var validate = function( e ){

		if(!bValid){

			e.preventDefault();
			$(this).find('input[type="submit"]').attr('disabled','disabled');

		}

		var $that = $(this);

		var sFields = $(this).serialize();

		var sRules = $that.attr('data-rules');

		$.ajax({
			url:sBasePath+'getValidation/' + sRules,
			dataType:'json',
			type:"post",
			data : sFields,
			success: function( oData ){

				if($.isPlainObject( oData)){

					bValid = false;

					var oError = oData;
					
					var sData = '';

					$that.find('input').removeClass('form-error').siblings('icon-required').removeClass('error');

					$.each(oError.fields, function( key, value ){

						$that.find('[name="'+key+'"]').addClass('form-error').siblings('icon-required').addClass('error');

					});


					for( var i in oError.messages){

						sData = sData + '<li class="error"> '+ oError.messages[i] +' </li>'
					}
					
					appendErrorsElements( $that , sData);

					$that.find('input[type="submit"]').removeAttr('disabled');
				}
				else{

					bValid = true;

					$that.submit();

				}
			}

		});


	};

	var appendErrorsElements = function( $form, sData ){

		$form.find('.errors').remove();

		$form.prepend('<div class="errors"><ul>'+ sData +'</ul></div>');	

		$('html,body').animate({ 
			scrollTop:$form.offset().top,
		}, 300);
	};

}).call(this, jQuery);