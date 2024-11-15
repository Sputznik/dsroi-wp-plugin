<div class="archive-search-wrapper">
  <div class="filter-title">
    <span class='fa-icon'><i class="fa fa-filter"></i></span>
    <span>Filters</span>
  </div>
  <form method="GET" class="archive-search" action="<?php _e( $this->getCurrentURL() );?>">
    <div class="sort-wrapper">
      <?php
        // GET ALL THE FILTERS
        $filters = $this->getFilters();

        foreach ( $filters as $key => $args ) {
          /* SET FORM NAME AND FORM VALUE */
      		$args['name'] = $args['typeval'];

          if( isset( $_GET[ $args['name'] ] ) ){
      			$args['value'] = $_GET[ $args['name'] ];

            // CHECK IF FORM VALUE IS NOT SET FOR CHECKBOXES THEN SET DEFAULT VALUE TO ARRAY
            switch( $args['form'] ){
              case 'bt-dropdown-checkboxes':
              case 'checkbox':
              if( !isset( $args['value'] ) || !is_array( $args['value'] ) ){ $args['value'] = array();}
              break;
            }

          }

          include( $args['form'].'.php' );
        }
      ?>
      <ul class="list-inline" data-list="form-btns">
  		<li><button type='submit'>Submit</button></li>
  		<li>or</li>
  		<li><a href="<?php _e( $this->getCurrentURL() );?>" style="text-decoration:underline">Reset</a></li>
  	</ul>
    </div>
  </form>
</div>
