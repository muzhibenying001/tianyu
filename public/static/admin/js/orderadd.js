$(function(){
	
	/*日期*/
	if( $('#date').val() ){
		$('#redate').html($('#date').val());
	}

	$('#date').bind('input propertychange' , function(){
		$('#redate').html( '￥' + $(this).val() );
	});
	/*副本*/
	$('#game').change(function(){
		$('#regame').html( $(this).find('option:selected').text() );
		$(this).removeClass('error');
		$('.select-box').eq(0).css({'border':'1px solid #ddd'});
	});
	/*总金额*/
	$('#total').bind('input propertychange' , function(){
		$('#retotal').html( '￥' + $(this).val() );
		$(this).removeClass('error');
	});
	/*总金额输入完毕 自动计算提成金额*/
	$('#total').blur(function(){

		if( $(this).val() && !isNaN( $(this).val() ) ){

			let tot = parseFloat( $(this).val() );
			let bonus = ( Math.floor( (tot * 0.1)*100 )) / 100;
			$('.bonusinfo input').eq(0).val( bonus );
			$('.rebonus').eq(0).html( '￥' + bonus );
		}else if( !$(this).val() ){
			$('.bonusinfo input').eq(0).val('');
			$('.rebonus').eq(0).html('￥ 0');
		}else if( isNaN( $(this).val() ) ){
			$(this).val(0);
			$('#retotal').html( '￥' + $(this).val() );
		}

	});

	$('#mySwitch').on('switch-change', function (e, data) {
    var $el = $(data.el) , value = data.value;
    	if(value){
    		$el[0].value = '未收';	
    	}else{
    		$el[0].value = '已收';    	
    	}
	});
	/*是否收款*/
	$('#re_receive').html( $('#is_receive').val()+'款' ).css({'color':'red'});

	$('#is_receive').change(function(){

		if ( $(this).val() == '未收' ) {

			$('#re_receive').html( $(this).val()+'款' ).css({'color':'red'});
		}else if( $(this).val() == '已收' ){

			$('#re_receive').html( $(this).val()+'款' ).css({'color':'skyblue'});
		}
	});
	/*单独check功能*/
	$('.mem-box').find(':checkbox').change(function(){
		/*获取check总数量*/
		let tot = $('.mem-box').find(':checkbox').length;

		let checked = $('.mem-box').find(':checkbox:checked').length;

		let status = tot == checked;

		$('#check-qx').prop('checked',status);
		if( status || checked > 0){
			$('#check-qk').prop('checked',false);
		}

		let checkval = $('.mem-box').find(':checkbox:checked').next().clone();

		$('#reperson').html(checkval);
		$('#remember').html(checkval.length);

		$('.skin-minimal').eq(1).css('border','1px solid #eee');

	});
	/*全选功能*/
	$('#check-qx').change(function(){
		$('.skin-minimal').eq(1).css({'border':'1px solid #eee'});
		if( $(this).prop('checked') ){
			$('.mem-box').find(':checkbox:visible').prop('checked',true);
			$('#check-qk').prop('checked',false);
			let checkval = $('.mem-box').find(':checkbox:checked').next().clone();
			$('#reperson').html(checkval);			
			$('#remember').html(checkval.length);			
		}else{			
			$('.mem-box').find(':checkbox').prop('checked',false);
			$('#check-qk').prop('checked',true);
			$('#remember').html('<span class="c-red"> * </span> 0');			
			$('#reperson').html('<span class="c-red"> * </span> 未选择');
		}

	});
	/*清空功能*/
	$('#check-qk').change(function(){
		if( $(this).prop('checked') ){
			$('.mem-box').find(':checkbox').prop('checked',false);
			$('#check-qx').prop('checked',false);
			$('#remember').html('<span class="c-red"> * </span> 0');
			$('#reperson').html('<span class="c-red"> * </span> 未选择');			
		}
	});

	/*提成金额显示*/
	$('form').on('input propertychange' , '.bonusinfo .bonus_price', function(){
		var data_number = $(this).closest('.bonusinfo').attr('data-number');
		$(this).attr('name','bonus['+data_number+']');
		$('.rebonus').eq(data_number).html( '￥' + $(this).val() );
	});
	/*提成人员*/
	$('form').on('change' , '.bonusinfo select', function(){
		var data_number = $(this).closest('.bonusinfo').attr('data-number');
		$(this).attr('name','bonus_info['+data_number+']');
		if( $(this).find('option:selected').val() == 'more' ){
			$(this).parent().replaceWith('<input class="bonus_input input-text" type="text" name="bonus_info['+data_number+']">');
		}else{

			$('.rebonus_info').eq(data_number).html( $(this).find('option:selected').text() );
		}
	});
	/*提成人员为手动填写*/
	$('form').on('input propertychange' , '.bonusinfo .bonus_input', function(){
		var data_number = $(this).closest('.bonusinfo').attr('data-number');
		$('.rebonus_info').eq(data_number).html( $(this).val() );
	});
	/*点击新增按钮*/
	$('#bonusbtn').click(function(){
		var data_number = $('.bonusinfo:visible').length;
		if( data_number >= 10 ) return;
		$('.bonusinfo').last().after($('.bonusinfo').eq(1).clone().show().attr('data-number', data_number));
		$('#rebonus').parent().append('<span data-number="' + data_number + '"> ,<i class="rebonus_info"> 无</i>  - <i class="rebonus">￥0 </i></span>');	
	});

	/*完成按钮*/
	$('#achievebtn').on('click',function(){
		/*表单验证*/
		let flog = true;
		let attention = '';
		/*副本下拉*/
		if( !$('#game').val() ){
			$('.select-box').eq(0).css({'border':'1px solid red'});
			$('#game').addClass('error');
			flog = false;
			attention += '<br> 没有选择副本！';
		}
		/*总金额*/
		if( !$('#total').val() || $('#total').val() == 0 ){
			$('#total').addClass('error');
			flog = false;
			attention += '<br>  没有填写总金额 ';
		}
		/*人数*/
		let checked = $('.mem-box').find(':checkbox:checked').length;
		if( checked == 0 ){
			$('.skin-minimal').eq(1).css('border','1px solid red');
			attention += '<br>  没有选择参与成员 ';
			flog = false;
		}
		/*提成*/
		if( $('.bonus_price').eq(0).val() && $('#bonusselect').val() == 0 ){
			$('.select-box').eq(1).css({'border':'1px solid red'});
			$('#bonusselect').addClass('error');
			attention += '<br>  没有选择提成人员 ';
			flog = false;
		}
		if( $('.bonus_price').val() == 0 ){
			$('.bonus_price').val(0);
			attention += '<br>  此单没有提成! ';
		}
		/*计算实收金额*/
		let bonus = 0;
		let realmoney = 0;
		let total = parseFloat( $('#total').val() );
		let remember = parseInt( $('#remember').html() );
		/*获取提成总额*/
		$('.bonus_price').each(function(i,v){
			
			if( i > 1 && ( $(v).val() == '' || $(v).val() == 0 ) ){
				let num = $(v).closest('.bonusinfo').attr('data-number');
				$(v).parent().parent().remove();
				$( 'span[data-number="'+num+'"]' ).remove();
			}
			if( isNaN( $(v).val() ) ){
				attention += '<br>  提成必须为数字 ';
				flog = false;
			}
			if( i != 1 && $(v).val() != 0 && $(v).val() != ''){
				bonus += parseFloat( $(v).val() );				
			}

		});
		if( bonus > total*0.1 ) attention += '<br>  提成超过10% ';
		realmoney = total - bonus;
		/*计算平均工资*/
		let average = ( Math.floor( (realmoney / remember) * 100 ) ) / 100;
		if( isNaN(realmoney) || isNaN(average) ){
			attention += '<br>  金额有问题，重新尝试并按正确格式填写！';
			flog = false;
		}
		if( !flog ){
			$('#attention').html(attention);
			return;
		}else{
			$('.leftapp :input').removeClass('error');
			$('.select-box').eq(1).css({'border':'1px solid #ddd'});
			$('.skin-minimal').eq(1).css('border','1px solid #ddd');
			$('.select-box').eq(0).css({'border':'1px solid #ddd'});
		}
		$('#attention').html(attention);
		/*将结果显示到右边*/
		$('#rerealmoney').val(realmoney);
		$('#resalary').val(average);
		/*生成提交按钮*/
		let html = '<div class="row cl"><div class="formControls col-xs-8 col-sm-6 col-xs-offset-4 col-sm-offset-4"><input class="btn btn-warning radius" type="button"  id="btnsub"  value="&nbsp;&nbsp;确认无误，提交&nbsp;&nbsp;">&nbsp;<input class="btn btn-default radius" type="button" value="&nbsp;&nbsp;重填&nbsp;&nbsp;"></div></div>';
		$('.reright').append(html);
		$(this).remove();
		$('.leftapp :input').attr('disabled',true);
		$('.leftapp :input').attr('readonly',true);
	});





});

