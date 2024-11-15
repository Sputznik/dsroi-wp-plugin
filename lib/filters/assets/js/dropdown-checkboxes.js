jQuery.fn.dsroi_dropdown_checkboxes = function(){

	return this.each(function(){

    var $el 			= jQuery(this),
			$reset_btn 	= $el.find( '[data-btn=reset]' );

    // IF CLICK IS MADE OUTSIDE THE ELEMENT THEN CLOSE THE DROPDOWN
		jQuery( document ).on("click", function( event ){
    	if( $el !== event.target && !$el.has( event.target ).length ){
        $el.removeClass('open');
      }
    });

		// IF SOME OTHER DROPDOWNS WITH CHECKBOXES ARE OPEN THEN CLOSE THEM
		$el.find('button').click( function(){
      if( !$el.hasClass('open') ){
				// CLOSE OTHER DROPDOWNS THAT ARE OPEN
				jQuery('[data-behaviour~=dsroi-bt-dropdown-checkboxes].open').removeClass('open');
			}
      $el.toggleClass('open');
    });

    $el.on( 'change', function(){ updateLabel(); } );

		function reset(){
			$el.find('input[type=checkbox]:checked').prop( "checked", false );

			updateLabel();
		}

		$reset_btn.click( function( ev ){
			ev.preventDefault();

			reset();
		});

		$el.closest( 'form' ).on( 'reset', function(){
			setTimeout( function(){
				reset();
			}, 1);
		} );


		// ON LOAD - DEFAULT
    updateLabel();

		function decodeEntities( encodedString ) {
		  var textArea = document.createElement('textarea');
		  textArea.innerHTML = encodedString;
		  return textArea.value;
		}

    function updateLabel(){
      var $checkboxes = $el.find('input[type=checkbox]:checked'),
        values        = [];

      if( !$el.data('btn-label') ){ $el.data('btn-label', $el.find('span.btn-label').html() ); }

      $checkboxes.each( function(){
        var $checkbox     = jQuery( this ),
          checkbox_label  = decodeEntities( $checkbox.parent().find('span').html() ),
					limit						= 10,
					space_index 		= checkbox_label.indexOf(' ');

				if( $checkboxes.length > 1 ){
					// IF SPACE COMES BEFORE THEN BREAK RIGHT FROM THERE
					if( space_index > 1 && space_index < 9 ){ limit = space_index; }

					if( checkbox_label.length > limit ){ checkbox_label =  checkbox_label.substring( 0, limit ) + "..";}
				}

        values.push( checkbox_label );
      });

      if( values.length ){
        $el.find('span.btn-label').html( values.join( ', ') );
      }
      else{
        $el.find('span.btn-label').html( $el.data('btn-label') );
      }
    }

  });
};

jQuery(document).ready(function(){
	jQuery('[data-behaviour~=dsroi-bt-dropdown-checkboxes]').dsroi_dropdown_checkboxes();

	// NOTE:
	jQuery( '[data-behaviour~="dsroi-nested-dropdown"]' ).each( function(){

		var $el             = jQuery( this ),
			$form 						= $el.closest( 'form' ),
			$cats_dropdown    = $el.find( '.cats select' ),
			$subcats_dropdown = $el.find( '.subcats select' ),
			$cloneSubDropdown = $el.find( '.subcats select' ).clone();  // Clones all subcats from dropdown


		function updateSubDropdown( defaultValue ){
			var currentCategoryValue = $cats_dropdown.val();
			var subcat_value = defaultValue ? defaultValue : 0;

			$subcats_dropdown.find( 'option' ).remove();

			var $options;

			if( currentCategoryValue > 0 ){
				$options = $cloneSubDropdown.find( 'option[data-parent~="' + currentCategoryValue + '"]' ).clone();

				var $defaultOption = jQuery( document.createElement( 'option' ) );
				$defaultOption.val( 0 );
				$defaultOption.html('Select');
				$defaultOption.appendTo( $subcats_dropdown );

				$options.appendTo( $subcats_dropdown );

				$subcats_dropdown.val( subcat_value );

				$subcats_dropdown.show();
			}
			else{
				$subcats_dropdown.hide();
			}
		}

		// CHANGE SUBSERVICES WHEN THE MAIN SERVICE IS CHANGED
		$cats_dropdown.change( function( ev ){
			updateSubDropdown();
		});

		/*
		* CHANGE THE NAME OF THE PARENT DROPDOWN IF THE CHILD HAS BEEN SELECTED
		* SO THAT THE QUERY IS DONE SOLELY BASED ON THE CHILD
		*/
		$form.submit( function( ev ){

			var subcat_value = parseInt( $subcats_dropdown.val() );

			if( subcat_value ){
				var taxonomy = $cats_dropdown.attr( 'name' ).replace( 'tax_', '' ).replace( '[]', '' ),
					fieldName	 = 'parent_' + taxonomy;
				$cats_dropdown.attr( 'name', fieldName );
				//alert( fieldName );
			}
		} );

		// ON THE INITIAL LOAD HIDE THE DROPDOWN
		if( !$cats_dropdown.val() ){
			$subcats_dropdown.hide();
		}
		else{
			var temp_subcat_val = $subcats_dropdown.val();

			temp_subcat_val = temp_subcat_val ? temp_subcat_val : 0;

			updateSubDropdown( temp_subcat_val );
		}
	});

});
