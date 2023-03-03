function error_checking(input_field){
  var error = false;
  $(input_field).each(function (index) {
    if($(this).hasClass('select2'))$(this).siblings(".select2-container").css('border', '1px solid #ced4da').css('border-radius', '.25rem');
    else $(this).css('border', '1px solid #ced4da');

    if($(this).val() == "" || $(this).val() == null){
      error = true;
      if($(this).is('checkbox')) return true;
      if($(this).hasClass('select2')) $(this).siblings(".select2-container").css('border', '1px solid red').css('border-radius', '.25rem');
      else $(this).css('border', '1px solid red');
    }
  })

  return error;
}

function clear_attributes(){
  $('.error').html("");
  $('.form-control').removeClass('is-invalid');

}

function clear_select(){
  $('.error').html("");
  $('.form-control').removeClass('is-invalid');

}

function clear_fields(){ 
  $('#validate_form')[0].reset();
  $('#validate_form').parsley().reset();
  $('.form-control')    
    .not('input:radio')
    .val('')
    .change()
    .css('border', '1px solid #ced4da')
    .siblings(".select2-container").css('border', '1px solid #ced4da').css('border-radius', '.25rem')
    .attr('readonly', false)
    .attr('disabled', false)
    .iCheck('uncheck');

  $('input:radio.form-control')
    .attr('readonly', false)
    .attr('disabled', false);
    
  $('input[type=checkbox]').prop("checked", false);

  $('input:checkbox.form-control')
    .iCheck('uncheck')
}

