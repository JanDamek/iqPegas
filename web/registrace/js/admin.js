$(document).ready(function() {
  $("#images-list").sortable({
    handle : '.handle',
    update : function () {
      var order = $('#images-list').sortable('serialize');
      $("#info").load("sortimages?"+order);
    }
  });
  
  $("#replies-list").sortable({
    handle : '.handle',
    update : function () {
      var order = $('#replies-list').sortable('serialize');
      $("#info").load("sort?"+order);
    }
  });
});
