$('.select-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', 'selected')
    $select2.trigger('change')
})

$('.deselect-all').click(function () {
  let $select2 = $(this).parent().siblings('.select2')
  $select2.find('option').prop('selected', '')
  $select2.trigger('change')
})

$('.select2').select2()

// remove local storage key 
var url      = window.location.href; 
if (url.indexOf('employees/add') ==  -1 && (url.indexOf('employees/') ==  -1)) {
  if (localStorage.getItem('smartWizartSteps') !== null) {
    window.localStorage.removeItem('smartWizartSteps');
  }
}


$(document).ready(function(){
  $('#mobile-collapse').click(function(){
      console.log($('#pcoded-navbar').hasClass('navbar-collapsed'));
      
      if($('#pcoded-navbar').hasClass('navbar-collapsed')) {
          // Add hover effect when collapsed
          addHoverEffect();
      } else {
          // Remove hover effect when expanded
          removeHoverEffect();
      }
  });

  function addHoverEffect() {
      $(".pcoded-navbar").hover(function(){
          $(this).toggleClass('active');
      });
  }

  function removeHoverEffect() {
      $(".pcoded-navbar").off('mouseenter mouseleave'); // Remove any previously bound hover events
      $(".pcoded-navbar").removeClass('active');
  }
});


function fireSuccessSwal(title,message){
	Swal.fire({
        title: title, 
        text: message, 
        type: "success",
        icon: "success",
        confirmButtonText: "Okay",
        confirmButtonColor: "#04a9f5"
    });
}

function fireWarningSwal(title,message){
  Swal.fire({
        title: title, 
        text: message, 
        type: "warning",
        icon: "warning",
        confirmButtonText: "Okay",
        confirmButtonColor: "#04a9f5"
    });
}

function fireErrorSwal(title,message){
	Swal.fire({
        title: title, 
        text: message, 
        type: "error",
        icon: "error",
        confirmButtonText: "Okay",
        confirmButtonColor: "#04a9f5"
    });
}

function fireConfirmSwal(title,message){
  Swal.fire({
      title: title,
      text: message,
      icon: "warning",
      showDenyButton: true,  
      showCancelButton: true,  
      confirmButtonText: `Yes, I am sure`,  
      denyButtonText: `'No, cancel it!`,
  })
}