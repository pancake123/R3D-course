
$(document).ready(function() {
    $(".role-edit-icon").click(function () {
        var modal = $("#update-role-modal");
        $.get("/nastya/role/fetch.php", {
            id: $(this).attr("data-id")
        }, function(json) {
            var role = json["role"];
            var privileges = json["privileges"];
            for (var i in role) {
                modal.find("[name='" + i + "']").val(role[i]);
            }
            var list = modal.find(".check-box-list");
            list.find("input").prop("checked", false);
            for (i in privileges) {
                list.find("input[value='" + privileges[i] + "']")
                    .prop("checked", true);
            }
            modal.modal();
        }, "json");
    });
    $(".privilege-edit-icon").click(function() {
        var modal = $("#update-privilege-modal");
        $.get("/nastya/privilege/fetch.php", {
            id: $(this).attr("data-id")
        }, function(json) {
            var privilege = json["privilege"];
            for (var i in privilege) {
                modal.find("[name='" + i + "']").val(privilege[i]);
            }
            modal.modal();
        }, "json");
    });
     $(".user-edit-icon").click(function() {
         var modal = $("#update-user-modal");
         $.get("/nastya/user/fetch.php", {
             id: $(this).attr("data-id")
         }, function(json) {
             var user = json["user"];
             for (var i in user) {
                 modal.find("[name='" + i + "']").val(user[i]);
             }
             modal.modal();
         }, "json");
     });
});