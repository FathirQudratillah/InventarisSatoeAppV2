const password = document.querySelector('input[name="password"]');
const confirmPassword = document.querySelector(
    'input[name="password_confirmation"]',
);

confirmPassword?.addEventListener("input", function () {
    if (password.value !== confirmPassword.value) {
        confirmPassword.setCustomValidity("Password tidak sama");
    } else {
        confirmPassword.setCustomValidity("");
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const roleSelect = document.querySelector(".role");

    const siswaFields = document.querySelectorAll(".siswaField");
    const nipField = document.querySelector(".nipField");

    const nis = document.getElementById("nis");
    const angkatan = document.getElementById("angkatan");
    const jurusan = document.getElementById("jurusan");
    const subkelas = document.getElementById("subkelas");
    const no_absen = document.getElementById("no_absen");
    const nip = document.getElementById("nip");

    function toggleSiswaFields() {
        if (roleSelect.value === "siswa") {
            // tampilkan semua field siswa
            siswaFields.forEach((field) => {
                field.classList.remove("hidden");
            });

            nis?.setAttribute("required", true);
            angkatan?.setAttribute("required", true);
            jurusan?.setAttribute("required", true);
            subkelas?.setAttribute("required", true);
            no_absen?.setAttribute("required", true);

            // sembunyikan nip
            if (nipField) {
                nipField.classList.add("hidden");
                nip?.removeAttribute("required");
            }
        } else if (roleSelect.value === "guru") {
            // sembunyikan semua field siswa
            siswaFields.forEach((field) => {
                field.classList.add("hidden");
            });

            nis?.removeAttribute("required");
            angkatan?.removeAttribute("required");
            jurusan?.removeAttribute("required");
            subkelas?.removeAttribute("required");
            no_absen?.removeAttribute("required");

            // tampilkan nip
            if (nipField) {
                nipField.classList.remove("hidden");
                nip?.setAttribute("required", true);
            }
        } else {
            // default sembunyikan semua
            siswaFields.forEach((field) => {
                field.classList.add("hidden");
            });

            if (nipField) {
                nipField.classList.add("hidden");
            }

            nis?.removeAttribute("required");
            angkatan?.removeAttribute("required");
            jurusan?.removeAttribute("required");
            subkelas?.removeAttribute("required");
            no_absen?.removeAttribute("required");
            if (nip) nip?.removeAttribute("required");
        }
    }

    roleSelect?.addEventListener("change", toggleSiswaFields);
    toggleSiswaFields();
});
