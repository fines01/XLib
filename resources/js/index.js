"use strict";

(function($){
  $(document).ready(function(){

  // *** NAVBAR ***

  // jQuery:
  $(".nav-toggle").on("click", function(){
    $(".links").each( function(){ // ev. nicht notwendig, da impizite iteration in jQuery--> TEST???
      $(this).toggleClass("show-links");
    })
    // TEST implicit iteration:
    // $(".links").toggleClass("show-links");
  })

  $(".dropdown-open").each(function(){
    $(this).on("click", function(e){
      e.preventDefault();
      var width = $(window).height();
      //console.log(width);
      if (width < 1225) {
        $(".nav-dropdown-content").toggleClass("show-dropdown");
      }
      else {
        $(".nav-dropdown-content").removeClass("dropdown-content");
      }
      });
  })

  // $(".dropdown-open").on("click", function(e){
  //   e.preventDefault();
  //   var width = $(window).height();
  //   //console.log(width);
  //   if (width < 1225) {
  //     $(".nav-dropdown-content").toggleClass("show-dropdown");
  //   }
  //   else {
  //     $(".nav-dropdown-content").removeClass("dropdown-content");
  //   }
  // });

  // in Vanilla JS:
  
  // const navToggle = document.querySelector(".nav-toggle");
  // const links = document.querySelectorAll(".links");
  // const dropdownContent = document.querySelector(".nav-dropdown-content");
  // const dropdownOpen= document.querySelector(".dropdown-open");

  // navToggle.addEventListener("click", function () {
  //   links.forEach(function (link) {
  //     link.classList.toggle("show-links");
  //   });
  // });


  // // show-dropdown bei click: nur beim kleineren Bildschirm
  // // sollte screensize/ resize erkennen, auch wenn site nicht neu geladen? via EventListener?
  // // window.addEventListener("resize", displayNavDropdown()); //ev. einfacher in css via mediaquery.

  // dropdownOpen.addEventListener("click", displayNavDropdown);

  // function displayNavDropdown(e) {
  //   e.preventDefault(); 
  //   var width = document.documentElement.clientWidth;
  //   //console.log(width);
  //   if (width < 1225) {
  //       dropdownContent.classList.toggle("show-dropdown")
  //   }
  //   else {
  //     dropdownContent.classList.remove("dropdown-content");
  //   } 
  // }


  // *** TOASTR ***

  toastr.options = {
    "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-center",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
  }

  window.myToastr = function(typ,msg,title=undefined){
      switch(typ){
          case 'success' : toastr.success(msg, title || 'Success!'); break;
          case 'info' : toastr.info(msg, title || 'Success'); break;
          case 'warning' : toastr.warning(msg, title || 'Success'); break;
          case 'error' : toastr.error(msg, title || 'Success'); break;
      }
  }

  // *** DELETE- MODAL (test) ***

  $(".delete-form").on("submit", function (e) {
    e.preventDefault();
    const form = $(this);
    console.log(form);

    $("#overlay").removeClass("hidden");
    // $("#deleteModalLabel").html($(".delete-form").data("title"));
    // $("#deleteModalBody").html($(".delete-form").data("body"));
    $("#deleteModalLabel").html(form.data("title"));
    $("#deleteModalBody").html(form.data("body"));
  
    $(".dismiss-btn, #close-modal").on("click", function () {
      console.log("you clicked cancel");
      $("#overlay").addClass("hidden");
    });

    $(".delete-btn-modal")
      .off()
      .on("click", function () {
        
        $("#overlay").addClass("hidden");
        // console.log("you clicked delete");
        // console.log(form);
        // console.log(form.serialize());
        $.ajax({
          url : form.attr('action'),
          method : 'DELETE',
          data : form.serialize(),
          success : function(response){
        if( response.status === 200 ){
                    form.closest('tr').remove();
                    myToastr('success',response.msg);
                }
                else{
                    myToastr('error',response.msg,response.status);
                }
            },
            error : function(xhr){
                console.log(xhr.status, xhr.statusText );
            }
        });
      });
  });

// TEST
    $(".sort-btn").on("cick", function(e){
      e.preventDefault();
      console.log("you clicked sort");
      //console.log($this);
    });
    
 
});
})(jQuery);
