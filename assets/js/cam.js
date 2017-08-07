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
    // console.log('clicked');
    this.classList.toggle("active");
    // console.log($(this).find('chev-right'));
    // console.log($(this).children());
    $(this).children('img').attr('src','http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-down.png');
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){ // this close.
      panel.style.maxHeight = null;
      // console.log('if activated');
      $(this).children('img').attr('src','http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-right.png');
    } else {  //this extend
      // console.log(panel.scrollHeight);
      // console.log($('.cat-bar').scrollHeight);
      panel.style.maxHeight = panel.scrollHeight + "px";
      // console.log('else activated');
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
  // console.log(getClickedClass);
  $('.main-view-lg').each(function(index,object){
    // console.log(index);
    $(this).css('display','none');
  })
  $('.main-view-lg.main-'+getClickedClass).css('display','initial');
})
var ipClickedImg = $('.main-view-lg');
ipClickedImg.click(function(){
  // var getMainClickedClass=this.className.split(' ')[1].split('-')[1];
  var getMainClickedClass='.modal-'+this.className.split(' ')[1].split('-')[1];
  // console.log(getMainClickedClass);
  $('.ip-modal').css('display','block');
  $(getMainClickedClass).css('display','block');
})
$('.ip-close').click(function(){
  $('.ip-modal').css('display','none');
  $('.ip-slides').css('display','none');
})
var clickToNext = $('.ip-slides');
// console.log(clickToNext.length);
clickToNext.click(function(){
  var getClickedIndex = parseInt(this.className.split(' ')[1].split('-')[1].split('img')[1]);
  console.log(getClickedIndex);
  var curClass = $('.modal-img'+getClickedIndex);
  // console.log(curClass);
  curClass.css('display','none');
  // console.log(clickToNext.length);
  /*
    # Will need to revise. If there are missing image at specific, it will stuck.
  */
  if(getClickedIndex == clickToNext.length-1){
    $('.modal-img0').css('display','block');
  } else {
    var curClass = $('.modal-img'+(getClickedIndex + 1));
    curClass.css('display','block');
  }
})

$(document).keydown(function(e){
  // console.log(e);
  if(e.keyCode==27){  //this listen for "ESC" key.
    $('.ip-modal').css('display','none');
    $('.ip-slides').css('display','none');
  }
})

})

// console.log('JS is fully functional.');
