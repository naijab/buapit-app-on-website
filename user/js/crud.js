// Add Record
function addRecord() {
    // get values
    var title = $("#title").val();
    var type = $("#type").val();
    var content = $("#content").val();
    var image = $("#image").val();
    var active = $(".rad-active").val();

    // Add record
    $.post("lib/add.php", {
        title: title,
        type: type,
        content: content,
        image: image,
        active: active
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#title").val("");
        $("#type").val("");
        $("#content").val("");
        $("#image").val("");
        $(".rad-active").val("");
    });
}

/* READ records
function readRecords() {
    $.get("lib/all.php", {}, function (data, status) {
        $(".table_content").html(data);
    }); */
}
