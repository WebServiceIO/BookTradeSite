$(document).ready(function() {
    $("#condition_good_datatable").dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, 500, 1000], [5, 10, 25, 50, 100, 500, 1000]],
        iDisplayLength: 5,
        sPaginationType: "full_numbers",
        bProcessing: true,
        oLanguage: {
            sProcessing: "Retrieving all post...",
            sLengthMenu: "Showing _MENU_ entries &nbsp;",
            sInfo: "(_START_ to _END_ of _TOTAL_ total)"
        },
        aoColumns: [
            {"title": "Post"},
            {"title": "User"},
            {"title": "ISBN"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Contact"},
            {"title": "Comments"}
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
            sInfo: "(_START_ to _END_ of _TOTAL_ total)"
        },
        aoColumns: [
            {"title": "Post"},
            {"title": "User"},
            {"title": "ISBN"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Contact"},
            {"title": "Comments"}
        ],
        bJQueryUI: false,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "includes/php/tables/serverside_processing_condition_poor.php",
        bDeferRender: true
    });

    $("#condition_ok_datatable").dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, 500, 1000], [5, 10, 25, 50, 100, 500, 1000]],
        iDisplayLength: 5,
        sPaginationType: "full_numbers",
        bProcessing: true,
        oLanguage: {
            sProcessing: "Retrieving all post...",
            sLengthMenu: "Showing _MENU_ entries &nbsp;",
            sInfo: "(_START_ to _END_ of _TOTAL_ total)"
        },
        aoColumns: [
            {"title": "Post"},
            {"title": "User"},
            {"title": "ISBN"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Contact"},
            {"title": "Comments"}
        ],
        bJQueryUI: false,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "includes/php/tables/serverside_processing_condition_ok.php",
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
            sInfo: "(_START_ to _END_ of _TOTAL_ total)"
        },
        aoColumns: [
            {"title": "Post"},
            {"title": "User"},
            {"title": "ISBN"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Contact"},
            {"title": "Comments"}
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
            sInfo: "(_START_ to _END_ of _TOTAL_ total)"
        },
        aoColumns: [
            {"title": "Post"},
            {"title": "User"},
            {"title": "ISBN"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Contact"},
            {"title": "Comments"}
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
            sInfo: "(_START_ to _END_ of _TOTAL_ total)"
        },
        aoColumns:[
            {"title": "Post"},
            {"title": "User"},
            {"title": "ISBN"},
            {"title": "Title"},
            {"title": "Author"},
            {"title": "Edition"},
            {"title": "Class"},
            {"title": "Price"},
            {"title": "Contact"},
            {"title": "Comments"}
        ],
        bJQueryUI: false,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "includes/php/tables/serverside_processing_condition_new.php",
        bDeferRender: true
    });


    //set tables
    $('.datatables_template')
        .css("margin", "auto auto")
        .css("width", "-webkit-calc(100% - 200px)")
        .css("width", "-moz-calc(100% - 200px)")
        .css("width", "calc(100% - 200px)");
    // let tables be below nav bar
    $('#content_wrapper').css("margin-top", $('nav').height() + 5);
    /*width: -webkit-calc(100% - 200px);*/
    /*width:    -moz-calc(100% - 200px);*/
    /*width:         calc(100% - 200px);*/


});