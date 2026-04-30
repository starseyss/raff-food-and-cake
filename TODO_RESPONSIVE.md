yes# TODO: Make All Views Fully Responsive for Mobile

## Information Gathered

After analyzing the project files, I've identified:

1. **CSS Framework**: Using Tailwind CSS v4 via CDN (cdn.tailwindcss.com) in header components and Vite for build
2. **Views Structure**:
   - Landing pages: home, menu, cart, checkout, contact, details, detail_pesanan, pesanan, payment, profil, success, kebijakan_privasi, syarat_ketentuan
   - Admin pages: dashboard, list-order, product, payment-list, shipping, analisis, notifications, profil, login, register
   - Auth pages: login, register, otp
   - Components: header, footer, admin-header, scripts, scripts-admin
3. **Current Responsive Issues**:
   - Many elements use fixed widths (e.g., w-[900px], w-[400px])
   - Admin sidebar is fixed at col-span-3 (not responsive)
   - Tables in admin views don't have responsive wrappers
   - Grid layouts may break on mobile
   - Some modals have fixed widths

## Plan: Add Responsive Classes to All Views

### Step 1: Update Header Component (landing)
- Add responsive max-width and padding to container
- Ensure all text sizes scale on mobile
- Fix mobile menu hidden/block toggle

### Step 2: Update Footer Component  
- Add responsive padding and text sizes
- Ensure proper mobile stacking

### Step 3: Update All Landing Views
- home.blade.php: Hero section, product grid, modals, promo slider
- menu.blade.php: Product grid responsive
- cart.blade.php: Cart items responsive layout
- checkout.blade.php: Form responsive
- detail_pesanan.blade.php: Responsive layout
- pesanan.blade.php: Orders list responsive
- payment.blade.php: Payment method cards
- profil.blade.php: Profile form responsive

### Step 4: Update All Admin Views
- admin-header.blade.php: Make sidebar responsive (hide on mobile, hamburger menu)
- dashboard.blade.php: Card grids, tables, charts responsive
- list-order.blade.php: Table responsive wrapper
- product.blade.php: Product management responsive
- shipping.blade.php: Shipping list responsive
- analisis.blade.php: Charts responsive
- notifications.blade.php: Notification list responsive
- profil.blade.php: Profile form responsive
- login.blade.php: Login form responsive
- register.blade.php: Register form responsive

### Step 5: Update Auth Views
- login.blade.php: Form responsive
- register.blade.php: Form responsive  
- otp.blade.php: Input responsive

### Step 6: Add Mobile-Specific CSS Utilities (if needed)
- Add responsive overrides in app.css
- Ensure touch-friendly tap targets (min 44px)

## Dependent Files to Edit
- All files in resources/views/
- resources/views/components/
- resources/css/app.css

## Followup Steps
1. Test each view on mobile viewport
2. Ensure all buttons are touch-friendly
3. Verify no horizontal scroll on mobile
4. Test hamburger menus work properly

## Priority Order
1. Header/Footer components (affects all pages)
2. Landing pages (most used by customers)
3. Admin pages (internal use)
4. Auth pages (critical for login/register)
