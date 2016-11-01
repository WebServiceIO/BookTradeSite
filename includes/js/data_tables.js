//// Set up everything that needs to be set up on document ready
$(document).ready(function() {
    $("#initial_datatable").dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, 500, 1000], [5, 10, 25, 50, 100, 500, 1000]],
        iDisplayLength: 5,
        sPaginationType: "full_numbers",
        bProcessing: true,
        oLanguage: {
            sProcessing: "Loading all post...",
            sLengthMenu: "Showing _MENU_ entries &nbsp;",
            sInfo: "(_START_ to _END_ of _TOTAL_ total)"
        },
        "bJQueryUI": true,
        sDom: '<"H"fli><"proc1"r>t<"proc2"r><"F"pli>',
        //aaSorting: [[0, "asc"]],
        bServerSide: true,
        sAjaxSource: "../php/serverside_user_post.php",
        "bDeferRender": true
    });


});

