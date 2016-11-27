$(document).ready(function() {
    $("#condition_good_datatable").dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, 500, 1000], [5, 10, 25, 50, 100, 500, 1000]],
        iDisplayLength: 5,
        sPaginationType: "full_numbers",
        bProcessing: true,
        oLanguage: {
            sProcessing: "Retrieving all post...",
            sLengthMenu: "Showing _MENU_ entries &nbsp;",
            sInfo: "(_START_ to _END_ of _TOTAL_ total)",
            oPaginate: {
                sPrevious: "<",
                sNext: ">",
                sFirst: "<<",
                sLast: ">>"
            }
        },
        columnDefs: [
            {
                "aTargets" : [7],
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
        aoColumns:[
            {"title": "Post"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Comments"},
            {"title": "More Info"}
        ],
        bJQueryUI: false,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "includes/php/tables/serverside_processing_condition_good.php",
        bDeferRender: true
    });















    $("#condition_poor_datatable").dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, 500, 1000], [5, 10, 25, 50, 100, 500, 1000]],
        iDisplayLength: 5,
        sPaginationType: "full_numbers",
        bProcessing: true,
        oLanguage: {
            sProcessing: "Retrieving all post...",
            sLengthMenu: "Showing _MENU_ entries &nbsp;",
            sInfo: "(_START_ to _END_ of _TOTAL_ total)",
            oPaginate: {
                sPrevious: "<",
                sNext: ">",
                sFirst: "<<",
                sLast: ">>"
            }
        },
        columnDefs: [
            {
                "aTargets" : [7],
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
        aoColumns:[
            {"title": "Post"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Comments"},
            {"title": "More Info"}
        ],
        bJQueryUI: false,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "includes/php/tables/serverside_processing_condition_poor.php",
        bDeferRender: true
    });















    $("#condition_acceptable_datatable").dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, 500, 1000], [5, 10, 25, 50, 100, 500, 1000]],
        iDisplayLength: 5,
        sPaginationType: "full_numbers",
        bProcessing: true,
        oLanguage: {
            sProcessing: "Retrieving all post...",
            sLengthMenu: "Showing _MENU_ entries &nbsp;",
            sInfo: "(_START_ to _END_ of _TOTAL_ total)",
            oPaginate: {
                sPrevious: "<",
                sNext: ">",
                sFirst: "<<",
                sLast: ">>"
            }
        },
        columnDefs: [
            {
                "aTargets" : [7],
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
        aoColumns:[
            {"title": "Post"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Comments"},
            {"title": "More Info"}
        ],
        bJQueryUI: false,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "includes/php/tables/serverside_processing_condition_acceptable.php",
        bDeferRender: true
    });
















    $("#condition_excellent_datatable").dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, 500, 1000], [5, 10, 25, 50, 100, 500, 1000]],
        iDisplayLength: 5,
        sPaginationType: "full_numbers",
        bProcessing: true,
        oLanguage: {
            sProcessing: "Retrieving all post...",
            sLengthMenu: "Showing _MENU_ entries &nbsp;",
            sInfo: "(_START_ to _END_ of _TOTAL_ total)",
            oPaginate: {
                sPrevious: "<",
                sNext: ">",
                sFirst: "<<",
                sLast: ">>"
            }
        },
        columnDefs: [
            {
                "aTargets" : [7],
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
        aoColumns:[
            {"title": "Post"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Comments"},
            {"title": "More Info"}
        ],
        bJQueryUI: false,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "includes/php/tables/serverside_processing_condition_excellent.php",
        bDeferRender: true
    });
















    $("#condition_new_datatable").dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, 500, 1000], [5, 10, 25, 50, 100, 500, 1000]],
        iDisplayLength: 5,
        sPaginationType: "full_numbers",
        bProcessing: true,
        oLanguage: {
            sProcessing: "Retrieving all post...",
            sLengthMenu: "Showing _MENU_ entries &nbsp;",
            sInfo: "(_START_ to _END_ of _TOTAL_ total)",
            oPaginate: {
                sPrevious: "<",
                sNext: ">",
                sFirst: "<<",
                sLast: ">>"
            }
        },
        columnDefs: [
            {
                "aTargets" : [7],
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
        aoColumns:[
            {"title": "Post"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Comments"},
            {"title": "More Info"}
        ],
        bJQueryUI: false,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "includes/php/tables/serverside_processing_condition_new.php",
        bDeferRender: true
    });

});

























