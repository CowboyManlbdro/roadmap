$(function () {
 

  $("button#addf").on("click", function () {
    $("input#files").trigger("click");
    return false;
  });

  $("input#files").on("change", function () {
    $("div#darkwindowadd").height(250 + "px");
    showFileNames2();
    return false;
  });

  $("#add-comment-files1").click(function () {
    $("#comment-files1").trigger("click");
    return false;
  });

  $("#comment-files1").change(function () {
    showFileNames(1);
    return false;
  });

  $("#add-comment-files2").click(function () {
    $("#comment-files2").trigger("click");
    return false;
  });

  $("#comment-files2").change(function () {
    showFileNames(2);
    return false;
  });

  $("#add-comment-files3").click(function () {
    $("#comment-files3").trigger("click");
    return false;
  });

  $("#comment-files3").change(function () {
    showFileNames(3);
    return false;
  });

  $("#add-comment-files4").click(function () {
    $("#comment-files4").trigger("click");
    return false;
  });

  $("#comment-files4").change(function () {
    showFileNames(4);
    return false;
  });

  $("#add-comment-files5").click(function () {
    $("#comment-files5").trigger("click");
    return false;
  });

  $("#comment-files5").change(function () {
    showFileNames(5);
    return false;
  });

  $("#add-comment-files6").click(function () {
    $("#comment-files6").trigger("click");
    return false;
  });

  $("#comment-files6").change(function () {
    showFileNames(6);
    return false;
  });

  $("#add-comment-files7").click(function () {
    $("#comment-files7").trigger("click");
    return false;
  });

  $("#comment-files7").change(function () {
    showFileNames(7);
    return false;
  });

  $("#add-comment-files8").click(function () {
    $("#comment-files8").trigger("click");
    return false;
  });

  $("#comment-files8").change(function () {
    showFileNames(8);
    return false;
  });

  $("#add-comment-files9").click(function () {
    $("#comment-files9").trigger("click");
    return false;
  });

  $("#comment-files9").change(function () {
    showFileNames(9);
    return false;
  });

  $("#add-comment-files10").click(function () {
    $("#comment-files10").trigger("click");
    return false;
  });

  $("#comment-files10").change(function () {
    showFileNames(10);
    return false;
  });


  var l = [
    "Этап 1",
    "Этап 2",
    "Этап 3",
    "Этап 4",
    "Этап 5",
    "Этап 6",
    "Этап 7",
    "Этап 8",
    "Этап 9",
    "Этап 10",
  ];

  $("#flat-slider")
    .slider({
      max: 10,
      min: 1,
      range: "min",
      value: 1
      //disabled: true
    })
    .slider("pips", {
      first: "pip",
      last: "pip"
    })
    .slider("pips", {
      rest: "label",
      labels: l
    });


    $('img[src^=img/del]').mouseover(function(){
              $(this).attr('src', 'img/del2.png');
           });
    $('img[src^=img/del]').mouseout(function(){
            $(this).attr('src','img/del1.png');
         });

  function showFileNames(number) {
    var files = $("input:file[name='section" + number + "[]']").prop("files");

    var $attachedFilesList = $("#attached-fiels-list" + number);
    $attachedFilesList.fadeOut(10);
    $attachedFilesList.html("");
    if (files.length > 0) {
      if (files.length == 1) {
        $attachedFilesList.append(
          "<center><li><p><label>Прикреплен " +
            files.length +
            " файл</p></label> </li></center>"
        );
        $attachedFilesList.fadeIn();
      }
      if (files.length >= 5) {
        $attachedFilesList.append(
          "<li><p><label>Прикреплено " +
            files.length +
            " файлов</p></label> </li>"
        );
        $attachedFilesList.fadeIn();
      }
      if (files.length < 5 && files.length > 1) {
        $attachedFilesList.append(
          "<li><p><label>Прикреплено " +
            files.length +
            " файла</p> </label></li>"
        );
        $attachedFilesList.fadeIn();
      }
    } else {
      $attachedFilesList.html("нет прикреплённых файлов");
    }
  }

  function showFileNames2() {
    var files = $("input:file[name='sect[]']").prop("files");

    console.log("Имена файлов:", files);

    var $attachedFilesList = $("ul#list");
    $attachedFilesList.fadeOut(10);

    $attachedFilesList.html("");
    if (files.length > 0) {
      for (var i = 0; i < files.length; i++) {
        //console.log(files[i].name);
        $attachedFilesList.append(
          "<li><p>" +
            files[i].name +
            '</p><!-- <a href="#" class="del">delete</a> --> <i>' +
            formatFileSize(files[i].size) +
            "</i><span></span> </li>"
        );
        $("div#darkwindowadd").height(
          $("div#darkwindowadd").height() + 50 + "px"
        );
      }
      $attachedFilesList.fadeIn();
    } else {
      $attachedFilesList.html("нет прикреплённых файлов");
    }
  }

  function formatFileSize(bytes) {
    if (typeof bytes !== "number") {
      return "";
    }

    if (bytes >= 1000000000) {
      return (bytes / 1000000000).toFixed(2) + " GB";
    }

    if (bytes >= 1000000) {
      return (bytes / 1000000).toFixed(2) + " MB";
    }

    return (bytes / 1000).toFixed(2) + " KB";
  }

  
});
