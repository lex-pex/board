
/**
 * Initializing Block 
 */

var token = $("[name=csrf-token]").attr('content');
var cmt = $('#cmt');
var post_id = cmt.attr('data-id');
var validationNeeded = false;
var updatedId = 0;

/** 
 * Init Block Ends
 * Run the Comment Plugin with RestFull method Index
 */

if(post_id) indexComments();

/** 
 * Set the plugin in Standby Mode
 * Catch the "New Comment" event
 */

cmt.keyup(function(event) {
    if(validationNeeded)
        validationWarning();
    if((event.keyCode || event.which) === 13) {
        var txt = cmt.val().trim();
        if(checkLength(txt)) {
            save(txt);
        } else {
            validationWarning();
        }
    }
});

function save(commentText) {
    if(updatedId === 0) {
        $.post('/comment/store', { _token: token, post_id: post_id, text: commentText });
    } else {
        $.post('/comment/update', { _token: token, "id" : updatedId, text: commentText },
            function(data) {
            updatedId = 0;
            $('#cancel-edit').css('display', 'none');
        });
    }
    cmt.val('').blur();
    setTimeout(indexComments, 500);
}

function indexComments() {
    $.post(
        '/comments/index', { _token: token, id : post_id },
        function(data) {
            var cmts = JSON.parse(data);
            var showCmt = $('#showCmt');
            showCmt.empty();
            for (var i = cmts.length - 1; i >= 0; i--)
                appendComment(showCmt, cmts[i]);
        }
    );
}

function appendComment(element, com) {
    var c = $('<div class="comment" data-comment-id="' + com.id + '"></div>').text(com.text);
    element.append(c);
    var user = cmt.attr('data-user');
    var menu =
        $('<span class="comment-tools"><a onclick="commentEdit(' + com.id + ')">Edit</a> | <a onclick="commentDelete(' + com.id + ')">Delete</a></span>');
    if(user == com.user_id) {
        element.append(menu);
    }
    element.append('<br/>');
}

function commentEdit(id) {
    var text = $("[data-comment-id=" + id + "]").text();
    cmt.val(text);
    $('#cancel-edit').css('display', 'block');
    updatedId = id;
}

function cancelEdit() {
    $('#cancel-edit').css('display', 'none');
    cmt.val('').blur();
    updatedId = 0;
}

function commentDelete(id) {
    $.post('/comment/destroy',
        { _token: token, id : id },
        function(data) { indexComments(); }
    );
}

// * * Validation Alerts
function validationWarning() {
    var t = cmt.val().trim();
    var message = '<small class="text-danger" id="message"> Text has to be more than 3 character and less 200</small>';
    if(!checkLength(t)) {
        cmt.addClass('is-invalid');
        if(!$( "#message").length)
            cmt.after(message);
        validationNeeded = true;
    } else {
        cmt.removeClass('is-invalid');
        $("#message").remove();
    }
}

// * * Validate Length
function checkLength(text) {
    var l = text.length;
    return l >= 3 && l <= 200;
}




























