$(document).ready(function() {
  $('#menu a').click(function(){

    // mengambil data dari href
    var folder = $(this).attr('id');
    var file = $(this).attr('href');

    if (!$('li#'+file).hasClass("active")) {      
      // Remove the class from anything that is active
      $('li.active').removeClass();
      // And make this active
      $('li#'+file).addClass('active');
    }
    // konten akan diisi oleh menu yang dipilih sesuai dengan isi dari href yang dipilih
    $("#konten").load('pages/'+folder+'/'+file+'.php');
    
    return false;
  });
});