document.addEventListener("DOMContentLoaded", function () {
    var headers = document.querySelectorAll(".accordion-header");

    headers.forEach(function (header) {
        header.addEventListener("click", function () {
            var section = header.parentElement;
            var isOpen = section.classList.contains("is-open");

            if (isOpen) {
                section.classList.remove("is-open");
            } else {
                section.classList.add("is-open");
            }
        });
    });

    var buttons = document.querySelectorAll("button, .button");
    buttons.forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            this.blur();
        });
    });
});
