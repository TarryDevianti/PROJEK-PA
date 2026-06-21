<footer class="app-footer">
  <!--begin::Copyright-->
  <strong>
    Copyright &copy;
    <span id="year"></span>&nbsp;
  </strong>
  All rights reserved.
  <!--end::Copyright-->
</footer>
<!--end::Footer-->
</div>
<!--end::App Wrapper-->

<!--begin::Script-->
<script
  src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
></script>

<script
  src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
></script>

<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
></script>

<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>

<!-- Script Tahun Real Time -->
<script>
  document.getElementById("year").textContent = new Date().getFullYear();
</script>

<!-- OverlayScrollbars -->
<script>
  const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
  const Default = {
    scrollbarTheme: 'os-theme-light',
    scrollbarAutoHide: 'leave',
    scrollbarClickScroll: true,
  };
  document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
    if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        scrollbars: {
          theme: Default.scrollbarTheme,
          autoHide: Default.scrollbarAutoHide,
          clickScroll: Default.scrollbarClickScroll,
        },
      });
    }
  });
</script>

<!-- OPTIONAL SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"></script>

<script>
  const sales_chart_options = {
    series: [
      { name: 'Digital Goods', data: [28, 48, 40, 19, 86, 27, 90] },
      { name: 'Electronics', data: [65, 59, 80, 81, 56, 55, 40] },
    ],
    chart: { height: 180, type: 'area', toolbar: { show: false } },
    legend: { show: false },
    colors: ['#0d6efd', '#20c997'],
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth' },
    xaxis: {
      type: 'datetime',
      categories: [
        '2023-01-01','2023-02-01','2023-03-01',
        '2023-04-01','2023-05-01','2023-06-01','2023-07-01',
      ],
    },
    tooltip: { x: { format: 'MMMM yyyy' } },
  };

  new ApexCharts(document.querySelector('#sales-chart'), sales_chart_options).render();
</script>
<!--end::Script-->
</body>
</html>