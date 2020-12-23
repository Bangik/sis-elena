$(document).ready(function(){
  $('.cardss').each(function(i){
    setTimeout(function(){
      $('.cardss').eq(i).addClass('muncul');
    }, 100 * i)
  })
})
