<div class="dsroi-form-group">
	<label><?php _e( $args['label'] );?></label>
	<ul class="list-unstyled">
		<?php foreach( $args['items'] as $item ): if( isset( $item['slug'] ) && $item['slug'] ):?>
			<li class="checkbox">
				<label>
					<input type="checkbox" <?php if( isset( $args['value'] ) && in_array( $item['slug'], $args['value'] ) ){_e("checked='checked'");}?> name="<?php _e( $args['name'] );?>[]" value="<?php echo $item['slug'];?>" />&nbsp;<?php _e( $item['name'] );?>
				</label>
			</li>
		<?php endif; endforeach;?>
	</ul>
</div>
