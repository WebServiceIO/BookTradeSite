/*jslint browser: true*/
/*global $, jQuery, alert*/

window.onload = function () {
    "use strict";
    
    /* This is for switching pages from 'Your Profile' to 'Posts' */
    $('#posts').toggle();
    
    var profileLink = document.getElementById("profile-link");
    var postsLink = document.getElementById("posts-link");
    
    profileLink.onclick = function () {
        $('#profile').toggle();
        $('#posts').toggle();
        $('#profile-link').addClass('active-link');
        $('#posts-link').removeClass('active-link');
    }
    
    postsLink.onclick = function () {
        $('#posts').toggle();
        $('#profile').toggle();
        $('#posts-link').addClass('active-link');
        $('#profile-link').removeClass('active-link');
    }
    
    /* This is for editing the content on profile page */
    $('body').on('click', '[editable]', function () {
        "use strict";

        var $item = $(this);
        var $input = $('<input/>').val($item.text());

        $item.replaceWith($input);

        var save = function () {
            var $p = $('<p editable class="profile-info"/>').text($input.val());
            $input.replaceWith($p);
        };

        $input.one('blur', save).focus();
    });
    
    /* This is for toggling book editor */
    $('#post-edit').toggle();
    $('body').on('click', '[editor]', function () {
        "use strict";
        
        $('#post-edit:hidden').toggle();
        
        var $row = $(this).closest("tr");
        var $isbn = $row.find(".isbn").text();
        var $price = $row.find(".price").text();
        var $comments = $row.find(".comments").text();
        
        $('#edit-isbn').text($isbn);
        $('#edit-price').text($price);
        $("#edit-comments").text($comments);
    });
    
    /* This is for editing the content on post page */
    $('body').on('click', '[post-editor]', function () {
        "use strict";

        var $item = $(this);
        var $input = $('<input/>').val($item.text());

        $item.replaceWith($input);

        var save = function () {
            $item.text($input.val());
            $input.replaceWith($item);
        };

        $input.one('blur', save).focus();
    });
    
    /* This is to handle saving of posts */
    $('#post-save').click(function () {
        $('#post-edit').toggle();
    });
}