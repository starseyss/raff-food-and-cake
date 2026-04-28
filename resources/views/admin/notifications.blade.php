<x-admin-header />

<div class="ml-[90px] p-8 bg-[#F8F9FB] min-h-screen">

    <!-- ================= HEADER ================= -->
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                <span class="p-2.5 bg-[#F59A40] rounded-2xl text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </span>
                Notifications
            </h1>
            <p class="text-sm text-gray-500 mt-2 font-medium">Manage and track all payment notifications</p>
        </div>

        <div class="flex items-center gap-4">
            @if($unreadCount > 0)
            <form action="{{ route('admin.notifications.read-all') }}" method="POST">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-[#F59A40] text-white rounded-2xl text-sm font-semibold hover:bg-orange-600 transition shadow-lg shadow-orange-200">
                    Mark All as Read
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- ================= STATS ================= -->
    <div class="grid grid-cols-3 gap-5 mb-10">
        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Notifications</p>
            <h2 class="text-3xl font-extrabold text-gray-800 mt-2">{{ $notifications->total() }}</h2>
        </div>

        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Unread</p>
            <h2 class="text-3xl font-extrabold text-gray-800 mt-2">{{ $unreadCount }}</h2>
            <p class="text-[10px] text-orange-600 font-bold bg-orange-50 px-2 py-1 rounded-lg self-start mt-2 inline-block">New</p>
        </div>

        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Read</p>
            <h2 class="text-3xl font-extrabold text-gray-800 mt-2">{{ $notifications->total() - $unreadCount }}</h2>
            <p class="text-[10px] text-green-600 font-bold bg-green-50 px-2 py-1 rounded-lg self-start mt-2 inline-block">Viewed</p>
        </div>
    </div>

    <!-- ================= NOTIFICATIONS LIST ================= -->
    <div class="bg-white rounded-[2.5rem] shadow-sm p-8 border border-gray-100">
        <div class="flex items-center gap-3 mb-8">
            <img src="{{ asset('images/notif.png') }}" alt="Notifications" class="w-10 h-10 object-contain">
            <h2 class="text-xl font-bold text-gray-800">All Notifications</h2>
        </div>

        <div class="space-y-4">
            @forelse($notifications as $notification)
            <div class="flex items-start gap-4 p-5 rounded-3xl transition-all {{ $notification->is_read ? 'bg-gray-50 border border-gray-100' : 'bg-orange-50/50 border border-orange-100' }}">
                <!-- Icon -->
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 {{ $notification->is_read ? 'bg-gray-200 text-gray-500' : 'bg-[#F59A40] text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <h3 class="font-bold text-gray-800 text-sm">{{ $notification->title }}</h3>
                        @if(!$notification->is_read)
                        <span class="px-2 py-0.5 bg-red-500 text-white text-[10px] font-bold rounded-full">NEW</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 mb-2">{{ $notification->message }}</p>
                    <div class="flex items-center gap-3 text-xs text-gray-400">
                        <span>{{ $notification->created_at->diffForHumans() }}</span>
                        @if($notification->order)
                        <span class="text-orange-500 font-semibold">#{{ $notification->order->midtrans_order_id }}</span>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-2 flex-shrink-0">
                    @if(!$notification->is_read)
                    <form action="{{ route('admin.notifications.read', $notification->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition" title="Mark as Read">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </form>
                    @endif

                    @if($notification->order)
                    <a href="{{ route('admin.list-order') }}" class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition" title="View Order">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <p class="text-lg font-medium">No notifications yet</p>
                <p class="text-sm">Payment notifications will appear here when customers complete their orders.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>

</div>

<x-scripts-admin />

