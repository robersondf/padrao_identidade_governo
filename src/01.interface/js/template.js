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

	// botao de menu para resolucoes menores ou iguais a 800 x 1280
	jQuery('a.mainmenu-toggle').click(function(){
		if( !jQuery('.navigation-container aside').is(':visible') )
			jQuery('aside').slideDown();
		else
			jQuery('.navigation-container aside').slideUp();
		if( jQuery('#em-destaque').is(':visible') )
		{
			jQuery('.navigation-container aside nav:first').css('padding-top', '28px');
		}
	});
	if( !jQuery('.navigation-container aside nav:last').is(":visible") )
	{
		jQuery('.navigation-container aside h2').css('cursor', 'pointer');
		jQuery('.navigation-container aside h2').click(function(){
			if( !jQuery(this).next().is(':visible') )
			{
				jQuery(this).next().slideDown();
				jQuery(this).find('i').removeClass('icon-chevron-down');
				jQuery(this).find('i').addClass('icon-chevron-up');
			}
			else
			{
				jQuery(this).next().slideUp();
				jQuery(this).find('i').addClass('icon-chevron-down');
				jQuery(this).find('i').removeClass('icon-chevron-up');
			}
		})
	}
	// fim botao de menu para resolucoes menores ou iguais a 800 x 1280

});

function init() {
	//classes de layout
	jQuery('div.layout').addClass( jQuery.cookie('layout_classes') );

}