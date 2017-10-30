/* 
* @Author: ChenHua <276004561@qq.com>
* @Date:   2015-09-14 21:11:36
* @Last Modified by:   ChenHua
* @Last Modified time: 2015-11-21 16:01:10
*/

//静止使用框架引用页面
// if(top != self){  
//     top.location.href=self.location.href;
// }

//左侧点击事件
$(function(){
    $(document).on("click",".sub_menu li", function () {
        $(this).parents('.menu_box').find('li').removeClass('on');
        $(this).addClass('on');
        $("body").animate({scrollTop: 0},0)
    })
	/*$('.sub_menu').find('li').click(function(){
		$(this).parents('.menu_box').find('li').removeClass('on');
		$(this).addClass('on');
		$("body").animate({scrollTop: 0},0)
	});*/
})

//左侧点击弹开子菜单
$(function(){
	// $('.menu_box').find('ul').find('li').eq(0).find('.sub_menu').show();
	// $('.menu_box').find('ul').find('li').find('h3').click(function(){
	// 	$(this).parent('li').find('.sub_menu').slideToggle();
	// });
})

//tab面板切换
$(function(){
	$('.tab_content').eq(0).show();
	$('.tab_title li').click(function() {
		var index = $(this).index();
		$(this).addClass('active').siblings('li').removeClass('active');
		$('.tab_content').eq(index).show().siblings('.tab_content').hide();
	});
});

$(function(){
    //列表页点击全选按钮
    $('.list_tab').find('tr').find('[type=checkbox]').click(function(){
		$('.list_tab').find('td').find('[type=checkbox]').prop('checked',$(this).prop('checked'));
	});



    // 右上角点击个人中心，清除左侧导航
    $(".head-link").on("click", function () {
        $(".sub_menu li").removeClass("on")
    })
})

//删除图片列表
function del_pic(obj){
	$(obj).parents('li').remove();
}

//添加图片上传框
function pic_plus(obj){
	var li = $(obj).parents('li').eq(0);
	var input = li.clone();
	input.find('span').attr('onclick','pic_minus(this)');
	input.find('span i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
	input.insertAfter(li);
}

//删除图片上传框
function pic_minus(obj){
	$(obj).parents('li').remove();
}

// 监听子页面加载完成，根据子页面高度，改变父页面高度
// $(function () {
//     var main = document.getElementById('mainIframe');
//     $(main).load(function () {
//
//     })
// })
