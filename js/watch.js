function likeHover(likeIcon) {
    likeIcon.src = "media/images/like-icon-hover.png";
}

function likeHoverRelease(likeIcon) {
    likeIcon.src = "media/images/like-icon.png";
}

function dislikeHover(dislikeIcon) {
    dislikeIcon.src = "media/images/dislike-icon-hover.png";
}

function dislikeHoverRelease(likeIcon) {
    likeIcon.src = "media/images/dislike-icon.png";
}

function likeCheckedHover(likeIcon) {
    likeIcon.src = "media/images/like-icon-checked-hover.png";
}

function likeCheckedHoverRelease(likeIcon) {
    likeIcon.src = "media/images/like-icon-checked.png";
}

function dislikeCheckedHover(dislikeIcon) {
    dislikeIcon.src = "media/images/dislike-icon-checked-hover.png";
}

function dislikeCheckedHoverRelease(likeIcon) {
    likeIcon.src = "media/images/dislike-icon-checked.png";
}

function deleteHover(deleteIcon) {
    deleteIcon.src = "media/images/delete-icon-hover.png";
}

function deleteHoverRelease(deleteIcon) {
    deleteIcon.src = "media/images/delete-icon.png";
}

function editHover(editIcon) {
    editIcon.src = "media/images/edit-icon-hover.png";
}

function editHoverRelease(editIcon) {
    editIcon.src = "media/images/edit-icon.png";
}

function likeCheck(videoid) {
    let likeIcon = document.getElementById("like-icon-container");
    let dislikeIcon = document.getElementById("dislike-icon-container");

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "insert_video_like.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`videoid=${videoid}`);
    xhttp.onload = function() {
        likeIcon.innerHTML = "<img src='media/images/like-icon-checked.png' alt='like' id='like-button' onmouseover='likeCheckedHover(this)' onmouseout='likeCheckedHoverRelease(this)' onclick='likeUncheck(" + videoid + ")'>";
        dislikeIcon.innerHTML = "<img src='media/images/dislike-icon.png' alt='dislike' id='dislike-button' onmouseover='dislikeHover(this)' onmouseout='dislikeHoverRelease(this)' onclick='dislikeCheck(" + videoid + ")'>";

        refreshLikesDislikes(videoid);
	}
}

function likeUncheck(videoid) {
    let likeIcon = document.getElementById("like-icon-container");

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "delete_video_like.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`videoid=${videoid}`);
    xhttp.onload = function() {
		likeIcon.innerHTML = "<img src='media/images/like-icon.png' alt='like' id='like-button' onmouseover='likeHover(this)' onmouseout='likeHoverRelease(this)' onclick='likeCheck(" + videoid + ")'>";

        refreshLikesDislikes(videoid);
	}
}

function dislikeCheck(videoid) {
    let likeIcon = document.getElementById("like-icon-container");
    let dislikeIcon = document.getElementById("dislike-icon-container");

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "insert_video_dislike.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`videoid=${videoid}`);
    xhttp.onload = function() {
        dislikeIcon.innerHTML = "<img src='media/images/dislike-icon-checked.png' alt='dislike' id='dislike-button' onmouseover='dislikeCheckedHover(this)' onmouseout='dislikeCheckedHoverRelease(this)' onclick='dislikeUncheck(" + videoid + ")'>";
        likeIcon.innerHTML = "<img src='media/images/like-icon.png' alt='like' id='like-button' onmouseover='likeHover(this)' onmouseout='likeHoverRelease(this)' onclick='likeCheck(" + videoid + ")'>";

        refreshLikesDislikes(videoid);
	}
}

function dislikeUncheck(videoid) {
    let dislikeIcon = document.getElementById("dislike-icon-container");

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "delete_video_dislike.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`videoid=${videoid}`);
    xhttp.onload = function() {
        dislikeIcon.innerHTML = "<img src='media/images/dislike-icon.png' alt='dislike' id='dislike-button' onmouseover='dislikeHover(this)' onmouseout='dislikeHoverRelease(this)' onclick='dislikeCheck(" + videoid + ")'>";
        
        refreshLikesDislikes(videoid);
    }
}

function refreshLikesDislikes(videoid) {
    let likes = document.getElementById("likes-count");
    let dislikes = document.getElementById("dislikes-count");

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "select_video_likes_count.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`videoid=${videoid}`);
    xhttp.onload = function() {
        likes.innerHTML = this.responseText;	
    }

    let xhttp2 = new XMLHttpRequest();
	xhttp2.open("POST", "select_video_dislikes_count.php");
	xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp2.send(`videoid=${videoid}`);
    xhttp2.onload = function() {
        dislikes.innerHTML = this.responseText;	
    }
}

function addComment(button, videoid) {
    let comment = document.getElementById("comment-textarea").value;
    let response = document.getElementById("add-comment-response");

    if (comment == "") {
        response.innerHTML = "Write a comment first";

        setTimeout(() => {
            response.innerHTML = "";
        }, 2000);
    }
    else {
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "insert_video_comment.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`videoid=${videoid}&comment=${comment}`);
        xhttp.onload = function() {
            response.innerHTML = "Comment was added";

            setTimeout(() => {
                response.innerHTML = "";
            }, 2000);

            document.getElementById("comment-textarea").value = "";

            refreshComments(videoid);
        }
    }
}

function refreshComments(videoid) {
    let commentsContainer = document.getElementById("comments-container");

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "refresh_video_comments.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`videoid=${videoid}`);
    xhttp.onload = function() {
        commentsContainer.innerHTML = this.responseText;
    }
}

function likeCommentCheck(commentid) {
    let likeIcon = document.getElementById("comment-like-icon-container" + commentid);

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "insert_comment_like.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`commentid=${commentid}`);
    xhttp.onload = function() {
        likeIcon.innerHTML = "<img src='media/images/like-icon-checked.png' class='comment-like-icon' alt='like' onmouseover='likeCheckedHover(this)' onmouseout='likeCheckedHoverRelease(this)' onclick='likeCommentUncheck(" + commentid + ")'>";

        refreshCommentLikes(commentid);
	}
}

function likeCommentUncheck(commentid) {
    let likeIcon = document.getElementById("comment-like-icon-container" + commentid);

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "delete_comment_like.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`commentid=${commentid}`);
    xhttp.onload = function() {
        likeIcon.innerHTML = "<img src='media/images/like-icon.png' class='comment-like-icon' alt='like' onmouseover='likeHover(this)' onmouseout='likeHoverRelease(this)' onclick='likeCommentCheck(" + commentid + ")'>";

        refreshCommentLikes(commentid);
	}
}

function refreshCommentLikes(commentid) {
    let likes = document.getElementById("comment-likes" + commentid);

    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "refresh_comment_likes.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`commentid=${commentid}`);
    xhttp.onload = function() {
        likes.innerHTML = this.responseText;
	}
}

function deleteComment(commentid, videoid) {
    let xhttp = new XMLHttpRequest();
	xhttp.open("POST", "delete_comment.php");
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(`commentid=${commentid}`);
    xhttp.onload = function() {
        refreshComments(videoid);
	}
}

function editCommentShow(commentid, videoid) {
    let container = document.getElementById("comment-edit-container" + commentid);
    let commentText = document.getElementById("comment-text" + commentid).innerHTML;
    commentText = commentText.replace(/<br ?\/?>/g, "");

    container.innerHTML = "<textarea id='comment-edit-textarea" + commentid + "' rows='5' placeholder='Your comment text...'>" + commentText + "</textarea>"
    + "<button class='edit-comment-button' onclick='editComment(this, " + videoid + ", " + commentid + ")'>Edit</button>"
    + "<button class='cancel-edit-comment-button' onclick='editCommentHide(" + commentid + ")'>Cancel</button>";
}

function editCommentHide(commentid) {
    let container = document.getElementById("comment-edit-container" + commentid);

    container.innerHTML = "";
}

function editComment(button, videoid, commentid) {
    let commentText = document.getElementById("comment-edit-textarea" + commentid).value;

    if (commentText == "") {
        button.innerHTML = "Field is empty";

        setTimeout(() => {
            button.innerHTML = "Edit";
        }, 2000);
    }
    else {
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "update_comment.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`commentid=${commentid}&comment=${commentText}`);
        xhttp.onload = function() {
            refreshComments(videoid);
	    }
    }
}