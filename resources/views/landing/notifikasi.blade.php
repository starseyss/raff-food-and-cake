<x-header />

<section class="max-w-[900px] mx-auto px-4 sm:px-6 mt-10 mb-20">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Notifikasi Pesanan
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Update status pesanan kamu akan muncul di sini.
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-4 sm:p-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">

            <div class="flex items-center gap-3">
                <img src="{{ asset('images/notif.png') }}" alt="Notifikasi" class="w-10 h-10 object-contain">
                <div>
                    <p class="text-xs uppercase tracking-wider font-bold text-gray-400">Unreads</p>
                    <p class="text-xl font-extrabold text-gray-800">{{ $unreadCount }}</p>
                </div>
            </div>

            @if($unreadCount > 0)
                <form action="{{ route('notifikasi.read-all') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="px-5 py-3 bg-[#F59A40] text-white rounded-2xl text-sm font-semibold hover:bg-orange-600 transition shadow-lg shadow-orange-200">
                        Mark All as Read
                    </button>
                </form>
            @endif

        </div>

        <div class="space-y-4">
            @forelse($notifications as $notification)

                <div class="flex flex-col sm:flex-row sm:items-start gap-4 p-4 sm:p-5 rounded-3xl border transition-all
                    {{ $notification->is_read ? 'bg-gray-50 border-gray-100' : 'bg-orange-50/50 border-orange-100' }}">

                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0
                        {{ $notification->is_read ? 'bg-gray-200 text-gray-500' : 'bg-[#F59A40] text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <h3 class="font-bold text-gray-800 text-sm sm:text-base break-words">{{ $notification->title }}</h3>
                            @if(!$notification->is_read)
                                <span class="px-2 py-0.5 bg-red-500 text-white text-[10px] font-bold rounded-full">NEW</span>
                            @endif
                        </div>

                        <p class="text-sm text-gray-600 mb-3 break-words leading-relaxed">{{ $notification->message }}</p>

                        <div class="flex items-center gap-3 text-xs text-gray-400">
                            <span>{{ $notification->created_at->diffForHumans() }}</span>
                            @if($notification->order)
                                <span class="text-orange-500 font-semibold">#{{ $notification->order->midtrans_order_id }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        @if(!$notification->is_read)
                            <form action="{{ route('notifikasi.read', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-9 h-9 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition flex items-center justify-center" title="Mark as Read">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>

                </div>

            @empty
                <div class="flex flex-col items-center justify-center py-14 sm:py-16 text-gray-400 text-center px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 sm:h-16 sm:w-16 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <p class="text-lg font-medium">Belum ada notifikasi</p>
                    <p class="text-sm mt-1">Notifikasi status pesanan akan muncul di sini.</p>
                </div>
            @endforelse
        </div>

        @if($notifications->hasPages())
            <div class="mt-8 overflow-x-auto">
                {{ $notifications->links() }}
            </div>
        @endif

    </div>
</section>

<x-footer />

