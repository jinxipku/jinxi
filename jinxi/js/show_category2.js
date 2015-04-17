function show_category2(category1, first) {
	var baseurl = "http://www.xn--wmqr18c.cn/";
	var classstart = [ 0, 0, 11, 16, 21, 27, 41, 46, 51 ];
	var classend = [ 0, 10, 15, 20, 26, 40, 45, 50, 51 ];
	var allclass = [ "手机", // 0
	"数码相机", "电子词典", "数码录音笔", "电子书", "耳机", // 5
	"移动硬盘", "笔记本", "平板", "电脑配件", "其他", // 10
	"小家电", "居家小物", "杯壶", "个人乐器", "其他", // 15
	"男装", "女装", "配饰", "箱包", "其他", // 20
	"自行车", "瑜伽垫", "护具", "球类", "泳衣泳镜", // 25
	"其他", "公共课", "计算机", "经济管理", "工科技术", // 30
	"语言学习", "教育考试", "人文社科", "艺术生活", "文学小说", // 35
	"法律政治", "医学卫生", "原版小说", "工具书", "其他", // 40
	"大陆", "港台", "欧美", "日韩", "其他", // 45
	"面部护理", "面部彩妆", "身体护理", "护肤工具", "其他",  // 50
	"其他"
	];
	$("#btng_category1 li:eq(" + category1 + ") a").tab('show');
	var ul = $("<ul></ul>");
	ul.addClass("nav nav-pills");
	var li = $("<li></li>");
	if ($("#category2").val() == -1)
		li.addClass("active");
	var a = $("<a></a>");
	a.attr('href', baseurl + 'display/' + $("#type").val() + "/" + $("#area").val() + "/" + category1);
	a.text("全部");
	li.append(a);
	ul.append(li);
	for ( var i = classstart[category1]; i <= classend[category1]; i++) {
		var li = $("<li></li>");
		if (i == $("#category2").val())
			li.addClass("active");
		var a = $("<a></a>");
		a.attr('href', baseurl + 'display/' + $("#type").val() + "/" + $("#area").val() + "/" + category1 + "/" + i);
		a.text(allclass[i]);
		li.append(a);
		ul.append(li);
	}
	if (first == 1) {
		$("#btng_category2").html("<p>二级分类</p>");
		$("#btng_category2").append(ul);
	} else {
		$("#btng_category2").fadeOut(300, function() {
			$("#btng_category2").html("<p>二级分类</p>");
			$("#btng_category2").append(ul);
			$("#btng_category2").fadeIn(300);
		});	
	}
};
show_category2($("#category1").val(), 1);