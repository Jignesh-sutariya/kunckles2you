var url = $("#base_url").val();
var dataTableUrl = $("#dataTableUrl").val();
type = ['primary', 'info', 'success', 'warning', 'danger'];
// $(document).ready(function() {
  var input = $("form").first().find(':input').first().attr('id');
  $("#"+input).focus();
  var table = $('.datatable').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      /*dom: 'Bfrtip',
      buttons: [
          'pageLength',
          {
              extend: 'print',
              footer: true,
              exportOptions: {
                  columns: ':visible'
              },
          },
          {
              extend: 'csv',
              footer: true,
              exportOptions: {
                  columns: ':visible'
              },
          },
          'colvis'
      ],
      columnDefs: [ {
          targets: -1,
          visible: false
      } ],*/
      "processing": true,
      "serverSide": true,
      'language': {
          'loadingRecords': '&nbsp;',
          'processing': 'Processing',
          'paginate': {
              'first': '|',
              'next': '<i class="fa fa-arrow-circle-right"></i>',
              'previous': '<i class="fa fa-arrow-circle-left"></i>',
              'last': '|'
          }
      },
      "order": [],
      "ajax": {
          url: dataTableUrl,
          type: "POST",
          data: function(data) {
            data.status = $("#status").val();
            data.o_date = $("#o_date").val();
          },
          complete: function(response) {
          },
      },
      "columnDefs": [{
          "targets": "target",
          "orderable": false,
      },]
  });

  $('.live-preview-button').on('click',function (e) {
      e.preventDefault();
      window.open($(this).attr('href'), "live-preview-button", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no,display=popup, width=380, height=' + screen.height + ', top=0, left=0');
  });
  
  setFormValidation('#validateForm');

  $('.timepicker').datetimepicker({
    //          format: 'H:mm',    // use this format if you want the 24hours timepicker
    format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
    icons: {
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-screenshot',
      clear: 'fa fa-trash',
      close: 'fa fa-remove'
    }
  });

  $('.datepicker').datetimepicker({
    format: 'DD-MM-YYYY',
    icons: {
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-screenshot',
      clear: 'fa fa-trash',
      close: 'fa fa-remove'
    }
  });

  $('#o_date').on("dp.hide",function (e) {
      table.ajax.reload();
  });

    /*$("#day").change(function() {
      if (this.value != '') {
        var dependent = $(this).data('dependent');
        var items = $(this).data('items');
        $.ajax({
            url: dataTableUrl+'/getItems?day=' + this.value,
            type: 'GET',
            async: false,
            success: function(result) {
              $("#"+dependent).html(result);
              // $('#'+dependent).val(val);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#"+dependent).html('<option disabled> Multiple Items</option>');
            }
        });
      }
      else $("#"+dependent).html('<option disabled> Multiple Items</option>');
    });

    $("#day").trigger('change');*/
// });

function setFormValidation(id) {
  $(id).validate({
    highlight: function(element) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
      $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
    },
    unhighlight: function(element) {
      $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
      $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
    },
    success: function(element) {
      $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
      $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
    },
    errorPlacement: function(error, element) {
      return true;
    },
  });
}

script = {
  logout: function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Are you sure to logout?",
        icon: 'warning',
        showCancelButton: true,
        customClass: {
          confirmButton: 'btn btn-outline-success',
          cancelButton: 'btn btn-outline-danger'
        },
        buttonsStyling: false,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value)
          window.location = url+'logout'
      });
  },
  showNotification: function(from, align, message, color) {
    $.notify({
      icon: 'nc-icon nc-bell-55',
      message: message
    }, {
      type: color,
      timer: 3000,
      placement: {
        from: from,
        align: align
      }
    });
  },
  delete: function(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure remove this item?",
      icon: 'warning',
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-outline-success',
        cancelButton: 'btn btn-outline-danger'
      },
      buttonsStyling: false,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) $("#"+id).submit();
      else return false;
    });
  },
  availability: function(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure to change availability?",
      icon: 'warning',
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-outline-success',
        cancelButton: 'btn btn-outline-danger'
      },
      buttonsStyling: false,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) $("#avail_"+id).submit();
      else return false;
    });
  },
  status: function(status) {
    $("#status").val(status);
    table.ajax.reload();
  },
  changeStatus: function(id) {
    $("#order_id").val(id);
    table.ajax.reload();
  },
};