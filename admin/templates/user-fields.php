<?php

	$terms = get_terms( array(
		'taxonomy' 		=> 'year',
		'hide_empty' 	=> false,
	) );

	$selected_years = get_user_meta( $user->ID, 'dsroi_ufy', true );

?>
<table class="form-table">
	<tr>
		<th><label>Following Year</label></th>
		<td>
			<ul>
			<?php foreach( $terms as $term ):?>
			<li style="display: inline-block;margin-right: 10px;">
				<label>
					<input type="checkbox" name="dsroi-ufy[]" value="<?php _e( $term->slug );?>" <?php if( $selected_years && in_array( $term->slug, $selected_years ) ) echo "checked='checked'"; ?> />
					<?php _e( $term->name );?>
				</label>
			</li>
			<?php endforeach;?>
		</ul>
		</td>
	</tr>
</table>
