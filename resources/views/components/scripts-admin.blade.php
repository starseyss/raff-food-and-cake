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
</body>
</html>