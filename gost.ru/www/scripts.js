$(document).ready(function(){

	var inProgress = false;
	var start = 10;

	$("#name2").show();
	$("#name1").show();

	$("#check").change(function(){
		var check = $("#check option:selected").val();
		switch(check){
			case "name" :
				$("#name2").show();
				$("#email2").hide();
				$("#date2").hide();
				$("#tegs2").hide();
				$("#name1").show();
				$("#email1").hide();
				$("#date1").hide();
				$("#tegs1").hide();
				break;
			case "email" :
				$("#name2").hide();
				$("#email2").show();
				$("#date2").hide();
				$("#tegs2").hide();
				$("#name1").hide();
				$("#email1").show();
				$("#date1").hide();
				$("#tegs1").hide();
				break;
			case "date" :
				$("#name2").hide();
				$("#email2").hide();
				$("#date2").show();
				$("#tegs2").hide();
				$("#name1").hide();
				$("#email1").hide();
				$("#date1").show();
				$("#tegs1").hide();
				break;
			case "tegs" :
				$("#name2").hide();
				$("#email2").hide();
				$("#date2").hide();
				$("#tegs2").show();
				$("#name1").hide();
				$("#email1").hide();
				$("#date1").hide();
				$("#tegs1").show();
				break;
		}
	})


	$('.submit').click(function(){

		var name = $('#name').val();
		var email = $('#email').val();
		var tegs = $('#tegs').val();
		var message = $('#textarea').val();
		var date = $('#date').val();
		var captcha = $('#captcha').val();
		if(name==' ' || email==' ' || tegs==' ' || message==' ' || captcha==' ' || name=='' || email=='' || tegs=='' || message=='' || captcha==''){
			alert("Заполните все поля");
		}else{
		if(!inProgress){

		$.ajax({

			url: 'comment.php',
			type: 'POST',
			dataType: 'json',
			data: {name: name, email: email, tegs: tegs, message: message, date: date, captcha: captcha},
			beforeSend: function(){
				inProgress = true;
			},
			success: function(data){
				if(data!="captcha введена неверно"){
				$('table').prepend('<tr><td class="name"><b>'+ data.name +'</b><br/>'+ data.email +'</td><td class="message"><b>'+ data.tegs +'</b><br/><br/>'+ data.message +'</td><td class="date">'+ data.dateT +'</td></tr>');
				}else{
					alert("captcha введена неверно");
				}
			},error: function(xhr, status, error) {
  		  alert("captcha введена неверно");
				}
		});

		//$('form').append('<div class="message" id="articles"><p><b>' + name + '</b><br /><p>' + email + '</p><br /><p>' + message + '</p><br />');
		var name = $('#name').val('');
		var email = $('#email').val('');
		var tegs = $('#tegs').val('');
		var message = $('#textarea').val('');
		var date = $('#date').val('');
		var ip = $('#ip').val('');
		var browser = $('#browser').val('');
		inProgress = false;
	}
}
	})

	

})