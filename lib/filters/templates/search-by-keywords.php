<div class="archive-search-wrapper">
  <div class="filter-title">
    <span>Search by keywords</span>
  </div>
  <form method="GET" class="archive-search search-by-keywords" action="<?php _e( $this->getCurrentURL() );?>">
    <input placeholder="type keyword(s) here" type="text" name="phrase" autocomplete="off">
    <button type="submit" class="search-by-keywords-submit" aria-label="Search">
      <i class="fa fa-search" aria-hidden="true"></i>
    </button>
  </form>
</div>
