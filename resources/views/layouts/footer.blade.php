     <!-- Main Footer -->
     <footer class="main-footer">
        <strong>Copyright &copy; 2024 - Tugas Akhir - Jesica Kristovani Siagian</strong>
        All rights reserved.
      </footer>
    </div>
    <!-- ./wrapper -->
    
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE') }}/dist/js/adminlte.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('AdminLTE') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE') }}/plugins/chart.js/Chart.min.js"></script>
    
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('AdminLTE') }}/dist/js/pages/dashboard2.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('AdminLTE') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>   
<script>
    $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */
  
      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.

      // dataset
      var donutData        = {
      labels: [
          'Positif',
          'Negatif',
      ],
      datasets: [
        {
          data: [{{ ($title == "Naive Bayes") ? $datasetPositif : '' }}, {{ ($title == "Naive Bayes") ? $datasetNegatif : '' }}],
          backgroundColor : ['#00a65a', '#f56954'],
        }
      ]
    }
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData        = donutData;
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })

      // data latih
      var donutData1        = {
      labels: [
          'Positif',
          'Negatif',
      ],
      datasets: [
        {
          data: [{{ ($title == "Naive Bayes") ? $labelPositifLatih : '' }}, {{ ($title == "Naive Bayes") ? $labelNegatifLatih : '' }}],
          backgroundColor : ['#00a65a', '#f56954'],
        }
      ]
    }
      var pieChartCanvas = $('#pieChart1').get(0).getContext('2d')
      var pieData        = donutData1;
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })

      // data uji
      var donutData2        = {
      labels: [
          'Positif',
          'Negatif',
      ],
      datasets: [
        {
          data: [{{ ($title == "Naive Bayes") ? $labelPositifUji : '' }}, {{ ($title == "Naive Bayes") ? $labelNegatifUji : '' }}],
          backgroundColor : ['#00a65a', '#f56954'],
        }
      ]
    }
      var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
      var pieData        = donutData2;
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })
      
    })
  </script>

      

</body>