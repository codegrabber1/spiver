<div class="product_btn">
  <div class="ui bottom attached p_bt_left" data-inverted="" data-tooltip="<?php _e( 'Add to List', 'spiver' );?>"
    data-position="left center">
    <input type="hidden" value="<?php echo $post->ID?>">
    <span class="cart" id='cart_<?php echo $post->ID?>'>
      <svg class="cart_svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M19 11H13V5H11V11H5V13H11V19H13V13H19V11Z" fill="white" />
      </svg>
    </span>
  </div>
</div>