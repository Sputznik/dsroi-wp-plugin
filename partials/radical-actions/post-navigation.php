<div class="radical-action-post-nav">
	<?php
		$next_post_label     = "Next archive item";
		$previous_post_label = "Previous archive item";

		$prev_nav = '
		<div class="previous-post">
			<span title="'.$previous_post_label.'"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
			<div class="previous-post-inner">
				<h5 class="post-label">'.$previous_post_label.':</h5>
				<span class="post-title">%title</span>
			</div>
		</div>';

		$next_nav = '
		<div class="next-post">
			<div class="next-post-inner">
				<h5 class="post-label next-post-label">'.$next_post_label.':</h5>
				<span class="post-title">%title</span>
			</div>
			<span title="'.$next_post_label.'"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
		</div>';

		the_post_navigation(
		  array(
		    'next_text' => $next_nav,
		    'prev_text' => $prev_nav,
		  )
		);
	?>
</div>
