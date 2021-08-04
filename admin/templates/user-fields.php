<?php

	$terms = get_terms( array(
		'taxonomy' 		=> 'institute-year',
		'hide_empty' 	=> false
	) );

	$selected_years = get_user_meta( $user->ID, 'dsroi_iy', true );

?>
<table class="form-table">
	<tr>
		<th><label>Institute Year</label></th>
		<td>
			<ul>
			<?php foreach( $terms as $term ):?>
			<li style="display: inline-block;margin-right: 10px;">
				<label>
					<input type="checkbox" name="dsroi-iy[]" value="<?php _e( $term->slug );?>" <?php if( $selected_years && in_array( $term->slug, $selected_years ) ) echo "checked='checked'"; ?> />
					<?php _e( $term->name );?>
				</label>
			</li>
			<?php endforeach;?>
		</ul>
		</td>
	</tr>
</table>
