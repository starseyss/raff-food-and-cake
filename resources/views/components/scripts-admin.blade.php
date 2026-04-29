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
<script>
/* ========================
   NOTIFICATION SYSTEM
   ======================== */
document.addEventListener("DOMContentLoaded", function () {
    // Fix: Get elements properly
    const notifBtn = document.getElementById("notifBellBtn");
    const notifDropdown = document.getElementById("notifDropdown");
    const notifList = document.getElementById("notifList");
    const headerBadge = document.getElementById("headerNotifBadge");
    const sidebarBadge = document.getElementById("sidebarNotifBadge");

    console.log('Admin scripts loaded, badge found:', !!headerBadge); // Debug

    // Force immediate update
    if (headerBadge) {
        updateUnreadCount();
    }

    // Toggle dropdown
    if (notifBtn) {
        notifBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            notifDropdown.classList.toggle("hidden");
            if (!notifDropdown.classList.contains("hidden")) {
                loadLatestNotifications();
            }
        });
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", function (e) {
        if (notifDropdown && !notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add("hidden");
        }
    });

    // Load unread count - FIXED for HTTPS/Cloudflare
    function updateUnreadCount() {
        // Fixed: Use root-relative path (works with Cloudflare tunnel)
        const url = '/admin/notifications/unread-count';
        
        fetch(url)
            .then(r => r.json())
            .then(data => {
                const count = data.count || 0;
                console.log('Unread count:', count); // Debug log
                
                if (count > 0) {
                    headerBadge.textContent = count > 99 ? '99+' : count;
                    headerBadge.classList.remove("hidden");
                    
                    if (sidebarBadge) {
                        sidebarBadge.textContent = count > 99 ? '99+' : count;
                        sidebarBadge.classList.remove("hidden");
                    }
                } else {
                    headerBadge.classList.add("hidden");
                    if (sidebarBadge) sidebarBadge.classList.add("hidden");
                }
            })
            .catch(err => console.error('Notification fetch error:', err));
    }

    // Load latest notifications for dropdown
    function loadLatestNotifications() {
        if (!notifList) return;
        notifList.innerHTML = '<div class="p-4 text-center text-sm text-gray-400">Loading...</div>';

        fetch('/admin/notifications/latest')
            .then(r => r.json())
            .then(data => {
                const notifs = data.notifications || [];
                if (notifs.length === 0) {
                    notifList.innerHTML = `
                        <div class="p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <p class="text-sm text-gray-400">No new notifications</p>
                        </div>`;
                    return;
                }

                let html = '';
                notifs.forEach(n => {
                    html += `
                        <a href="{{ route('admin.notifications') }}" class="block px-4 py-3 hover:bg-orange-50 transition border-b border-gray-50 last:border-0">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full ${n.is_read ? 'bg-gray-200 text-gray-500' : 'bg-[#F59A40] text-white'} flex items-center justify-center flex-shrink-0 text-xs">
                                    ✓
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">${escapeHtml(n.title)}</p>
                                    <p class="text-xs text-gray-500 truncate">${escapeHtml(n.message)}</p>
                                    <p class="text-[10px] text-gray-400 mt-1">${escapeHtml(n.created_at)}</p>
                                </div>
                                ${!n.is_read ? '<span class="w-2 h-2 bg-red-500 rounded-full flex-shrink-0 mt-1"></span>' : ''}
                            </div>
                        </a>
                    `;
                });
                notifList.innerHTML = html;
            })
            .catch(() => {
                notifList.innerHTML = '<div class="p-4 text-center text-sm text-gray-400">Failed to load</div>';
            });
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Initial load
    updateUnreadCount();

    // Poll every 30 seconds
    setInterval(updateUnreadCount, 30000);
});
</script>
</body>
</html>
