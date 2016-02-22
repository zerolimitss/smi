
$(document).ready(function(){

	function curdt(){
		var date = new Date();

		// определяем массив для месяцев
		var month=new Array(12);
		month[0]="ЯНВАРЯ";
		month[1]="ФЕВРАЛЯ";
		month[2]="МАРТА";
		month[3]="АПРЕЛЯ";
		month[4]="МАЯ";
		month[5]="ИЮНЯ";
		month[6]="ИЮЛЯ";
		month[7]="АВГУСТА";
		month[8]="СЕНТЯБРЯ";
		month[9]="ОКТЯБРЯ";
		month[10]="НОЯБРЯ";
		month[11]="ДЕКАБРЯ";


		var dayWeek=new Array(7);
		dayWeek[0]="ВОСКРЕСЕНЬЕ";
		dayWeek[1]="ПОНЕДЕЛЬНИК";
		dayWeek[2]="ВТОРНИК";
		dayWeek[3]="СРЕДА";
		dayWeek[4]="ЧЕТВЕРГ";
		dayWeek[5]="ПЯТНИЦА";
		dayWeek[6]="СУББОТА";

		var year = date.getFullYear();
		var mon = month[date.getMonth()];
		var day = dayWeek[date.getDay()];
		var hour = date.getHours();
		if(hour<10){
			hour = 0+''+hour;
		}
		var minutes = date.getMinutes();
		if(minutes<10){
			minutes=0+''+minutes;
		}
		var sec = date.getSeconds();
		if(sec<10){
			sec=0+''+sec;
		}

		var res = date.getDate()+' '+mon+' '+year+', '+day+', '+hour+':'+
			minutes+':'+sec;

		return res;
	}

	$('#date').text(curdt());

	setInterval(function(){

		var res = curdt();

		$('#date').text(res);
	},1000)

	$('#categoryArchive').change(function(){
		var x = $('#categoryArchive option:selected').val();
		//alert(x);
		var s = "http://web.hhos.ru/archive/id/"+x;
		location.replace(s);
	})

	$('.search').submit(function(){
		var x = $('.stxt').val().length;

		if(x<4) {
			$('.search').css({'border':'1px solid red'});
			$('.errorm').html("Минимум 4 символа");
			return false;
		}
	})

	$('.search1').submit(function(){
		var x = $('.stxt1').val().length;

		if(x<4) {
			$('.stxt1').css({'border':'1px solid red'});
			$('.errorm1').html("Минимум 4 символа");
			return false;
		}
	})


});

