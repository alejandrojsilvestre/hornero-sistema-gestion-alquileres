jQuery(document).ready(function() {
  $('#formAjustes').submit(function (e) {
      e.preventDefault();
      var id = $('[name="sucursal_id"]').val();
      var source = '/ajustes/'+id;
      var method = 'put';
      $.ajax({
          url: source,
          type: method,
          dataType: 'json',
          data: $(this).serialize()
        })
        .done(function(data, textStatus, jqXHR){
          addAlert('success','Los datos han sido guardados correctamente :)');
        })
        .fail(function(jqXHR, textStatus, errorThrown){ 
          addAlert('error','Error: No puedo procesarse el formulario :(');
        });
  });
    $('.btn-edit-logo').on('click',function(){
    $('#dropzonePhoto').click();
    $('.logo-img').toggleClass("hide");
      $('.logo-new').toggleClass("hide");
  })

  $('#formAjustes [type="submit"]').click(function(){
    var elms = [];
    $('input, textarea, select').each(function(){
      if ($(this).attr('tabindex') !== -1) {
        elms.push({
          elm: $(this),
          tabindex: parseInt($(this).attr('tabindex'))
        })
      }
    });
      elms.sortByObjectProperty('tabindex');
    for (var i = 0; i < elms.length; i++) {
      if (!elms[i].elm[0].checkValidity()) {
        var tabId = elms[i].elm.closest('.tab-pane').attr('id');
        $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
        return;
      }
    }
  });
});