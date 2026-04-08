@if(session('resetPopup'))
<script>
    localStorage.removeItem("popupShown");
</script>
@endif
<script>
document.addEventListener("DOMContentLoaded", function () {

    // ================= PROFILE DROPDOWN =================
    const profileBtn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('profileDropdown');

    profileBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function () {
        dropdown.classList.add('hidden');
    });

    dropdown.addEventListener('click', function (e) {
        e.stopPropagation();
    });


});
// ================= PRODUCT MODAL =================
const productModal = document.getElementById("productModal");
const closeProductModal = document.getElementById("closeProductModal");
const openButtons = document.querySelectorAll(".openProductModal");

openButtons.forEach(btn => {
    btn.addEventListener("click", function () {
        productModal.classList.remove("hidden");
    });
});

closeProductModal.addEventListener("click", function () {
    productModal.classList.add("hidden");
});

// klik area gelap untuk close
productModal.addEventListener("click", function (e) {
    if (e.target === productModal) {
        productModal.classList.add("hidden");
    }
});
// ================= SUCCESS POPUP =================
const addToCartBtn = document.getElementById("addToCartBtn");
const successPopup = document.getElementById("successPopup");

addToCartBtn.addEventListener("click", function () {

    // Tutup modal produk
    productModal.classList.add("hidden");

    // Tampilkan popup sukses
    successPopup.classList.remove("hidden");

});

// Klik luar untuk close popup sukses
successPopup.addEventListener("click", function (e) {
    if (e.target === successPopup) {
        successPopup.classList.add("hidden");
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const popup = document.getElementById("welcomePopup");
    const closeBtn = document.getElementById("closePopup");

    popup.addEventListener("click", function (e) {
        if (e.target === popup) {
            popup.style.display = "none";
        }
    });

    closeBtn.addEventListener("click", function () {
        popup.style.display = "none";
    });

});
</script>
<script>
document.querySelectorAll('.filterBtn').forEach(button => {
    button.addEventListener('click', function() {

        // Reset semua tombol
        document.querySelectorAll('.filterBtn').forEach(btn => {
            btn.classList.remove(
                'bg-[#F59A40]',
                'text-white',
                'border-[#F59A40]'
            );
            btn.classList.add(
                'bg-[#F2F2F2]',
                'text-gray-700',
                'border-gray-200'
            );
        });

        // Aktifkan yang diklik
        this.classList.remove(
            'bg-[#F2F2F2]',
            'text-gray-700',
            'border-gray-200'
        );
        this.classList.add(
            'bg-[#F59A40]',
            'text-white',
            'border-[#F59A40]'
        );
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const selectAll = document.getElementById("selectAll");
    const productCheckboxes = document.querySelectorAll(".productCheckbox");

    // ================= SELECT ALL CLICK =================
    if (selectAll) {
        selectAll.addEventListener("change", function () {
            productCheckboxes.forEach(cb => {
                cb.checked = selectAll.checked;
            });
        });
    }

    // ================= INDIVIDUAL CHECKBOX =================
    productCheckboxes.forEach(cb => {
        cb.addEventListener("change", function () {

            const total = productCheckboxes.length;
            const checked = document.querySelectorAll(".productCheckbox:checked").length;

            if (checked === total) {
                selectAll.checked = true;
            } else {
                selectAll.checked = false;
            }

        });
    });

});
</script>

</body>
</html>