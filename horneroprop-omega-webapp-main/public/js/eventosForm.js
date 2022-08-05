var statusAjax=false;
jQuery(document).ready(function() {
    $('.nuevoEvento').on('click', function (e){
      resetFormEvento();
    })
    $('#t_dia').on('change', function (e){
      if($(this).is(':checked')){
        $.each($('.fechasEventos .m_datetimepicker_1'), function () {
          $(this).datetimepicker("remove");
          var date= $(this).val();
          var dateSplit = date.split(' ');
          $(this).val(dateSplit[0]);
          $(this).datepicker();
        });
      }
      else{
        $(this).datepicker("remove");
        $(this).datetimepicker();
      }
    })

    $('#formEvento').submit(function (e) {
        e.preventDefault();
        var id = $('[name="evento_id"]').val();
        var source = '/eventos';
        var method = 'post';
        if(id.length>0){
            source+= '/'+id;
            method = 'put';
        }
        $.ajax({
            url: source,
            type: method,
            dataType: 'json',
            data: $(this).serialize(),
          })
          .done(function(data, textStatus, jqXHR){
             if(controller=='eventos'){
                CalendarExternalEvents.Refresh();
            }

            $('[name="id"]').val(data.id);
            addAlert('success','El evento ha sido guardado correctamente :)');
            $('#_formEvento').modal('hide');
            $('#formEvento').trigger("reset");
          })
          .fail(function(jqXHR, textStatus, errorThrown){ 
            addAlert('error','Error: No puedo procesarse el formulario :(');
          });
    });
    $('.btnExcange').on('click',exchangeDireccion);
    $('input[name=inicio]').on('changeDate', function(ev){
        if(!$('#t_dia').is(':checked')){
          var d=new Date(strtotimeCalendar($(this).val()));
          d.setHours(d.getHours() + 1);
          var fecha=getDay(d)+'-'+getMonth(d)+'-'+d.getFullYear()+ ' '+ d.getHours()+':'+d.getMinutes();
          $('input[name=fin]').val(fecha);
        }else{
          $('input[name=fin]').val($('input[name=inicio]').val());
        }
    });

});


function getDay(date) {
  var day = date.getDate();
  return day < 10 ? '0' + day : '' + day; // ('' + month) for string result
}  
function getMonth(date) {
  var month = date.getMonth() + 1;
  return month < 10 ? '0' + month : '' + month; // ('' + month) for string result
}  
function getMonth(date) {
  var month = date.getMonth() + 1;
  return month < 10 ? '0' + month : '' + month; // ('' + month) for string result
}  
function strtotimeCalendar(date) {
  var dateSplit = date.split(' ');
  var fecha=dateSplit[0].split('-');
  if(dateSplit[1]){
    var tiempo=dateSplit[1];
    return fecha[2]+'-'+fecha[1]+'-'+fecha[0]+' '+tiempo;
  }else{
    return fecha[2]+'-'+fecha[1]+'-'+fecha[0];
  }
}
function exchangeDireccion(){


    //No use el display: none porque rompe el SELECT2. 
    if($('.evento_direccion').css('opacity')=='0'){
        $('.evento_inmueble').css('height','0px');
        $('.evento_inmueble').css('opacity','0');

        $('.evento_direccion').css('opacity','1');
        $('.evento_direccion').css('height','auto');
    }else{
        $('.evento_inmueble').css('opacity','1');
        $('.evento_inmueble').css('height','auto');

        $('.evento_direccion').css('height','0px');
        $('.evento_direccion').css('opacity','0');
    }

    //LIMPIO LOS CAMPOS
    $('#inmuebles').val('');
    $('#inmuebles').trigger('change'); 
    $('input[name=direccion]').val('');
}
function updateEvento(data){
  resetFormEvento();
  $('#_formEvento').modal('show');
  $.each(data, function (key, value) {
      if(key=='id'){
          $('#formEvento [name=evento_id]').val(value);
      }else if(key=='notas'){
          $('textarea[name='+key+']').trumbowyg('html',value);
      }else{
          $('#formEvento [name=' + key + ']').val(value);
      }

      //trae las personas asociadas.
      if(key=='personas'){
          $.each(value, function (keyPersona, valuePersona) {
              $("#formEvento #personas").append('<option selected value="'+valuePersona.id+'">'+valuePersona.nombre+' '+valuePersona.apellido+'</option>').select2(); 
          });
      }

      //trae los inmuebles asociados
      if(key=='inmuebles'){
          $.each(value, function (keyPersona, valuePersona) {
              $("#formEvento #inmuebles").append('<option selected value="'+valuePersona.id+'">'+valuePersona.direccion+'</option>').select2(); 
          });
      }

      //trae los inmuebles asociados
      if (key === 'users') {
				$('#formEvento #users').val(value);
      }
      //en caso que no tenga asociado un inmueble, muestra el campo direccion
      if(key=='direccion' && value){
          if($('.evento_direccion').css('opacity')!=1)
              $('.btnExcange').click();
      }
  });
  $('#formEvento select').trigger('change');
}
function resetFormEvento(){
  $('#formEvento').trigger("reset");
  $('#formEvento #motivo_id').val('');
  $('#formEvento #direccion').val('');
  $('#formEvento #personas').val('');
  $('#formEvento #users').val('');
  $('#formEvento textarea[name=notas]').trumbowyg('html','');
  //le pongo predeterminado para que elijan ficha.
  if($('#formEvento .evento_direccion').css('opacity')==1)
    $('#formEvento .btnExcange').click();
  $('#formEvento select').trigger('change');
}