<a href="<?php echo $atts['url']; ?>"
  <?php if( $atts['style'] == "button" ){ echo 'class="dsroi-'.$atts['type'].'-btn"'; }?>
  rel="noopener noreferrer" aria-label= "<?php echo $atts['aria-label'];?>"
  role="link" <?php if( $atts['type'] == "download" ){ echo "download"; }?>
>
  <?php if( $atts['type'] == "download" && $atts['style'] == "button" ):?>
    <i class="fa fa-download" aria-hidden="true"></i>
  <?php endif;?>
  <?php echo $atts['text']; ?>
</a>
