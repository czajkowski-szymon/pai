const likeButtons = document.querySelectorAll(".fa-thumbs-up");
const dislikeButtons = document.querySelectorAll(".fa-thumbs-down");

function like() {
    const likes = this;
    const dislikes = likes.nextElementSibling;
    const container = likes.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(
        `/like/${id}`
    ).then(function (response) {
        return response.json();
    }).then(function(response) {
        likes.innerHTML = parseInt(response.likes);
        dislikes.innerHTML = parseInt(response.dislikes);
    });
}

function dislike() {
    const dislikes = this;
    const likes = dislikes.previousElementSibling; 
    const container = likes.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(
        `/dislike/${id}`
    ).then(function (response) {
        return response.json();
    }).then(function(response) {
        likes.innerHTML = parseInt(response.likes);
        dislikes.innerHTML = parseInt(response.dislikes);
    });
}

likeButtons.forEach(button => button.addEventListener("click",  like));
dislikeButtons.forEach(button => button.addEventListener("click",  dislike));