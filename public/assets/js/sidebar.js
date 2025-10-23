document.addEventListener("DOMContentLoaded", function () {
    const accordionBtns = document.querySelectorAll(".accordion-btn");
    accordionBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            const submenu = this.nextElementSibling;

            if (submenu.style.display === "block") {
                submenu.style.display = "none";
            } else {
                document.querySelectorAll(".submenu").forEach(sm => sm.style.display = "none");
                submenu.style.display = "block";
            }
        });
    });
});
