$().ready(function(){
	addHehuorenDetailEvent();
});

function addHehuorenDetailEvent(){

	$('.contentZone').delegate('.glyphicon-chevron-right','click',function(){
		var s = $(this).parents('li').find('strong').text();
		alert(s);
	});

	$('.connectBtn').click(function(){
		alert('联系他');
	});
}