<script src="{{ asset('admin') }}/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="{{ asset('admin') }}/js/popper.min.js"></script>
<!-- bootstarp js -->
<script src="{{ asset('admin') }}/js/bootstrap.min.js"></script>
<!-- sidebar menu  -->
<script src="{{ asset('admin') }}/js/metisMenu.js"></script>
<!-- waypoints js -->
<script src="{{ asset('admin') }}/vendors/count_up/jquery.waypoints.min.js"></script>
<!-- waypoints js -->
<script src="{{ asset('admin') }}/vendors/chartlist/Chart.min.js"></script>
<!-- counterup js -->
<script src="{{ asset('admin') }}/vendors/count_up/jquery.counterup.min.js"></script>

<!-- nice select -->
<script src="{{ asset('admin') }}/vendors/niceselect/js/jquery.nice-select.min.js"></script>
<!-- owl carousel -->
<script src="{{ asset('admin') }}/vendors/owl_carousel/js/owl.carousel.min.js"></script>

<!-- responsive table -->
<script src="{{ asset('admin') }}/vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin') }}/vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('admin') }}/vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('admin') }}/vendors/datatable/js/buttons.flash.min.js"></script>
<script src="{{ asset('admin') }}/vendors/datatable/js/jszip.min.js"></script>
<script src="{{ asset('admin') }}/vendors/datatable/js/pdfmake.min.js"></script>
<script src="{{ asset('admin') }}/vendors/datatable/js/vfs_fonts.js"></script>
<script src="{{ asset('admin') }}/vendors/datatable/js/buttons.html5.min.js"></script>
<script src="{{ asset('admin') }}/vendors/datatable/js/buttons.print.min.js"></script>

<!-- datepicker  -->
<script src="{{ asset('admin') }}/vendors/datepicker/datepicker.js"></script>
<script src="{{ asset('admin') }}/vendors/datepicker/datepicker.en.js"></script>
<script src="{{ asset('admin') }}/vendors/datepicker/datepicker.custom.js"></script>

<script src="js/chart.min.js"></script>
<script src="{{ asset('admin') }}/vendors/chartjs/roundedBar.min.js"></script>

<!-- progressbar js -->
<script src="{{ asset('admin') }}/vendors/progressbar/jquery.barfiller.js"></script>
<!-- tag input -->
<script src="{{ asset('admin') }}/vendors/tagsinput/tagsinput.js"></script>
<!-- text editor js -->
<script src="{{ asset('admin') }}/vendors/text_editor/summernote-bs4.js"></script>
<script src="{{ asset('admin') }}/vendors/am_chart/amcharts.js"></script>

<!-- scrollabe  -->
<script src="{{ asset('admin') }}/vendors/scroll/perfect-scrollbar.min.js"></script>
<script src="{{ asset('admin') }}/vendors/scroll/scrollable-custom.js"></script>

<!-- vector map  -->
<script src="{{ asset('admin') }}/vendors/vectormap-home/vectormap-2.0.2.min.js"></script>
<script src="{{ asset('admin') }}/vendors/vectormap-home/vectormap-world-mill-en.js"></script>

<!-- apex chrat  -->
<script src="{{ asset('admin') }}/vendors/apex_chart/apex-chart2.js"></script>
<script src="{{ asset('admin') }}/vendors/apex_chart/apex_dashboard.js"></script>

<script src="{{ asset('admin') }}/vendors/echart/echarts.min.js"></script>


<script src="{{ asset('admin') }}/vendors/chart_am/core.js"></script>
<script src="{{ asset('admin') }}/vendors/chart_am/charts.js"></script>
<script src="{{ asset('admin') }}/vendors/chart_am/animated.js"></script>
<script src="{{ asset('admin') }}/vendors/chart_am/kelly.js"></script>
<script src="{{ asset('admin') }}/vendors/chart_am/chart-custom.js"></script>
<!-- custom js -->
<script src="{{ asset('admin') }}/js/dashboard_init.js"></script>
<script src="{{ asset('admin') }}/js/custom.js"></script>



<script>

$(document).ready(function(){
    $('#data').after('<div id="nav"></div>');
    var rowsShown = 20;
    var rowsTotal = $('#data tbody tr').length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#data tbody tr').hide();
    $('#data tbody tr').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function(){

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});
</script>