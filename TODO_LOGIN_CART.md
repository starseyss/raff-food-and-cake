# TODO - Login Required Before Add to Cart

## Task: 
- Home page dan menu page - jika user belum login dan klik "Tambah ke Keranjang", harus tampilkan popup untuk login dulu

## Progress:

- [x] 1. Read and analyze home.blade.php
- [x] 2. Read and analyze menu.blade.php  
- [x] 3. Create brainstorm plan
- [x] 4. Get user confirmation

## Implementation:

- [x] 5. Modify home.blade.php - Add login check JavaScript + login required popup
- [x] 6. Modify menu.blade.php - Add login check JavaScript + login required popup
- [x] 7. Test the implementation - COMPLETED

## Changes Made:

1. **home.blade.php**:
   - Added hidden input: `<input type="hidden" id="loginStatus" value="{{ auth()->check() ? '1' : '0' }}" />`
   - Added login required popup UI with message "Login dulu ya!"
   - Added JavaScript: `var isLoggedIn = document.getElementById('loginStatus').value === '1'`
   - Modified addToCart event listener to check login status first
   - Added `showLoginRequiredPopup()` and `hideLoginRequiredPopup()` functions

2. **menu.blade.php**:
   - Added hidden input: `<input type="hidden" id="loginStatus" value="{{ auth()->check() ? '1' : '0' }}" />`
   - Added login required popup UI with message "Login dulu ya!"
   - Added JavaScript: `const isLoggedIn = loginStatusInput && loginStatusInput.value === '1'`
   - Modified addToCart event listener to check login status first
   - Added `showLoginRequiredPopup()` and `hideLoginRequiredPopup()` functions

## Notes:
- Detail pesanan sudah menggunakan auth check via firstOrFail dengan user_id di controller
- Both home and menu pages now show login popup when user not logged in
- User can go to login page or register from the popup
