

$(function () {
    $("#btnddlist").click(function () {
        var ddlist = $("#ddlist");
        if (ddlist.val() == "") {
            //If the "Please Select" option is selected display error.
            alert("Please select a list data!");
            return false;
        }
        return true;
    });
});  

