(function($) {
    $( document ).ready( function () {
        // Change the background color in the block where phone's input is.

        //$('select.styled').customSelect();

        $(".tab_block").hide();
        $(".tabs ul li:first").addClass("active").show();
        $(".tab_block:first").show();

        $(".tabs ul li").click(function() {
            $(".tabs ul li").removeClass("active");
            $(this).addClass("active");
            $(".tab_block").hide();
            let activeTab = $(this).find("a").attr("href");
            $(activeTab).fadeIn(200);
            return false;
        });

        //Top header colorpicker
        $('#mcw_topheader_color_selector').ColorPicker({
            onChange: function (hsb, hex, rgb) {
                $('#mcw_topheader_color_selector div').css('backgroundColor', '#' + hex);
                $('#mcw_topheader_color').val('#'+hex);
            }
        });

        //Links colorpicker
        $('#mcw_links_color_selector').ColorPicker({
            onChange: function (hsb, hex, rgb) {
                $('#mcw_links_color_selector div').css('backgroundColor', '#' + hex);
                $('#mcw_links_color').val('#'+hex);
            }
        });

        //backround colorpicker
        $('#mcw_bg_sofa').ColorPicker({
            onChange: function (hsb, hex, rgb) {
                $('#mcw_bg_sofa div').css('backgroundColor', '#' + hex);
                $('#mcw_bg_color_sofa').val('#' + hex);
            }
        });
        //Links colorpicker
        $('#mcw_text_sofa').ColorPicker({
            onChange: function (hsb, hex, rgb) {
                $('#mcw_text_sofa div').css('backgroundColor', '#' + hex);
                $('#mcw_text_color_sofa').val('#' + hex);
            }
        });

        $('#mcw_bg_carpet').ColorPicker({
            onChange: function (hsb, hex, rgb) {
                $('#mcw_bg_carpet div').css('backgroundColor', '#' + hex);
                $('#mcw_bg_color_carpet').val('#' + hex);
            }
        });
        $('#mcw_text_carpet').ColorPicker({
            onChange: function (hsb, hex, rgb) {
                $('#mcw_text_carpet div').css('backgroundColor', '#' + hex);
                $('#mcw_text_color_carpet').val('#' + hex);
            }
        });

        $('#mcw_bg_mattress').ColorPicker({
            onChange: function (hsb, hex, rgb) {
                $('#mcw_bg_mattress div').css('backgroundColor', '#' + hex);
                $('#mcw_bg_color_mattress').val('#' + hex);
            }
        });
        $('#mcw_text_mattress').ColorPicker({
            onChange: function (hsb, hex, rgb) {
                $('#mcw_text_mattress div').css('backgroundColor', '#' + hex);
                $('#mcw_text_color_mattress').val('#' + hex);
            }
        });

        setTimeout(function () {
            $(".fade").fadeOut("slow", function () {
                $(".fade").remove();
            });
        }, 2000);

    })
})(jQuery);