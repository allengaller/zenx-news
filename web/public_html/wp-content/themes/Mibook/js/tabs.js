jQuery(document).ready(function($) {

	// -- Tabber --	
	
	$('.tabber').each(function(){
		var widgets = $(this).find('div.tabbed');
		var titleList = '<ul class="tabs">';
		for (i=0; i<widgets.length; i++)
		{
			var widgetTitle = $(widgets[i]).children('h4.tab_title').text();
			$(widgets[i]).children('h4.tab_title').hide();
			var listItem = '<li><a href="#' +$(widgets[i]).attr("id")+ '">' +widgetTitle+ '</a></li>';
			titleList += listItem;
		};
		titleList += '</ul>'; 
		$(widgets[0]).before(titleList);
		$(this).tabs();
		//$(this).tabs({fx:{ height: 'toggle', opacity: 'toggle', duration: 300 }});
   });
	
	
	$('.tour').each(function(){
		var widgets = $(this).find('div.toured');
		var titleList = '';
		var tour_head = $(this).find('h5.tour_head').text();
		$(this).find('h5.tour_head').hide();
		
		if(tour_head!='')
			titleList = '<ul class="steps"><li class="tour_head">' + tour_head + '</li>';
		else
			titleList = '<ul class="steps no_heading">';
		
		for (i=0; i<widgets.length; i++)
		{
			var widgetTitle = $(widgets[i]).children('h4.tour_title').text();
			$(widgets[i]).children('h4.tour_title').hide();
			var listItem = '<li><a href="#' +$(widgets[i]).attr("id")+ '">' +widgetTitle+ '</a></li>';
			titleList += listItem;
		};
		titleList += '</ul>'; 
		$(widgets[0]).before(titleList);
		$(this).tabs();
		//$(this).tabs({fx:{ height: 'toggle', opacity: 'toggle', duration: 300 }});
   })	

})	