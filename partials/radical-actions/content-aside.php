<?php
  $post_id         = $post->ID;
  $youtube_url     = get_post_meta( $post_id, 'video_link', true );
  $external_link   = get_post_meta( $post_id, 'external_link', true );
  $transcript_url  = get_post_meta( $post_id, 'transcript_url', true );
?>
<div class="post-thumbnail">
  <?php if( $youtube_url && $youtube_embed = wp_oembed_get( $youtube_url ) ): ?>
    <?php echo $youtube_embed; ?>
    <?php if( $transcript_url ): ?>
      <a class="transcript-url" href="<?php _e( $transcript_url ); ?>" download>Download Video Transcript</a>
    <?php endif;?>
  <?php elseif( $external_link ): ?>
    <div class="external-link">
      <a href="<?php _e( $external_link ); ?>" class="dsroi-download-btn" target="_blank" rel="noopener noreferrer" role="link" title="<?php _e("View external link for ".get_the_title( $post_id ) );?>">
        <i class="fa fa-external-link" aria-hidden="true"></i>
        View Radical Action
      </a>
    </div>
  <?php elseif( !empty( get_the_post_thumbnail() ) ): $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0]; ?>
    <div class="featured-img" style="background-image: url( <?php _e( $image );?> );" role="img" aria-label="Featured Image"></div>
  <?php endif; ?>
</div>
