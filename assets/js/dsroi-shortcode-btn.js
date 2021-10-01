(function() {
  /* Register the buttons */
  tinymce.create("tinymce.plugins.Dsroi", {
      init : function(ed, url) {
        ed.addButton("dsroi_shortcode_btn", {
            text: "Add button",
            cmd : "dsroi_shortcode_btn_callback",
            icon: 'link',
            classes: "dsroi-shortcode-btn"
        });
        ed.addCommand("dsroi_shortcode_btn_callback", function() {
          ed.windowManager.open({
            id   : "dsroi-shortcode-dialog",
            title: "Additional Information",
            body: [
               {
                  type: 'textbox',
                  name: 'btnText',
                  label: 'Link Text',
  				        minWidth: 350,
               },
               {
                  type: 'textbox',
                  name: 'btnURL',
                  label: 'Redirect URL',
                  minWidth: 350,
               },
               {
                  type: 'listbox',
                  name: 'btnType',
                  label: 'Type',
                  'values': [
                    {text: 'Default', value: 'default'},
                    {text: 'Download', value: 'download'}
                  ]
               },
               {
                  type: 'listbox',
                  name: 'btnStyle',
                  label: 'Style',
                  'values': [
                    {text: 'Default', value: 'default'},
                    {text: 'Button', value: 'button'}
                  ]
               }
            ],
            onsubmit: function( e ){
              if(e.data.btnText === '' || e.data.btnURL === '') {
                ed.windowManager.alert("Please, fill in all fields.");
                return false;
              }
              ed.insertContent( '[dsroi_button text="'+e.data.btnText+'" url="'+e.data.btnURL+'" type="'+e.data.btnType+'" style="'+e.data.btnStyle+'"]');
            }
          });
        });
      },
  });
  /* Start the buttons */
  tinymce.PluginManager.add( "dsroi_shortcode_script", tinymce.plugins.Dsroi);
})();
