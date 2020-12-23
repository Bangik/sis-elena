$(document).ready(function(){
  animasiIntro();
});
function animasiIntro() {
  $(".text span").velocity("transition.slideLeftIn",{
    stagger: 50,
    complete: function(){
      animasiBtn();
    }
  });
};
function animasiBtn(){
  $(".start").velocity("transition.bounceUpIn")
    .mouseenter(function(){
      $(this).velocity({width:100});
    })
    .mouseleave(function(){
      $(this).velocity({width:125});
    });
};
function animasiIntroOut(){
  $(".start").velocity("transition.whirlOut",{
    stagger: 150
  })
  $(".text").velocity("transition.whirlOut",{
    stagger: 150,
    complete: function(){
      $(".box-overlay").hide();
      callMenu();
    }
  })
}
function callMenu(){
  $(".navbar").velocity("transition.slideLeftIn",{
    stagger: 200
  });
  $(".cardss").velocity("transition.slideDownIn",{
    stagger: 200
  });
  $(".footer p").velocity("transition.slideLeftIn",{
    stagger: 200
  });
}
