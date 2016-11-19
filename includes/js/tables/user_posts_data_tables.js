

$(document).ready(function() {
    $("#user_post_datatable").dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, 500, 1000], [5, 10, 25, 50, 100, 500, 1000]],
        iDisplayLength: 5,
        sPaginationType: "full_numbers",
        bProcessing: true,
        oLanguage: {
            sProcessing: "Retrieving all post...",
            sLengthMenu: "Showing _MENU_ entries &nbsp;",
            sInfo: "(_START_ to _END_ of _TOTAL_ total)"
        },
        columnDefs: [
            {
                "aTargets" : [9],
                "data": null,
                "mData": function (source, type, val)
                {
                    var post_id = source[0];
                    return  '<form name="post" action ="' + window.location.pathname.replace(/[^\\\/]*$/, '') + 'post_info.php" method="post">  ' +
                        '<input type="hidden" name="post_id" value="' + post_id + '"/> ' +
                        '<button type="submit" class="btn btn-default btn-transparent">View</button> ' +
                        '</form>';
                }
            }
        ],
        aoColumns: [
            {"title": "Post ID"},

            {"title": "Title"},
            {"title": "Class"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Condition"},
            {"title": "Price"},
            {"title": "Contact"},
            {"title": "Comments"}
        ],
        bJQueryUI: false,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "includes/php/tables/serverside_processing_user_post.php",
        bDeferRender: true
    }).css("margin", "auto auto")
        .css("width", "-webkit-calc(100% - 200px)")
        .css("width", "-moz-calc(100% - 200px)")
        .css("width", "calc(100% - 200px)");
    // let tables be below nav bar
    $('#wrapper-content').css("margin-top", $('nav').height() + 5);
    /*width: -webkit-calc(100% - 200px);*/
    /*width:    -moz-calc(100% - 200px);*/
    /*width:         calc(100% - 200px);*/

});