var num = "zero one two three four five six seven eight nine ten eleven twelve thirteen fourteen fifteen sixteen seventeen eighteen nineteen".split(" ");
var tens = "twenty thirty forty fifty sixty seventy eighty ninety".split(" ");




$(document).ready(function() {
  $('.summernote').summernote({
    height: 500,
    toolbar: [
      ['style', ['bold', 'italic', 'underline']],
      ['table', ['table']]
    ],
  })
})
  function goBack() {
    window.history.back();
  }



function error_checking(input_field){
  var error = false;
  $(input_field).each(function (index) {
    reset_input_css(input_field);
    if($(this).val() == "" || $(this).val() == null){
      error = true;
      if($(this).is('checkbox')) return true;
      if($(this).hasClass('select2')) $(this).siblings(".select2-container").css('border', '1px solid red').css('border-radius', '.25rem');
      else $(this).css('border', '1px solid red');
    }
  })

  return error;
}

function reset_input_css(input_field) {
  if($(input_field).hasClass('select2'))$(input_field).siblings(".select2-container").css('border', '1px solid #ced4da').css('border-radius', '.25rem');
  else $(input_field).css('border', '1px solid #ced4da');
}
function is_value_null(value){
    if(value == null || value == '') return true;
    else return false;
}

function show_element_error_notif(element, content) {
    $(element).css('border', '1px solid red')
}

function show_notif(content) {
    $.alert({
      title: 'Notification',
      content: content
    })
}

function number2words(n){
    if (n < 20) return num[n];
    var digit = n%10;
    if (n < 100) return tens[~~(n/10)-2] + (digit? "-" + num[digit]: "");
    if (n < 1000) return num[~~(n/100)] +" hundred" + (n%100 == 0? "": " " + number2words(n%100));
    return number2words(~~(n/1000)) + " thousand" + (n%1000 != 0? " " + number2words(n%1000): "");
}

function display_element(element) {
	$(element).removeClass('d-none')
    $(element).addClass('d-block')
}

function hide_element(element) {
	$(element).removeClass('d-block')
    $(element).addClass('d-none')
}

function print_element(element) {
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+element+'</body></html>');
  newWin.document.close();
}