jQuery(document).ready(function ($) {
  // top menu
  $(".f_ul").superfish();
  $(".f_ul").after("<div id='my-menu'>");
  $(".f_ul").clone().appendTo("#my-menu");
  $("#my-menu").find("*").attr("style", "");
  $("#my-menu").find("ul").removeClass("f_ul");
  $("#my-menu").mmenu({
    extensions: [
      "widescreen",
      "pagedim-black",
      "effect-menu-slide",
      "effect-listitems-slide",
      "fx-menu-zoom",
      "fx-panels-zoom",
      "theme-dark",
    ],
    navbar: {
      title: "Spiver",
    },
  });
  var api = $("#my-menu").data("mmenu");
  api.bind("closed", function () {
    $(".toggle-mnu").removeClass("on");
  });

  $(".mobile-mnu").click(function () {
    var mmAPI = $("#my-menu").data("mmenu");
    mmAPI.open();
    var thiss = $(this).find(".toggle-mnu");
    mmAPI.bind("open:finish", function () {
      thiss.addClass("on");
    });

    mmAPI.bind("close:finish", function () {
      thiss.removeClass("on");
    });

    $(".main-mnu").slideToggle();
    return false;
  });
  // end top menu

  // Sidebar Menu
  $(function () {
    var Accordion = function (el, multiple) {
      this.el = el || {};
      this.multiple = multiple || false;

      // Variables privadas
      var links = this.el.find(".link");
      // Evento
      links.on(
        "click",
        { el: this.el, multiple: this.multiple },
        this.dropdown
      );
    };

    Accordion.prototype.dropdown = function (e) {
      var $el = e.data.el;
      ($this = $(this)), ($next = $this.next());

      $next.slideToggle();
      $this.parent().toggleClass("open");

      if (!e.data.multiple) {
        $el.find(".submenu").not($next).slideUp().parent().removeClass("open");
      }
    };

    var accordion = new Accordion($("#s_menu"), false);
  });

  // Main Slider
  $("#main-slider").owlCarousel({
    items: 1,
    margin: 0,
    nav: false,
    navText: "",
    dots: false,
    animateOut: "slideOutDown",
    animateIn: "fadeIn",
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: false,
        dots: false,
        loop: false,
      },
      600: {
        items: 1,
        nav: false,
        dots: false,
        loop: false,
      },
      1000: {
        items: 1,
        nav: false,
        dots: false,
        loop: false,
      },
    },
  });
  $(".product_slider").owlCarousel({
    items: 3,
    loop: false,
    margin: 10,
    center: true,
    nav: true,
    dots: false,
    autoplay: false,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true,
        dots: false,
        loop: true,
      },
      600: {
        items: 2,
        nav: true,
        dots: false,
        loop: true,
      },
      1000: {
        items: 3,
        nav: true,
        dots: false,
        loop: true,
        center: true,
      },
    },
  });
  // For the widget on the page - About Us
  $("#sidebar-slider").owlCarousel({
    nav: true,
    dots: false,
    loop: true,
    items: 5,
    margin: 10,
    autoplay: true,
    responsive: {
      0: {
        items: 1,
        dots: true,
      },
      480: {
        items: 2,
        dots: true,
      },
      768: {
        items: 2,
        dots: true,
      },
      992: {
        items: 5,
      },
    },
  });
  //Related posts
  $(".post-list").owlCarousel({
    items: 4,
    nav: true,
    loop: true,
    margin: 5,
    autoplay: true,
    navText: "",
    responsive: {
      0: {
        items: 1,
      },
      480: {
        items: 2,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
    },
  });

  $(".open_s_form").on("click", function (e) {
    e.preventDefault();
    $(".second_topsearch").modal("show");
  });

  $("#lg").lightGallery({
    thumbnail: true,
    animateThumb: true,
    showThumbByDefault: false,
    selector: ".item",
  });

  $("#pg").lightGallery({
    thumbnail: true,
    animateThumb: true,
    showThumbByDefault: false,
    selector: ".item",
  });
  $("#wg").lightGallery({
    thumbnail: true,
    animateThumb: true,
    showThumbByDefault: false,
    selector: ".item",
  });
  $("#cat_lg").lightGallery({
    thumbnail: true,
    animateThumb: true,
    showThumbByDefault: false,
    selector: ".item",
  });

  $(".shapeBtn").on("click", function (e) {
    e.preventDefault();
    $(this).toggleClass("invert");
    let selector = $(this);
    let parentObj = selector.closest(".ui.shape");

    $(parentObj).shape("flip up");
  });

  $(".modalBtn").on("click", function (e) {
    e.preventDefault();
    let selector = $(this);
    // let parentObj = selector.parents(".product_content").closest("#myModalBox");
    // console.log(parentObj);
    let parentObj = selector.siblings("#myModalBox");

    // parentObj.modal("show").modal({ backdrop: "static", keyboard: false });
    parentObj
      .modal({
        centered: true,
        closable: false,
      })
      .modal("show");
    $(".close").on("click", function () {
      location.reload();
    });
  });

  $(".cart").on("click", function (e) {
    e.preventDefault();
    let selector = $(this);
    let id = selector.siblings("input").val();
    let title = selector.parents(".product_content").find(".head_title").html();
    let content = selector
      .parents(".product_content")
      .find(".block_content")
      .html();

    let data = {
      id: id,
      title: title,
      Description: content,
    };

    $.ajax({
      type: "POST",
      url: frontEndAjax.ajaxurl,
      data: {
        action: "add_to_cart",
        data_to_pass: data,
        nonce: frontEndAjax.nonce,
      },
      success: function (response) {
        alert("Товар додано");
        window.location.reload();
        $("#cart_data").html("<p class='p_d'>" + response + "</p>");
      },
    });

    return false;
  });

  $(".delBtn").on("click", function (e) {
    e.preventDefault();
    let res = confirm("Are you sure?");
    if (res) {
      $(this).parents(".data_cart").remove();
      let selector = $(this);

      let id = selector.parents(".data_cart").find(".data_id").html();
      let title = selector.parents(".data_cart").find(".data_title").html();
      let content = selector
        .parents(".data_cart")
        .find(".data_description")
        .html();

      let data = {
        id: id,
        title: title,
        Description: content,
      };
      $.ajax({
        type: "POST",
        url: frontEndAjax.ajaxurl,
        data: {
          action: "del_from_cart",
          data_to_pass: data,
          nonce: frontEndAjax.nonce,
        },
        success: function (response) {
          alert("Товар видалено");
          window.location.reload();
          $("#cart_data").html("<p class='p_d'>" + response + "</p>");
        },
      });
      return false;
    } else {
      return false;
    }
  });

  $("#order_form").on("submit", function (e) {
    e.preventDefault();

    let name = $("input[name=name]").val();
    let last_name = $("input[name=last_name]").val();
    let phone = $("input[name=phone]").val();
    let email = $("input[name=email]").val();
    let mess = $("textarea[name=mess]").val();

    if (name == "" || last_name == "" || phone == "" || email == "") {
      alert("All data must be filled");
    } else {
      let data = {
        name: name,
        lname: last_name,
        phone: phone,
        mess: mess,
        email: email,
      };
      console.log(data);
      $.ajax({
        type: "POST",
        url: frontEndAjax.ajaxurl,
        data: {
          action: "send_from_cart",
          data_to_pass: {
            data,
          },
          nonce: frontEndAjax.nonce,
        },
        success: function (response) {
          alert("Замовлення відправлено");

          $("#c_data").html(response);
          window.location.reload();
        },
        error: function () {
          alert("Замовлення не відправлено");
        },
      });
    }
  });
});
// function addToCart(itemId) {
//   console.log("add_to_cart " + itemId);
//   $.ajax({
//     type: "POST",
//     url: frontEndAjax.ajaxurl,
//     data: {
//       action: "add_to_cart",
//       data_to_pass: itemId,
//       nonce: frontEndAjax.nonce,
//     },
//     success: function (response) {
//       $("#cartLabel").html('<i class="shopping cart  icon"></i>' + response);
//     },
//   });
//   return false;
// }
//form validation
function validateAndSend() {
  const elements = document.getElementsByClassName("validation");
  const form = document.getElementsByClassName("contact_form");
  let isValid = false;

  for (let i = 0; i < elements.length; i++) {
    var element = elements[i];
    element.classList.remove("wow", "animated", "jello", "error");
    if (element.value.length === 0) {
      element.classList.add("wow", "animated", "jello", "error");
      element.focus();
      break;
    }

    if (i === elements.length - 1) {
      isValid = true;
    }
  }

  if (isValid) {
    form.classList.add("animated", "bounceOut");
  }
}
