jQuery(document).ready(function($) {
  // console.log('JS is fully functional.');
  // console.log(Date());
  // $('.accordion').click(function(){
  //   console.log('omg u clicked it.');
  // })

// --- THIS IS FOR ACCORDION BUTTON SECTION ---

// source: https://codepen.io/brenden/pen/Kwbpyj
$('.accordion').click(function(e){
  var $this = $(this);
  if($this.next().hasClass('show')){
    $this.next().removeClass('show');
    $this.children('img').attr('src','http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-right.png');
    $this.next().slideUp(350);
  } else {
    // $this.parent().find('.panel').removeClass('show');
    // console.log('Else section. Find parent panel and removeClass show');
    $this.children('img').attr('src','http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-right.png');
    // $this.parent().find('.panel').slideUp(350);
    // console.log('Else section. Find parent panel and slideup.');
    $this.next().toggleClass('show');
    $this.children('img').attr('src','http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-down.png');
    $this.next().slideToggle(350);
  }
});

/*
var acc = $('.accordion');
var i;
// console.log($('.cat-bar').attr('class'));
var getTotalHeight = parseInt($('.cat-bar').attr('class').split(' ')[1].split('-')[1]);
console.log(getTotalHeight);
// console.log($('.accordion').length);
var getEachCellHeight = $('.accordion').height();
console.log(getEachCellHeight);
var catBarHeight = (getTotalHeight * getEachCellHeight) + 'px';
$('.cat-bar').css('height',catBarHeight);
for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    // console.log('clicked');
    this.classList.toggle("active");
    $(this).children('img').attr('src','http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-down.png');
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){ // this close.
      panel.style.maxHeight = null;
      // console.log('if activated');
      $(this).children('img').attr('src','http://files.coda.com.s3.amazonaws.com/imgv2/icons/chev-right.png');
    } else {  //this extend
      panel.style.maxHeight = panel.scrollHeight + "px";
      // console.log('else activated');
    }
  }
}
*/

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
  var nextIndex = getClickedIndex+1;
  // console.log(getClickedIndex);
  var curClass = $('.modal-img'+getClickedIndex);
  // console.log(curClass);
  curClass.css('display','none');
  // console.log($('.modal-img'+(nextIndex+1)));
  // while ($('.modal-img'+(nextIndex+1))!="") {
  //   console.log('while is executed');
  //   // console.log('Image: '+ nextIndex + ' is empty. Adding one.');
  //   nextIndex++;
  //   if (nextIndex > 9){
  //     nextIndex = 0;
  //   }
  // }
  // console.log('aye capt!');
  // console.log(nextIndex);
  if($('.modal-img'+nextIndex).length!=0){
    $('.modal-img'+nextIndex).css('display','block');
    // console.log('inner if executed.');
  } else {
    // console.log('else executed.');
    for(var i=nextIndex; i < 10; i++){
      // console.log(i);
      if(i == 9) {
        i = 0;
      }
      if($('.modal-img'+i).length!=0){
        console.log(i);
        $('.modal-img'+i).css('display','block');
        break;
      }
    }
  }


  // console.log(clickToNext.length);
  /*
    # Will need to revise. If there are missing image at specific, it will stuck.
  */
  // Image has 9 cells: img0 - img9.
  /*var nextIndex = getClickedIndex+1;
  if($('.modal-img'+nextIndex)!=""){
    $('.modal-img'+nextIndex).css('display','block');
  } else {
    for ( var i=getClickedIndex; i <=9; i++){
    // #Do while loop
    }
  }*/

  // if(getClickedIndex == clickToNext.length-1){
  //   $('.modal-img0').css('display','block');
  // } else {
  //   var curClass = $('.modal-img'+(getClickedIndex + 1));
  //   curClass.css('display','block');
  // }
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
