/* --------------------------- */
// ON DOCUMENT READY - NOTE: USE GULP
/* --------------------------- */

$(document).ready(function (){

    var postId = 0; //get data-postid from dashboard article
    var postBodyElement = null; //for .done - update page without refresh

    $('.post').find('.interaction').find('.edit').on('click', function (event) {
        
        event.preventDefault();
 
        postBodyElement = event.target.parentNode.parentNode.childNodes[1]; //postBodyElement for .done
        var postBody = postBodyElement.textContent;
        
        postId = event.target.parentNode.parentNode.dataset['postid']; //get data-postid from dashboard article
        $('#post-body').val(postBody);
        $('#edit-modal').modal();
    });

    //urlEdit & token are set in the dashboard.blade.php
    $('#modal-save').on('click', function () {
        $.ajax({
                method: 'POST',
                url: urlEdit,
                data: {body: $('#post-body').val(), postId: postId, _token: token} //get data-postid from dashboard article
            })
            .done(function (msg) {
                //console.log(msg['message']);
                ///console.log(JSON.stringify(msg));
                $(postBodyElement).text(msg['new_body']); //update page without refresh
                $('#edit-modal').modal('hide'); //hide modal
            });
    });


    $('.like').on('click', function(event) {

        event.preventDefault();

        // find out which a.like was clicked
        //if previous element is null then you click on like
        //like = true - dislike = false
        var isLike = event.target.previousElementSibling == null;

        //get the post id
        postId = event.target.parentNode.parentNode.dataset['postid'];

        //Pass if its a like or dislike to ajax
        //also pass post id and token ajax
        $.ajax({
            method: 'POST',
            url: urlLike,
            data: {isLike: isLike, postId: postId, _token: token}
        })
        //if done call back
        .done(function() {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });

    });
});

// $(window).resize(function() {

// }).resize();

