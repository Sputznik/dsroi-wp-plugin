<div class="dsroi-form-group">
	<?php if( isset( $args['label'] ) && $args['label'] ): ?><label><?php _e( $args['label'] );?></label><?php endif; ?>
	<select name="<?php _e( $args['name'] );?>">
		<option value="">Select</option>
		<?php foreach( $args['items'] as $item ):?>
		<option
		<?php if( isset( $item['parent'] ) ){ _e("data-parent='".$item['parent']."'");}?>
		<?php if( isset( $args['value'] ) && $item['slug'] == $args['value'] ){_e("selected='selected'");}?>
		value="<?php _e( $item['slug'] );?>"
		><?php _e( $item['name'] );?></option>
		<?php endforeach;?>
	</select>
</div>
