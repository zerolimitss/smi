
$(document).ready(function(){

	//получаем подкатегории в селект
	$('#admincat').change(function(){
		var id = $(this).val();
		$('#adminsubcat').attr('disabled', true);
		$('#adminsubcat').html('<option>загрузка...</option>');
		$.get(
			"lib/ajaxAdmin.php",
			{ id: id },
			function( data ) {
				var options = '';
				$(data).each(function() {
					options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('title') + '</option>';
				});

				$('#adminsubcat').html('<option value="0">- выберите подкатегорию -</option>'+options);
				$('#adminsubcat').attr('disabled', false);
			}, "json"

		);
	});

	//получаем подкатегории в селект при редактировании новости
	$('#admincat1').change(function(){
		var id = $(this).val();
		$('#adminsubcat').attr('disabled', true);
		$('#adminsubcat').html('<option>загрузка...</option>');
		$.get(
			"../../lib/ajaxAdmin.php",
			{ id: id },
			function( data ) {
				var options = '';
				$(data).each(function() {
					options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('title') + '</option>';
				});

				$('#adminsubcat').html('<option value="0">- выберите подкатегорию -</option>'+options);
				$('#adminsubcat').attr('disabled', false);
			}, "json"
		);
	});

	//проверка формы перед отправкой
	$('#action').submit(function(){
		var count = 0;
		if($('#head').val().length==0 || $('#head').val().length>255) {
			$('#head').css('border','1px solid red');
			count++;
		}
		if($('#text').val()=="") {
			$('#text').css('border','1px solid red');
			count++;
		}
		if($('#anons').val()=="" || $('#anons').val().length>255) {
			$('#anons').css('border','1px solid red');
			count++;
		}
		if($('#admincat :selected').val()==0) {
			$('#admincat').css('border','1px solid red');
			count++;
		}
		if($('#adminsubcat :selected').val()==0) {
			$('#adminsubcat').css('border','1px solid red');
			count++;
		}
		if($('#anons').val()=="") {
			$('#anons').css('border','1px solid red');
			count++;
		}
		if(count>0)
			return false;
	});

	//убираем красные поля если они изменены
	$(':input').change(function(){
		$(this).css('border','1px solid #A9A9A9');
	});

	//сразу закрашиваем поле если оно превышает предел
	$('#head').change(function(){
		if($(this).val().length>255){
			$(this).css('border','1px solid red');
		}
	});

	//сразу закрашиваем поле если оно превышает предел
	$('#anons').change(function(){
		if($(this).val().length>255){
			$(this).css('border','1px solid red');
		}
	})

	//переход в другую категорию
	$('#categoryNews').change(function(){
		var x = $('#categoryNews option:selected').val();
		var s = "http://web.hhos.ru/news/id/"+x;
		location.replace(s);
	})

	//действие при клике на кнопку формы назад
	$('.back').click(function(){
		history.back();
	});

	//были ли изменения при редактивровании категории
	var changes=0;
	$('#actioncategory').change(function(){
		changes++;
	});

	//проверка формы
	$('#actioncategory').submit(function(){
		if(changes==0){ //если изменений небыло то не отправлять форму
			$('#patterncat').css('border','1px solid red');
			$('#pos').css('border','1px solid red');
			return false;
		}
		var count = 0;
		if($('#patterncat').val().length==0 || $('#patterncat').val().length>20) {
			$('#patterncat').css('border','1px solid red');
			return false;
		}

	});

	//сразу закрашиваем поле если оно превышает предел
	$('#patterncat').change(function(){
		if($(this).val().length>13){
			$(this).css('border','1px solid red');
		}
	});

	//проверка формы
	$('#actionpage').submit(function(){
		if($('#head').val().length==0 || $('#head').val().length>20) {
			$('#head').css('border','1px solid red');
			return false;
		}

		if($('#text').val().length==0 ) {
			$('#text').css('border','1px solid red');
			return false;
		}

	});

});

