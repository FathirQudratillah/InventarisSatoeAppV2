

function toggleDropdown(button) {
    const wrapper = button.closest(".relative");
    const dropdown = wrapper.querySelector(".dropdown-menu");

    // Tutup dropdown lain
    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
        if (menu !== dropdown) {
            menu.classList.add("hidden");
        }
    });

    dropdown.classList.toggle("hidden");

    if (!dropdown.classList.contains("hidden")) {
        // Reset posisi
        dropdown.style.top = "";
        dropdown.style.bottom = "";

        const buttonRect = button.getBoundingClientRect();
        const dropdownHeight = dropdown.offsetHeight;
        const spaceBelow = window.innerHeight - buttonRect.bottom;

        if (spaceBelow < dropdownHeight) {
            // Tampilkan ke atas
            dropdown.style.bottom = button.offsetHeight + "px";
        } else {
            // Tampilkan ke bawah
            dropdown.style.top = button.offsetHeight + "px";
        }
    }
}

window.toggleDropdown = toggleDropdown;

// Tutup kalau klik di luar
document.addEventListener("click", function (e) {
    if (!e.target.closest(".relative")) {
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
            menu.classList.add("hidden");
        });
    }
});
