<!-- icon -->
<div class="modalBtn p_bt_right" data-tooltip="<?php _e( 'Description', 'spiver' )?>" data-position="top right"
  data-variation="large">
  <svg class="question_svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path
      d="M15.6856 0.75H2.25V23.25H22.125V7.18936L15.6856 0.75ZM20.625 7.81064V7.875H15V2.25H15.0644L20.625 7.81064ZM3.75 21.75V2.25H13.5V9.375H20.625V21.75H3.75Z"
      fill="white" />
    <path d="M6.375 13.875H16.875V15.375H6.375V13.875Z" fill="white" />
    <path d="M6.375 17.625H16.875V19.125H6.375V17.625Z" fill="white" />
  </svg>
</div>
<!-- #icon -->
<!-- Modal window -->
<div class="ui longer modal" id="myModalBox">
  <i class="close icon"></i>
  <div class="header">
    <h4 class="modal-title">
      <?php the_title();?></h4>
  </div>
  <div class="content">
    <?php 
        the_content();
    ?>
  </div>
</div>
<!-- #Modal window -->