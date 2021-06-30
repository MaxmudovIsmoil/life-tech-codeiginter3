$(function(){

  $(document).on("click", "button", function () {
      var $this = $(this);

      if($this.hasClass("js_delete_item"))
      {
        var url = $this.data('href');
        $('.js_modal_delete').val(url);

        var title = $this.data('title');
        $(document).find('.js_modal_title').html(title);
        console.log(title);
      }

      if($this.hasClass("js_modal_delete"))
      {
        var url2 = $this.attr("value");
        $.post(url2, {}, function(res){
          console.log(res);
          if(res)
          {
            $("#delete_notify").modal("hide");
            location.reload();
          }
          else
          {
            alert("uchmadi");
          }
        }, "json");

      }
  });


});

/* ########################################## */
/* Tahrirlash uchun */

  //   $('button').click(function() {
  //     var $this = $(this);

  //     if($this.hasClass("js_update_item"))
  //     {
  //       var url = $this.data('href');
  //       $('.js_modal_update').val(url);
  //     }

  //     if($this.hasClass("js_modal_update"))
  //     {
  //       var url2 = $this.attr("value");
  //       $.post(url2, {}, function(res){
  //         console.log(res);
  //         if(res)
  //         {
  //           $("#update_notify").modal("hide");
  //           location.reload();
  //         }
  //         else
  //         {
  //           alert("Yangilanmadi");
  //         }
  //       }, "json");

  //     } 
  // })
/* ########################################## */



