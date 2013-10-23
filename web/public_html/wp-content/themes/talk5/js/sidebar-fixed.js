$(document).ready(function(){
	//±ß²àÀ¸µÄÐÞÕý
	var _fluidHeight = $("#J_fluid").height();
	//alert (_fluidHeight);
	if( _fluidHeight < 2000 ){
		$("#J_tabsCategory").nextAll().remove(); 
	} else if( _fluidHeight < 2150 ){
		$("#J_goods").nextAll().remove(); 
	} else if( _fluidHeight < 2600 ){
		$("#J_gravatarComment").nextAll().remove(); 
	}else if( _fluidHeight < 2950 ){
		$("#J_list_qq").nextAll().remove(); 
	}else if( _fluidHeight < 3900 ){
		$("#J_sidebarTwo").remove(); 
	}
	
	
	
	
	/************
	var _fluidHeight = $("#J_fluid").height();
	//alert (_fluidHeight);
	if ( _fluidHeight < 600 ){
		$("#J_sidebarAds_a").hide(); 
	} else if( _fluidHeight < 900 ){
		$("#J_adsArea").nextAll().hide(); 
	} else if( _fluidHeight < 1100 ){
		$("#J_sticky").nextAll().hide(); 
	} else if( _fluidHeight < 1480 ){
		$("#J_box_tui").nextAll().hide(); 
	} else if( _fluidHeight < 1900 ){
		$("#J_tabsCategory").nextAll().hide(); 
	} else if( _fluidHeight < 2700 ){
		$("#J_goods").nextAll().hide(); 
	} else if( _fluidHeight < 2700 ){
		$("#J_gravatarComment").nextAll().hide(); 
	} else if( _fluidHeight < 3300 ){
		$("#J_list_qq").nextAll().hide(); 
	}
	
	**********/

//end
});