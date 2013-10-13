jQuery(function () {
	//init
	init();
	
	//acao botao de alto contraste
	jQuery('a.toggle-contraste').click(function(){
		if(!jQuery('div.layout').hasClass('contraste'))
		{
			jQuery('div.layout').addClass('contraste');	
			layout_classes = jQuery.cookie('layout_classes');
			layout_classes = layout_classes + ' contraste';
			jQuery.cookie('layout_classes', layout_classes, { expires: 7, path: '/' });
		}
		else
		{
			jQuery('div.layout').removeClass('contraste');
			layout_classes = jQuery.cookie('layout_classes');
			layout_classes = layout_classes.replace(' contraste', '');
			jQuery.cookie('layout_classes', layout_classes, { expires: 7, path: '/' });		
		}
	});
	//fim acao botao de alto contraste
	
});

function init() {
	//classes de layout
	jQuery('div.layout').addClass( jQuery.cookie('layout_classes') );
}