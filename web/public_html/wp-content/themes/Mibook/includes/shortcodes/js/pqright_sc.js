// PullquoteRight Short Code

(function() {  
     tinymce.create('tinymce.plugins.pqright', {  
        init : function(ed, url) {  
             ed.addButton('pqright', {  
                title : 'PullQuote right aligned (Select the content and click this button)',  
                image : url+'/images/pqright.png',  
                onclick : function() {  
                      ed.selection.setContent('[pullquote_right]' + ed.selection.getContent() + '[/pullquote_right]'); 
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
     tinymce.PluginManager.add('pqright', tinymce.plugins.pqright);  
 })();