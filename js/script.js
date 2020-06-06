$(document).ready(function(){
  // Navigation toggle on mobile
  $('#toggleNav').on('click', function(){
    $('#navBar ul').toggleClass('navShow');
  });

  // For focus event of feedback section
  $('#feedbackSection input, #feedbackSection textarea').on('focus', function(){
    $(this).addClass('focus');
  });

  $('#feedbackSection input, #feedbackSection textarea').on('blur', function(){
    var value = $.trim($(this).val());
    if(value == '')
    {
      $(this).removeClass('focus');
    }
    else{
      $(this).addClass('focus');
    }
  });
  // ------------------------------------------------------

  // Start brands image slideshow
  slideshow();

  // get dropdown list for booking.PHP
  $('#brand').on('change', function(){
    var brand = $(this).val();
    $.ajax({
      method: 'post',
      data: {brand:brand},
      url: 'dropdown.php',
      success: function(data)
      {
        $('#model').html(data);
      }
    });
  });

  // TRIGGER LOGIN BOX
  $('#loginTrigger').on('click', function(e){
    e.preventDefault();
    $('#loginRegister').slideDown(250);
  });
  $('#loginClose').on('click', function(e){
    e.preventDefault();
    $('#loginRegister').slideUp(250);
  });

  // Backflip TRIGGER
  $('.frontside').on('click', function(e){
    e.preventDefault();
    $(this).css('transform', 'rotateY(-180deg)');
    $(this).siblings().css('transform', 'translate(-50%, -50%) rotateY(0deg)');
  });

  $('.backside').on('click', function(e){
    $(this).css('transform', 'translate(-50%, -50%) rotateY(-180deg)');
    $(this).siblings().css('transform', 'rotateY(0deg)');
  });

});//--------Ready function end------------------------------------------------------------------------

/* Function for slideshow animation on index.php */
var index = 0;
function slideshow(){
  if(index > 2){
    index = 0;
  }

  $('.slides').removeClass('currentSlide');
  $('.slides').eq(index).addClass('currentSlide');
  index++;
  setTimeout(slideshow, 4000);
}

/* Stick navigation when page scroll >= 50px  all pages */
$(window).scroll(function(){
  var pageScroll = window.pageYOffset;
  var topNavHeight = $('#topNav').height();
  var heroSection = $('#heroSection').height();

  if(pageScroll > topNavHeight)
  {
    $('#navBar').addClass('stickyNav');
  }
  else{
    $('#navBar').removeClass('stickyNav');
  }

});


/* Remove Loader */
window.addEventListener('load', function(){
  $('#loaderContainer').remove();
});

/* function to process form -- BOOKING.PHP */
var brand, model, vehicleNo, service, waxing, fname, lname, mobile, email="", address, vehicleType;
function processPhase1(){
  brand = $('#brand').val();
  model = $('#model').val();
  vehicleNo = $('#vehicleNo').val();

  if(brand == 0 || model == 0){
    $('#errorLog').html('Select brand & model');
  }
  else if(vehicleNo == undefined || vehicleNo == ''){
    $('#errorLog').html('Please give vehicle No.');
  }
  else{
    $('#phase1').removeClass('show');
    $('#phase2').addClass('show');
    $('#multiphaseBook #d2').css('background', '#56b426');
    $('#errorLog').html('');
  }
}

function processPhase2(){
  service = $('#selectService').val();
  waxing = $('#waxing').val();
  if(service == '' || service == undefined)
  {
    $('#errorLog').html('Please select service');
  }
  else if(waxing == '' || waxing == undefined){
    $('#errorLog').html('Something went wrong!');
  }
  else
  {
    $('#phase2').removeClass('show');
    $('#phase3').addClass('show');
    $('#multiphaseBook #d3').css('background', '#56b426');
    $('#errorLog').html('');
  }
}

function processPhase3()
{
  fname = $.trim($('#fname').val());
  lname = $.trim($('#lname').val());
  mobile = $.trim($('#mobile').val());
  email = $.trim($('#formemail').val());
  address = $.trim($('#homeaddress').val());

  var patternName = /^[a-zA-Z]+$/;
  var patternMobile = /^[0-9]+$/;

  if(!patternName.test(fname) || !patternName.test(lname)){
    $('#errorLog').html('Invalid Firstname or Lastname');
  }
  else if(fname.length < 3 || lname.length < 3){
    $('#errorLog').html('Firstname & Lastname length should be greater than 3');
  }
  else if (!patternMobile.test(mobile) || mobile.length < 9) {
    $('#errorLog').html('Enter valid mobile number');
  }
  else if (address.length < 6) {
    $('#errorLog').html('Enter detail address');
    console.log(address);
  }
  else{
    $('#showPrice').html("Loading...");
    $.ajax({
      method: 'post',
      url: 'checkVehicleType.php',
      data: {
        brand: brand,
        model: model,
        service: service,
        waxing: waxing
      },
      success: function(data)
      {
        $('#showPrice').html(data);
      }
    });

    $('#showFname').html(fname);
    $('#showLname').html(lname);
    $('#showMobile').html(mobile);
    $('#showEmail').html(email);
    $('#showAddress').html(address);
    $('#showBrand').html(brand);
    $('#showModel').html(model);
    $('#showVehicleno').html(vehicleNo);
    $('#showService').html(service);
    $('#showWaxing').html(waxing);

    $('#hiddenFname').val(fname);
    $('#hiddenLname').val(lname);
    $('#hiddenMobile').val(mobile);
    $('#hiddenEmail').val(email);
    $('#hiddenAddress').val(address);
    $('#hiddenBrand').val(brand);
    $('#hiddenModel').val(model);
    $('#hiddenVehicleno').val(vehicleNo);
    $('#hiddenService').val(service);
    $('#hiddenWaxing').val(waxing);

    $('#hiddenForm').css('display', 'block');
    $('#phase3').removeClass('show');
    $('#phase4').addClass('show');
    $('#multiphaseBook #d4').css('background', '#56b426');
    $('#errorLog').html('');
  }

}

function gotoPhase1(){
  $('.phase').removeClass('show');
  $('#phase1').addClass('show');
  $('#multiphaseBook #d2').css('background', '#c73000');
}

function gotoPhase2(){
  $('.phase').removeClass('show');
  $('#phase2').addClass('show');
  $('#multiphaseBook #d3').css('background', '#c73000');
}

function gotoPhase3(){
  $('.phase').removeClass('show');
  $('#phase3').addClass('show');
  $('#multiphaseBook #d4').css('background', '#c73000');
  $('#hiddenForm').css('display', 'none');
}


/*-------Login---------*/
var userNumber, userPwd;
function login(){
  userNumber = $('#userNumber').val();
  userPwd = $('#userPwd').val();

  $.ajax({
    method: 'post',
    url: 'login.php',
    data: {
      userNumber: userNumber,
      userPwd: userPwd
    },
    success: function(data){
      if(data == 'success')
      {
        window.location.assign("myaccount.php");
      }
      else
      {
        $('#loginError').html(data);
      }
    }
  });
}

/* function to fill the feedback form */
var feedbackName, feedbackEmail, feedbackMessage;
function fillFeedback(){
  feedbackName = $('#feedbackName').val();
  feedbackEmail = $('#feedbackEmail').val();
  feedbackMessage = $('#feedbackMessage').val();

  $.ajax({
    method: 'post',
    url: "feedback.php",
    data: {
      name: feedbackName,
      email: feedbackEmail,
      message: feedbackMessage
    },
    success: function(data){
      if(data == "success"){
        alert("Thank you for feedback");
        $('#feedbackError').html("");
      }
      else{
        $('#feedbackError').html(data);
      }
    }
  });
}
