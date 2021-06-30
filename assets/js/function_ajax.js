$(document).ready(function () {

    let btn_chiqms = $(document).find('.js_btn_chiqm');
    btn_chiqms.first().removeClass('btn-secondary')
    btn_chiqms.first().addClass('btn-primary')

    $(document).on('click', '.js_btn_chiqm', function(e) {
        e.preventDefault()

        $(this).siblings().removeClass('btn-primary')
        $(this).siblings().addClass('btn-secondary')
        $(this).removeClass('btn-secondary')
        $(this).addClass('btn-primary')

        let url = $(this).attr('href')

        let tbody = $('.js_tbody')

        $.ajax({
            type:"POST",
            url: url,
            // data: formData,
            success: (response) => {

                $('.js_this_tr').remove();
                if (response)
                    tbody.html(response)
            },
            error: (response) => {
                console.log(response);
            }
        });


    });


    $(document).on('submit', '.js_edit_form_expense', function(e) {
        e.preventDefault()

        let form = $(this).serialize()
        let url = $(this).attr('action')

        let modal = $(this).closest('.modal')
        let this_parent = $(this).closest('.this_parent')

        console.log(this_parent.html())


        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serialize(),
            success: (response) => {


                let data = JSON.parse(response);
                if (data.success){
                    console.log(data.success)
                }
                // }
                // $('.js_this_tr').remove();
                // if (response)
                //     tbody.html(response)
            },
            error: (response) => {
                console.log(response);
            }
        });

    })


});