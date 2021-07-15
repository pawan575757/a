$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});

$(document).on('submit','form',function(){

	error=[];
	current_form=$(this);
	current_form.find('.required').each(function(k,v){
		if(!$(this).val())
		{
			error.push('false');
			$(this).css('border','1px solid red');

		}
	})

	if(error.indexOf('false')==-1)
	{  
		return true;
	}else{
		return false;
	}

})

$(document).on('change','.sdate',function(){
    $('.formsearch_date').submit();
});
/*==========  onkeypress   =======*/
$(document).on('keypress change','.required',function(){
	var value=$(this).val();
	if(value)
	{
		$(this).css('border','');
	}
})

$(document).on('keypress','.chkchr',function(event){

	var element=$(this);
	var charpattern = /^[A-Za-z\s]+$/i ;          
	var field_value=String.fromCharCode(event.which); 


	if(event.which == 0 || event.which == 8 || event.which == 9 || event.which == 39 || charpattern.test(field_value))
	{     
		$(element).css('border','');
		return true;
	}else{
		$(element).css('border','1px solid red');
		return false;
	}


}); 

/*==========  onchange   =======*/
$(document).on('keypress','.chkint',function(event){
	var element=$(this);
	var charpattern = /^[0-9\s]+$/i ;          
	var field_value=String.fromCharCode(event.which); 
	if(event.which == 0 || event.which == 8 || event.which == 9 || event.which == 39 || charpattern.test(field_value))
	{     
		$(element).css('border','');
		return true;
	}else{
		$(element).css('border','1px solid red');
		return false;
	}
});



$(document).on('click','.blockroom',function(){
	
	click_first=$(this);
	cval=click_first.data('one'); 
	room_set=click_first.parent('.action_btn').siblings('.room_set').html();
	

	$('#blocking_roompop').modal();
	$('#blocking_roompop').find('input[name="id"]').val(cval);
	$('#blocking_roompop').find('input[name="room_set"]').val(room_set);

})

$(document).on('click','.unblockroom-list',function(){
	
	click_first=$(this);
    /*sel_chkbox =[];
	
	$('.checking:checked').each(function(k,v){
		var cval=$(this).val();
		sel_chkbox.push(cval);
	})*/

	$('.chk_btnclick').val('unblock_room');
	$('#lform').submit();

})






// change password
$(document).on('submit','form[name="change_pwd_form"]',function(event){
	event.preventDefault();
	required_fields=[];
	var click_first =$(this);
	form=$(click_first).closest('form');
	var required =$(form).find('.required');
	required.each(function(k,v){
		var val =$(this).val();
		if(!val)
		{
			$(this).css('border','1px solid red');
			required_fields.push('false'); 

		}

	});
	var chk=required_fields.indexOf('false');
	if(chk==-1)
	{
		var form_value=$(this).serialize();
		$.ajax({
			type:'post',
			url: "jquery.php",
			data:form_value,
			dataType: "json",
			success:function(response)
			{  

				status=response['status']
				if(status.trim()=='success')
				{ 
					$(form).find('#change_pwd_msg').css('display','block');
					$(form).find('#change_pwd_msg').html('success ! Password changed');
				}else{
					$(response['key']).each(function(k,v){

						$(form).find('input[name="'+v['key']+'"]').attr('data-original-title',v['msg']);
						$(form).find('input[name="'+v['key']+'"]').css('border','1px solid red');


					})
				}
			}
		})	
	}

	return false;


})  

$(document).on('dblclick','.chng_pwd',function(){
	click_element=$(this);
	var chk =confirm('Are you sure to password change ?');
	if(chk)
	{ 
		var html='<input type="hidden" name="change_pwd" value="yes">';
		click_element.val('');
		click_element.attr("readonly",false);
		click_element.closest('form').find('.pwd_change').html(html);
	}
})

$(document).on('dblclick','.del_doc',function(){
	click_element=$(this);
	data=click_element.data('one');
	if(data)
	{

		$.ajax({
			type:'post',
			url: "jquery.php",
			data:{id:data,submit:'del_doc'},
			dataType: "json",
			success:function(response)
			{   
				console.log(response.status);

				if(response.status==true)
				{
					console.log('call');
					click_element.siblings('a').remove();
					click_element.remove();	
				}
			}
		})
	}
})



// checking  or unchecking all
$(".chk_all").on("ifChecked", function(){  
	click_chk =$(this).prop('checked');
	$('.checking').iCheck('check');
});


$(".chk_all").on("ifUnchecked", function(){  
	click_chk =$(this).prop('checked');
	$('.checking').iCheck('uncheck');
});

// click active in active
$('.active-list').click(function(){
	$('.chk_btnclick').val('active');
	$('#lform').submit();
})
$('.inactive-list').click(function(){
	$('.chk_btnclick').val('inactive');
	$('#lform').submit();
})

