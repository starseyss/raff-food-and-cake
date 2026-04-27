# TODO — Fix Update Status di list-order.blade.php

- [x] Identifikasi masalah: URL form action JS tidak sesuai dengan route Laravel
- [x] Fix `list-order.blade.php` — ubah form.action ke `/admin/orders/${id}/status`
- [x] Fix `routes/web.php` — pindahkan `admin.updateStatus` ke dalam grup middleware `isAdmin`

