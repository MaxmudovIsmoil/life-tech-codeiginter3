$(document).ready(function() {

    setInterval(function(){
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();

        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;
        hours = (hours < 10 ? "0" : "") + hours;

        var currentTimeString = hours + ":" + minutes + ":" + seconds;
        $("#timer").html(currentTimeString);

    },1000);


    // Data Table jquery plugins
    $(function () {
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
        });
    });

    /** Bir kun oldingi dars jadval */
    $('.js_prev_date').click(function(){
        var teacher_id = $('.js_teacher_timetable_data').data('teacher_id');
        var datetime = $('.js_teacher_timetable_data').html();
        var timetable_date = $('.js_timetable_date');

        var data = {
          'teacher_id': teacher_id,
          'datetime':   datetime,
        };

        $.post("ajax_prev_dars_jadval", data, function (res) {
            $("#js_dars_jadval_row").html(res['html']);
            $('.js_teacher_timetable_data').html(res['datetime']);
            timetable_date.html(res['date']);
        }, "json");
    });



    /** Bir kun keyingi dars jadval */
    $('.js_next_date').click(function(){
        var teacher_id = $('.js_teacher_timetable_data').data('teacher_id');
        var datetime = $('.js_teacher_timetable_data').html();
        var timetable_date = $('.js_timetable_date');

        var data = {
            'teacher_id': teacher_id,
            'datetime':   datetime,
        };

        $.post("ajax_next_dars_jadval", data, function (res) {
            $("#js_dars_jadval_row").html(res['html']);
            $('.js_teacher_timetable_data').html(res['datetime']);
            timetable_date.html(res['date']);
        }, "json");

    });


    /** Guruhdagi o'quvchilarni davoamti uchun modal oynada ko'rsatish */
    $(document).on("click", ".js_dars_jadval_student_davomat", function () {

        var $this           = $(this);
        var guruh_nomi      = $this.html();
        var guruh_id        = $this.data('guruhId');
        var js_guruh_time   = $this.data('soat');               // guruhga saot nechidan nechigacha dars bolishi

        /** Modal oynaga chiqarish uchun */
        var datetime = $('.js_timetable_date').html();   // kun oy hafta

        /** bazaga journaldagi kunga yozish uchun  dars jadvaldadan oladi */
        var kun = $('.js_teacher_timetable_data').html();

        $('h5.modal-title').html(guruh_nomi);
        $('.js_datetime_model .js_date_model').html(datetime);
        $('.js_datetime_model .js_time_model').html(js_guruh_time);


        var data = {
          'guruh_id':guruh_id,
          'kun':     kun,
        };

        $.post('ajax_guruh_oquvchilari', data, function(res) {
            $('.davomat_modal_body').html(res);
        }, "json");
    });


    /** Modal oynadagi bor yo'qni bosilganda ajax orqali bazaga yozib keladi */
    $(document).on("click", ".js_davomat_btn", function () {
        var $this = $(this);
        var student_id = $this.data('studentId');
        var journal_id = $this.data('journalId');

        var davomat = 0;
        if($this.hasClass('btn-danger')) {
            $this.removeClass('btn-danger');
            $this.addClass('btn-success');
            $this.html('Bor <i class="fas fa-user-check"></i>');
            davomat = 1;
        }
        else if($this.hasClass('btn-success')) {
            $this.removeClass('btn-success');
            $this.addClass('btn-danger');
            $this.html('Yo\'q <i class="fas fa-user-times"></i>');
            davomat = 0;
        }

        var data = {
            'journal_id': journal_id,
            'student_id': student_id,
            'status':     davomat,
        };

        /** journal_detailsga studentni kelgan kelmaganligini yozib qo'yish */
        $.post('ajax_student_davomat', data, function(res) {
            console.log(res);
        }, "json");

    });




    /** guruh_students  sahifasidagi o'quvchilarni davoamtini modal oynada ko'rish */
    $(document).on('click', '.js_davomat_views', function() {
        var $this = $(this);
        var familiya = $this.data('familiya');
        var ism      = $this.data('ism');
        $('.modal_davomat_views h5').html(familiya+" "+ism);

    });


    /** active guruhdagi o'quvchilarni davomati term_pagination ajax */
    $('.js_term_pagination').click(function(e){
        e.preventDefault();
        var term        = $(this).data('term');
        var guruh_id    = $(this).data('guruhId');

        $(document).find('.js_term_pagination').removeClass('active_term_btn');
        $(this).addClass('active_term_btn');

        var js_guruh_davomat_ajax = $(document).find('#js_guruh_once_davomat_'+guruh_id);

        console.log(term);
        console.log(guruh_id);
        var data = {'guruh_id' : guruh_id, "term": term};

        $.post("ajax_guruh_term", data, function (res) {
            js_guruh_davomat_ajax.html(res);
            console.log(res);
        }, "json");
    })


});
