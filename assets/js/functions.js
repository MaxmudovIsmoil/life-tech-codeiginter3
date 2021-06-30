$(document).ready(function () {
    $("#tug_yil").datepicker({
        uiLibrary: 'bootstrap4',
        format: "dd.mm.yyyy"
    });

    $("#filtr_1").datepicker({
        uiLibrary: 'bootstrap4',
        format: "dd.mm.yyyy"
    });
    $("#filtr_2").datepicker({
        uiLibrary: 'bootstrap4',
        format: "dd.mm.yyyy"
    });

    $("#start_day").datepicker({
        uiLibrary: 'bootstrap4',
        format: "dd.mm.yyyy"
    });

    /*** Guruhga tegishli o'quvchilar chiqarish uchun ajax */
    $('.js_guruh_nomi').click(function(){
        var $this = $(this);
        var $guruh_nomi = $this.html()+" guruhidagi o'quvchilar";
        $('#js_guruh_model .modal-title').html($guruh_nomi);
        var url = $this.data('url');

        $.post(url, {}, function (res) {

            $('#js_guruh_model').find(".modal_content").html(res);
            $('#js_guruh_model').modal("show");

        }, "json");

    });

    /**  Guruh davomat uchun kurslarni scoll bolganda fixed-top = 0 qilib qotirish **/
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > 50) {
            $('.davomat_kurslar_fixed').addClass('fixed');
            //console.log(111);
        } else {
            //console.log(222);
            $('.davomat_kurslar_fixed').removeClass('fixed');
        }
    });

    /** document refresh bo'lganda davomat kurslar fixed bo'lishi */
    if ($(window).scrollTop() > 50) {
        $('.davomat_kurslar_fixed').addClass('fixed');
    }


    /** active guruhdagi o'quvchilarni davomati term_pagination ajax */
    $('.js_term_pagination').click(function(e){
        e.preventDefault();
        var term        = $(this).data('term');
        var guruh_id    = $(this).data('guruhId');

        $(document).find('.js_term_pagination').removeClass('active_term_btn');
        $(this).addClass('active_term_btn');

        var guruh_once_davomat = $(document).find('#guruh_once_davomat_'+guruh_id);

        var data = {'guruh_id' : guruh_id, "term": term};
        $.post("ajax_term", data, function (res) {
            guruh_once_davomat.html(res);
        }, "json");
    })


    $('[data-toggle="tooltip"]').tooltip();
    $('.js_delete_item').tooltip();

});



// // #################################################################
 // Kurs update

 //$(document).ready(function () {
 //
 //    $(".kurseditbtn").on('click', function () {
 //
 //        $("#update_notify").modal('show');
 //
 //        var url = $(this).data('href');
 //
 //        $tr = $(this).closest("tr");
 //
 //        var data = $tr.children("td").map(function () {
 //            return $(this).text();
 //        }).get();
 //
 //        console.log(data);
 //
 //        $("#knomi").val(data[0]);
 //        $("#update_id").val(url);
 //    });
 //});


// 	// #################################################################
// 	// Student ctrate

// 	$(".student_create_btn").on('click', function (){

// 		$("#student_create_modal").modal('show');

// 	}); /* ./ student_create_btn  */


// 	$(".student_edit_btn").on('click', function (){
// 		// alert("sd");
// 		$("#student_edit_modal").modal('show');
// 	});

// 	// #################################################################
// 	// teacher ctrate

// 	$(".teacher_create_btn").on('click', function (){

// 		$("#teacher_create_modal").modal('show');

// 	});	/*  ./ teacher_create_btn   */


// });
// #####################################################################
// Ishreja ajax
// $(function(){
//     $("#ishreja_select").change(function(){

//       // $.post('.php',{id:$(this).val()},function(result){
//       //   $("#txtHint").html(result);
//       // });
//       alert("sa");
//     });
// });



