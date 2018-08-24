$(document).ready(function() {
  $(".actions").hide();
  $(".last[role='tab']").hide();
  $(".showed").show();
  $("input[name='slider']").css("display", "none");
  $("input[name='headerImg']").css("display", "none");
  $(".select2").select2();
  $('form').parsley();
  initparsley("#highlight");
  initparsley("#activityInformation");
  initparsley("#usingInstruction");
  initparsley("#description");
  initparsley("#instantBooking");
  initparsley("#faq");
  initparsley("#cancellation");
});

$(document).keypress(function(e) {
    if(e.which == 13) {
      e.preventDefault(); // prevents default
      return false;
    }
});

$("a[role='menuitem']").click(function(e){
  window.scrollTo(0, 0);
});

function initparsley(selectedform){
  tinymce.init({
    menubar: false,
    selector: "textarea"+selectedform,
    theme: "modern",
    height:100,
    plugins: [
      "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "save table contextmenu directionality template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l ",
    // toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
    // style_formats: [
    //   {title: 'Bold text', inline: 'b'},
    //   {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
    //   {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
    //   {title: 'Example 1', inline: 'span', classes: 'example1'},
    //   {title: 'Example 2', inline: 'span', classes: 'example2'},
    //   {title: 'Table styles'},
    //   {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    // ]
  });
}
