if (window.jQuery && $.fn && $.fn.DataTable) {
  $(document).ready(function() {
    if (document.getElementById('datatable')) {
      $("#datatable").DataTable();
    }
    if (document.getElementById('datatable-buttons')) {
      $("#datatable-buttons").DataTable({
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf", "colvis"]
      }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
    }
    $(".dataTables_length select").addClass("form-select form-select-sm");
  });
} else {
  try { console.warn('DataTables not available; skipping datatables.init'); } catch (e) {}
}