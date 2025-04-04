document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("rating");

    stars.forEach(star => {
        star.addEventListener("mouseover", function () {
            const value = this.getAttribute("data-value");
            highlightStars(value);
        });

        star.addEventListener("mouseout", function () {
            highlightStars(ratingInput.value);
        });

        star.addEventListener("click", function () {
            const value = this.getAttribute("data-value");
            ratingInput.value = value;
            highlightStars(value);
        });
    });

    function highlightStars(value) {
        stars.forEach(star => {
            if (star.getAttribute("data-value") <= value) {
                star.src = "/assets/img/filled_star.svg";
            } else {
                star.src = "/assets/img/star.svg";
            }
        });
    }
});