$(function(){
    var d = new Date();
    var month = new Array();
    month[0] = "Yanvar";
    month[1] = "Fevral";
    month[2] = "Mart";
    month[3] = "Aprel";
    month[4] = "May";
    month[5] = "Iyun";
    month[6] = "Iyul";
    month[7] = "Avgust";
    month[8] = "Sentabr";
    month[9] = "Oktabr";
    month[10] = "Noyabr";
    month[11] = "Dekabr";
    var n = month[d.getMonth()];

    var computer_savodxonlik = $(document).find('.js_computer_savodxonlik').html();
    var corldrow             = $(document).find('.js_corldrow').html();
    var photoshop            = $(document).find('.js_photoshop').html();
    var web                  = $(document).find('.js_web').html();
    var java                 = $(document).find('.js_java').html();

    
    var chart_data = [
        { "group_name": "Kompyuter savodxonlik", "name": n, "value": computer_savodxonlik },
        { "group_name": "Corl draw", "name": n, "value": corldrow },
        { "group_name": "Photoshop", "name": n, "value": photoshop },
        { "group_name": "web dasturlash", "name": n, "value": web },
        { "group_name": "Java", "name": n, "value": java },
    ];

    $('#chtAnimatedBarChart').animatedBarChart({
        data: chart_data,
//                chart_height: 450,
        show_legend: true,
        x_grid_lines: true,
        tweenDuration: 1000,
        bars: {
            padding: 0.3, //efault bar group padding - type: number
            opacity: 0.7, //default bar opacity - type: number
            opacity_hover: 0.45, //default bar opacity on mouse hover - type: number
            disable_hover: false, //disable details on mouse hover - type: bool
            hover_name_text: 'Oy', //text for x axis value in details - type: string
            hover_value_text: "Soni" //text for y axis value in details - type: string
        },
        number_format: {
            format: ',.2f', // default chart number format - type: string
            decimal: ' ', // default symbol for the decimal separator - type: number
            thousands: ' ', // default symbol for the thousands separator - type: number
            grouping: [1], // default character grouping - type: object
            currency: ['$'] // default currency symbol - type: object
        },
               margin: {
                   top: 0, // default chart top margin - type: number
                   right: 15, // default chart right margin - type: number
                   bottom: 20, // default chart bottom margin - type: number
                   left: 30 // default chart left margin - type: number
               }
    });

});
