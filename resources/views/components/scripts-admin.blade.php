<script>
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("adminProfileBtn");
    const dropdown = document.getElementById("adminProfileDropdown");

    btn.addEventListener("click", function () {
        dropdown.classList.toggle("hidden");
    });

    document.addEventListener("click", function (e) {
        if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add("hidden");
        }
    });
});
</script>
<script>
function tambahVarian() {
    let container = document.getElementById('varian-container');

    let html = `
        <div class="flex gap-2 mb-2">
            <input type="text" name="varian[]" 
                   class="w-full border rounded-lg p-2" 
                   placeholder="Contoh: Hitam / L">

            <button type="button" onclick="hapusVarian(this)" 
                    class="bg-red-500 text-white px-3 rounded">
                ✕
            </button>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', html);
}

function hapusVarian(btn) {
    btn.parentElement.remove();
}
</script>
</body>
</html>