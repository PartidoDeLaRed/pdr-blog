(function($) {
	
	$('code, pre').addClass('prettyprint');

	prettyPrint();

	var jquery_element = $('#content-fluid');

	var snapper = new Snap({
	    element: document.getElementById('content-fluid'),
	    disable: 'left'
	});

	$('#open-left').click(function(){

		if ($(this).hasClass('opened')) {
			snapper.close('right');
		}else{
			snapper.open('right');
		};
		$(this).toggleClass("opened");
	});
	
	$('.post a  img').parent().addClass("view"); 


})( jQuery );
