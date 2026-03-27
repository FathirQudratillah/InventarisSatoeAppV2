// Dropdown functionality
document.querySelectorAll("button[aria-controls]").forEach((button) => {
    button.addEventListener("click", () => {
        const isExpanded = button.getAttribute("aria-expanded") === "true";
        const dropdownContent = document.getElementById(
            button.getAttribute("aria-controls"),
        );

        button.setAttribute("aria-expanded", !isExpanded);
        dropdownContent.classList.toggle("hidden");
        button.querySelector("svg:last-child").classList.toggle("rotate-180");
    });
});

window.toggleSidebar = function () {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    sidebar.classList.toggle("-translate-x-full");
    overlay.classList.toggle("hidden");
};
