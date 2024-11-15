<div class="dsroi-form-group">
  <label><?php _e( $args['label'] );?></label>
  <div class="dsroi-dropdown" data-behaviour="dsroi-bt-dropdown-checkboxes">
    <button type="button">
      <span class='btn-label'><?php _e( 'Select' );?></span>
      <span class="caret"></span>
    </button>
    <ul class="dsroi-dropdown-menu" role="menu" aria-labelledby="menu1">
      <li style="padding: 0 10px; margin-bottom: 10px;"><a href="#" data-btn="reset">Clear All</a></li>
      <?php foreach( $args['items'] as $item ): if( isset( $item['slug'] ) && $item['slug'] ):?>
      <li class="checkbox" <?php if( isset( $item['parent'] ) ){ _e("data-parent='".$item['parent']."'");}?>>
      	<label>
      		<input type="checkbox" <?php if( isset( $args['value'] ) &&  in_array( $item['slug'], $args['value'] ) ){_e("checked='checked'");}?> name="<?php _e( $args['name'] );?>[]" value="<?php _e( $item['slug'] );?>" />
          <span><?php _e( $item['name'] );?></span>
      	</label>
      </li>
      <?php endif;endforeach;?>
    </ul>
  </div>
</div>
