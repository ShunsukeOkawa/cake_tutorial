// webroot/js/article.js

function likeArticle(articleId) {
    fetch("/articles/likeToArticle/" + articleId, {
        method: "POST",
        headers: {
            "X-CSRF-Token": csrfToken,
            Accept: "application/json",
        },
    })
        .then(function (response) {
            if (!response.ok) {
                throw new Error("Network error");
            }
            return response.json();
        })
        .then(function (data) {
            btn = document.getElementById("likeBtn");

            if (data.isLike) {
                btn.classList.add("is-liked");
            } else {
                btn.classList.remove("is-liked");
            }

            var count = document.getElementById("likeCount");
            if (count) {
                count.textContent = data.likeCount;
            }
        })
        .catch(function (err) {
            console.error(err);
        });
}
