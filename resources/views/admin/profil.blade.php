<x-admin-header />

<section class="ml-[90px] p-6 bg-[#F6F6F6] min-h-[calc(100vh-120px)]">

    <div class="max-w-4xl mx-auto">

        <!-- Page Title -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Profil Admin</h1>

        <!-- Profile Card -->
        <div class="bg-white rounded-3xl shadow border border-gray-200/50 p-8">

            <!-- Avatar + Basic Info -->
            <div class="flex items-center gap-6 mb-8">
                <div class="w-20 h-20 bg-[#F59A40] text-white rounded-full flex items-center justify-center text-3xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-gray-500">{{ ucfirst(auth()->user()->role ?? 'Admin') }}</p>
                </div>
            </div>

            <hr class="border-gray-100 mb-8">

            <!-- Detail Info Grid -->
            <div class="grid sm:grid-cols-2 gap-6">

                <div>
                    <label class="text-xs text-gray-400 uppercase font-semibold tracking-wide">Nama Lengkap</label>
                    <div class="mt-2 p-4 bg-[#F9F9F9] rounded-2xl text-gray-800 font-medium">
                        {{ auth()->user()->name }}
                    </div>
                </div>

                <div>
                    <label class="text-xs text-gray-400 uppercase font-semibold tracking-wide">Email</label>
                    <div class="mt-2 p-4 bg-[#F9F9F9] rounded-2xl text-gray-800 font-medium">
                        {{ auth()->user()->email }}
                    </div>
                </div>

                <div>
                    <label class="text-xs text-gray-400 uppercase font-semibold tracking-wide">Role</label>
                    <div class="mt-2 p-4 bg-[#F9F9F9] rounded-2xl text-gray-800 font-medium capitalize">
                        {{ auth()->user()->role ?? 'Admin' }}
                    </div>
                </div>

                <div>
                    <label class="text-xs text-gray-400 uppercase font-semibold tracking-wide">Bergabung Sejak</label>
                    <div class="mt-2 p-4 bg-[#F9F9F9] rounded-2xl text-gray-800 font-medium">
                        {{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '-' }}
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>

<x-scripts-admin />

