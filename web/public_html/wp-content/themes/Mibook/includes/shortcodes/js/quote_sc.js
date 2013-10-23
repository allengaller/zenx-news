// Quote Short Code

(function() {  
     tinymce.create('tinymce.plugins.quote', {  
        init : function(ed, url) {  
             ed.addButton('quote', {  
                title : 'Add a Quote (Select the content and click this button)',  
                image : url+'/images/quote.png',  
                onclick : function() {  
                      ed.selection.setContent('[quote]' + ed.selection.getContent() + '[/quote]'); 
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
     tinymce.PluginManager.add('quote', tinymce.plugins.quote);  
 })();