// PullquoteLeft Short Code

(function() {  
     tinymce.create('tinymce.plugins.pqleft', {  
        init : function(ed, url) {  
             ed.addButton('pqleft', {  
                title : 'PullQuote left aligned (Select the content and click this button)',  
                image : url+'/images/pqleft.png',  
                onclick : function() {  
                      ed.selection.setContent('[pullquote_left]' + ed.selection.getContent() + '[/pullquote_left]'); 
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
     tinymce.PluginManager.add('pqleft', tinymce.plugins.pqleft);  
 })();