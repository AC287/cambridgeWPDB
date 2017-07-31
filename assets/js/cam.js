jQuery(document).ready(function($) {
  console.log('JS is fully functional.');
  // $('.accordion').click(function(){
  //   console.log('omg u clicked it.');
  // })

// --- THIS IS FOR ACCORDION BUTTON SECTION ---
var acc = $('.accordion');
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  }
}

// $('.display-extra').onclick = function () {
//
// }

// --- THIS IS FOR PRODUCT MAIN PAGE ---
var displayExtra = $('.display-extra');
var i;
for (i=0; i< displayExtra.length; i++) {
  displayExtra[i].onclick = function () {
    var currentStatus = this.innerHTML.split(' ');
    if (currentStatus[0] == 'SHOW') {
      currentStatus[0] = 'HIDE';
      currentStatus.splice(1,1);
      this.innerHTML = currentStatus.join(' ');
    }
    else {
      currentStatus[0] = 'SHOW';
      currentStatus.splice(1,0,'ALL');
      this.innerHTML = currentStatus.join(' ');
    }
    var displayAll = $('.'+this.classList[1]);
    displayAll.each(function(index,object){
      if(($(this).css('display'))=='none'){
        $(this).css('display','inline-block');
      }
      else if (($(this).css('display')=='inline-block') && $(this).hasClass('extra-box')){
        $(this).css('display','none');
      }
    })
  }
  // displayExtra[i].onclick = function () {
  //
  // }
}

// --- THIS IS FOR ITEM PAGE ---
var imgThumb = $('.single-thumb');
// console.log($('.main-view-lg'));
// console.log($('.main-view-lg').length);
imgThumb.click(function(){
  // console.log(this.className.split(' ')[1]);
  var getClickedClass = this.className.split(' ')[1].split('-')[1];
  console.log(getClickedClass);
  $('.main-view-lg').each(function(index,object){
    console.log(index);
    $(this).css('display','none');
  })
  $('.main-view-lg.main-'+getClickedClass).css('display','initial');
})

})

// console.log('JS is fully functional.');
