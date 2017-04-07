
    var codigoEmpleado;
    function obtenerCodigo(codigo) {
        codigoEmpleado = codigo.toString();
    }
    $("#btnProgramarReunion").click(function () {
        var dfdf = $("#timepicker").val();
        dfdf = $.trim(dfdf);
        var hora = convertTo24Hour($("#timepicker").val().toLowerCase());
        var horaConvertida = new Date();
        horaConvertida.setHours(parseInt(hora));
        horaConvertida.setMinutes(parseInt(hora.substr(4, 2)));
        var today = new Date();
        today.getDate();
        var fecha = $("#datepicker").val();
        var date = new Date();
        var dateArray = fecha.split("-")
        date.setFullYear(parseInt(dateArray[0]));
        date.setMonth(parseInt(dateArray[1]) - 1);  // months indexed as 0-11, substract 1
        date.setDate(parseInt(dateArray[2]));     // setDate sets the month of day
        var contTemas = 0;
        var contEmpleados = 0;
        $("input.temas:checkbox:checked").each(function () {
            if ($("input.temas:checkbox:checked")) {
                contTemas++;
            }
        });

        $("input.Empleados:checkbox:checked").each(function () {
            if ($("input.Empleados:checkbox:checked")) {
                contEmpleados++;
            }
        });
        horaConvertida.getTime();
        if (contEmpleados < 1 || contTemas < 1) {
            alert("Debe seleccionar al menos un empleado y un tema");
        } else {
            if (!isNaN(Date.parse(date))) {
                if (date < today) {
                    alert("La fecha no puede ser menor que la actual");
                } else if (date.getDate() == today.getDate() && date.getFullYear() == today.getFullYear() && date.getMonth() == today.getMonth() && horaConvertida.getTime() <= today.getTime()) {
                    alert("Si la reunion es hoy, la hora no puede ser menor que la actual");
                }
                else {
                    $("#programarReunionForm").submit();
                }
            } else {
                alert("Fecha Invalida");
            }

        }
    });

      $(function () {
          $('.button-checkbox2').each(function () {

              // Settings
              var $widget = $(this),
          $button = $widget.find('button'),
          $checkbox = $widget.find('input:checkbox'),
          color = $button.data('color'),
          settings = {
              on: {
                  icon: 'glyphicon glyphicon-check'
              },
              off: {
                  icon: 'glyphicon glyphicon-unchecked'
              }
          };

          function verificarDisponibilidad(codigoEmpleado, fechaReunion, horaReunion) {
              var url = "../Reuniones/obtenerDisponibilidadEmpleado?empleadoCodigo=" + codigoEmpleado + "&reunionFecha=" + fechaReunion + "&reunionHora=" + horaReunion;
              $.getJSON(url, null,
          function (data) {
              if (data.length === 0) {
                  $("#txtCodigoEmpleado");
                  $checkbox.prop('checked', !$checkbox.is(':checked'));
                  $checkbox.triggerHandler('change');
                 // $("#datepicker").prop('disabled', true);
                 // $("#timepicker").prop('disabled', true);
                  updateDisplay();
              } else {
                  $.each(data, function (i, item) {
                      if (item.IsBusy < 60) {
                          alert("Este empleado ya tiene reunion a las: " + item.HoraOcupada);
                      }
                  });
              }
          });
          }

              // Event Handlers
          $button.on('click', function () {
                  /*var respuesta =*/ verificarDisponibilidad(codigoEmpleado, $("#datepicker").val(), $("#timepicker").val());
                  /*if (respuesta === false) {
                      $("#txtCodigoEmpleado");
                      $checkbox.prop('checked', !$checkbox.is(':checked'));
                      $checkbox.triggerHandler('change');
                      updateDisplay();
                  }*/
              });
              $checkbox.on('change', function () {
                  updateDisplay();
              });

              // Actions
              function updateDisplay() {
                  var isChecked = $checkbox.is(':checked');

                  // Set the button's state
                  $button.data('state', (isChecked) ? "on" : "off");

                  // Set the button's icon
                  $button.find('.state-icon')
              .removeClass()
              .addClass('state-icon ' + settings[$button.data('state')].icon);

                  // Update the button's color
                  if (isChecked) {
                      $button
                  .removeClass('btn-default')
                  .addClass('btn-' + color + ' active');
                  }
                  else {
                      $button
                  .removeClass('btn-' + color + ' active')
                  .addClass('btn-default');
                  }
              }

              // Initialization
              function init() {

                  updateDisplay();

                  // Inject the icon if applicable
                  if ($button.find('.state-icon').length == 0) {
                      $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i>');
                  }
              }
              init();
          });
      });

      function convertTo24Hour(time) {
          var hours = parseInt(time.substr(0, 2));
          if (time.indexOf('am') != -1 && hours == 12) {
              time = time.replace('12', '0');
          }
          if (time.indexOf('pm') != -1 && hours < 12) {
              time = time.replace(hours, (hours + 12));
          }
          return time.replace(/(am|pm)/, '');
      }
