<x-admin-header />

<section class="lg:ml-[90px] p-4 sm:p-6 bg-[#F6F6F6] min-h-screen">

    <div class="max-w-4xl mx-auto">

        <!-- PAGE TITLE -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Profil Admin
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola informasi akun administrator
            </p>
        </div>

        <!-- PROFILE CARD -->
        <div class="bg-white rounded-[2rem] sm:rounded-3xl shadow-sm border border-gray-200/50 p-5 sm:p-8">

            <!-- AVATAR + INFO -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-5 sm:gap-6 mb-8">

                <!-- Avatar -->
                <div class="flex justify-center sm:justify-start">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-[#F59A40] text-white rounded-full flex items-center justify-center text-3xl sm:text-4xl font-bold shadow-lg">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>

                <!-- Info -->
                <div class="text-center sm:text-left">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 break-words">
                        {{ auth()->user()->name }}
                    </h2>

                    <div class="inline-flex items-center gap-2 mt-2 px-4 py-1.5 bg-orange-50 text-orange-600 rounded-full text-xs sm:text-sm font-semibold">
                        <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                        {{ ucfirst(auth()->user()->role ?? 'Admin') }}
                    </div>
                </div>

            </div>

            <hr class="border-gray-100 mb-6 sm:mb-8">

            <!-- DETAIL GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                <!-- Nama -->
                <div>
                    <label class="text-[11px] sm:text-xs text-gray-400 uppercase font-semibold tracking-wide">
                        Nama Lengkap
                    </label>

                    <div class="mt-2 p-4 bg-[#F9F9F9] rounded-2xl text-gray-800 font-medium break-words text-sm sm:text-base">
                        {{ auth()->user()->name }}
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="text-[11px] sm:text-xs text-gray-400 uppercase font-semibold tracking-wide">
                        Email
                    </label>

                    <div class="mt-2 p-4 bg-[#F9F9F9] rounded-2xl text-gray-800 font-medium break-all text-sm sm:text-base">
                        {{ auth()->user()->email }}
                    </div>
                </div>

                <!-- Role -->
                <div>
                    <label class="text-[11px] sm:text-xs text-gray-400 uppercase font-semibold tracking-wide">
                        Role
                    </label>

                    <div class="mt-2 p-4 bg-[#F9F9F9] rounded-2xl text-gray-800 font-medium capitalize text-sm sm:text-base">
                        {{ auth()->user()->role ?? 'Admin' }}
                    </div>
                </div>

                <!-- Bergabung -->
                <div>
                    <label class="text-[11px] sm:text-xs text-gray-400 uppercase font-semibold tracking-wide">
                        Bergabung Sejak
                    </label>

                    <div class="mt-2 p-4 bg-[#F9F9F9] rounded-2xl text-gray-800 font-medium text-sm sm:text-base">
                        {{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '-' }}
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>

<x-scripts-admin />