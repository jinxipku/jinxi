function chooseUniversity(){
	$('#school').attr('disabled', true);
	$("#choose_school").modal();
	initProvince();
	$('[province-id="1"]').addClass('choosen');
	initSchool(1);
}

function initProvince(){
	
	//原先的省份列表清空
	$('#choose-a-province').html('');
	
	for(i=0;i<schoolList.length;i++){
		$('#choose-a-province').append('<a href="javascript:void(0);" class="province-item" province-id="'+schoolList[i].id+'">'+schoolList[i].name+'</a>');
	}
	
	//添加省份列表项的click事件
	$('.province-item').bind('click',function(){
		var item=$(this);
		var province = item.attr('province-id');
		var choosenItem = item.parent().find('.choosen');
		if(choosenItem)
		$(choosenItem).removeClass('choosen');
		item.addClass('choosen');
		
		//更新大学列表
		initSchool(province);
	});
}

function initSchool(provinceID){

	//原先的学校列表清空
	$('#choose-a-school').html('');
	var schools = schoolList[provinceID-1].school;
	for(i=0;i<schools.length;i++){
		$('#choose-a-school').append('<a href="javascript:void(0);" class="school-item" school-id="'+schools[i].id+'" surfix="'+schools[i].surfix+'">'+schools[i].name+'</a>');
	}
	
	//添加大学列表项的click事件
	$('.school-item').bind('click', function(){
		var item=$(this);
		var school = item.attr('school-id');
		var surfix = item.attr('surfix');
		var nomail = item.attr('nomail');

		//更新选择大学文本框中的值
		$("#school").val(item.text());
		$("#school_id").val(school);
		if (surfix != 'undefined') {
			$("#email").css('width','180px');
			$("#email").css('display','inline');
			$("#email_surfix").text(surfix);
		} else {
			$("#email").css('width','300px');
			$("#email").css('display','block');
			$("#email_surfix").text("");
		}
		if (nomail != 'undefined') {
			$('#nomail').val(1);
		} else {
			$('#nomail').val(0);
		}

		//关闭弹窗
		$("#chooseover").click();
	});
}