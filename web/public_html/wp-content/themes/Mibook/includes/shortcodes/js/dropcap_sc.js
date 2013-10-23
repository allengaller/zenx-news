// Dropcap Short Code

(function() {  
     tinymce.create('tinymce.plugins.dropcap', {  
        init : function(ed, url) {  
             ed.addButton('dropcap', {  
                title : 'Add a DropCap (Select first letter and click this button)',  
                image : url+'/images/dropcap.png',  
                onclick : function() {  
                      ed.selection.setContent('[dropcap]' + ed.selection.getContent() + '[/dropcap]'); 
                 }  
             });  
         },  
         createControl : function(n, cm) {  
             return null;  
         },  
     });  
     tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);  
 })();