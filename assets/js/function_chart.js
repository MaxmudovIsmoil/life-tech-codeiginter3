$(function() {
      var chart_data = getData();

      var options = {
         data: chart_data, // data for chart rendering
         params: { // columns from data array for rendering graph
            group_name: 'company', // title for group name to be shown in legend
            name: 'month', // name for xaxis
            value: 'employees_no' // value for yaxis
         },
         horizontal_bars: false, // default chart orientation
         chart_height: 400, // default chart height in px
         colors: null, // colors for chart
         show_legend: true, // show chart legend
         legend: { // default legend settings
            position: LegendPosition.bottom, // legend position (bottom/top/right/left)
            width: 200 // legend width in pixels for left/right
         },
         x_grid_lines: false, // show x grid lines
         y_grid_lines: true, // show y grid lines
         tweenDuration: 300, // speed for tranistions
         bars: { // default bar settings
            padding: 0.075, // padding between bars
            opacity: 0.7, // default bar opacity
            opacity_hover: 0.45, // default bar opacity on mouse hover
            disable_hover: false, // disable animation and legend on hover
            hover_name_text: 'name', // text for name column for label displayed on bar hover
            hover_value_text: 'value', // text for value column for label displayed on bar hover
         },
         number_format: { // default locale for number format
            format: ',.2f', // default number format
            decimal: '.', // decimal symbol
            thousands : ',', // thousand separator symbol
            grouping: [3], // thousand separator grouping
            currency: ['$'] // currency symbol
         },
         margin: { // margins for chart rendering
            top: 0, // top margin
            right: 35, // right margin
            bottom: 20, // bottom margin
            left: 70 // left margin
         },
         rotate_x_axis_labels: { // rotate xaxis label params
            process: true, // process xaxis label rotation
            minimun_resolution: 720, // minimun_resolution for label rotating
            bottom_margin: 15, // bottom margin for label rotation
            rotating_angle: 90, // angle for rotation,
            x_position: 9, // label x position after rotation
            y_position: -3 // label y position after rotation
         }
      };

      $('#chartReyting').animatedBarChart(options);
   });

   getData = function() {
      return [
         { "company": "Google", "month": "Jan", "employees_no": 38367 },
         { "company": "Google", "month": "Feb", "employees_no": 32684 },
         { "company": "Google", "month": "Mar", "employees_no": 28236 },
         { "company": "Google", "month": "Apr", "employees_no": 44205 },
         { "company": "Google", "month": "May", "employees_no": 3357 },
         { "company": "Google", "month": "Jun", "employees_no": 3511 },
         { "company": "Google", "month": "Jul", "employees_no": 10372 },
         { "company": "Google", "month": "Aug", "employees_no": 15565 },
         { "company": "Google", "month": "Sep", "employees_no": 23752 },
         { "company": "Google", "month": "Oct", "employees_no": 28927 },
         { "company": "Google", "month": "Nov", "employees_no": 21795 },
         { "company": "Google", "month": "Dec", "employees_no": 49217 },
         { "company": "Apple", "month": "Jan", "employees_no": 28827 },
         { "company": "Apple", "month": "Feb", "employees_no": 13671 },
         { "company": "Apple", "month": "Mar", "employees_no": 27670 },
         { "company": "Apple", "month": "Apr", "employees_no": 6274 },
         { "company": "Apple", "month": "May", "employees_no": 12563 },
         { "company": "Apple", "month": "Jun", "employees_no": 31263 },
         { "company": "Apple", "month": "Jul", "employees_no": 24848 },
         { "company": "Apple", "month": "Aug", "employees_no": 41199 },
         { "company": "Apple", "month": "Sep", "employees_no": 18952 },
         { "company": "Apple", "month": "Oct", "employees_no": 30701 },
         { "company": "Apple", "month": "Nov", "employees_no": 16554 },
         { "company": "Apple", "month": "Dec", "employees_no": 36399 },
         { "company": "Microsoft", "month": "Jan", "employees_no": 38674 },
         { "company": "Microsoft", "month": "Feb", "employees_no": 9595 },
         { "company": "Microsoft", "month": "Mar", "employees_no": 7520 },
         { "company": "Microsoft", "month": "Apr", "employees_no": 2568 },
         { "company": "Microsoft", "month": "May", "employees_no": 6583 },
         { "company": "Microsoft", "month": "Jun", "employees_no": 44485 },
         { "company": "Microsoft", "month": "Jul", "employees_no": 3405 },
         { "company": "Microsoft", "month": "Aug", "employees_no": 31709 },
         { "company": "Microsoft", "month": "Sep", "employees_no": 45442 },
         { "company": "Microsoft", "month": "Oct", "employees_no": 37580 },
         { "company": "Microsoft", "month": "Nov", "employees_no": 23445 },
         { "company": "Microsoft", "month": "Dec", "employees_no": 7554 },
         { "company": "Samsung", "month": "Jan", "employees_no": 40110 },
         { "company": "Samsung", "month": "Feb", "employees_no": 35605 },
         { "company": "Samsung", "month": "Mar", "employees_no": 15768 },
         { "company": "Samsung", "month": "Apr", "employees_no": 15075 },
         { "company": "Samsung", "month": "May", "employees_no": 12424 },
         { "company": "Samsung", "month": "Jun", "employees_no": 12227 },
         { "company": "Samsung", "month": "Jul", "employees_no": 40906 },
         { "company": "Samsung", "month": "Aug", "employees_no": 34032 },
         { "company": "Samsung", "month": "Sep", "employees_no": 18110 },
         { "company": "Samsung", "month": "Oct", "employees_no": 4755 },
         { "company": "Samsung", "month": "Nov", "employees_no": 42202 },
         { "company": "Samsung", "month": "Dec", "employees_no": 36183 }
      ];
   }