$(document).ready(function(){
  transitionAnimate();
});

function transitionAnimate(){
  $('.cardss').each(function(i){
    setTimeout(function(){
      $('.cardss').eq(i).addClass('muncul');
    }, 100 * i);
  });
}
