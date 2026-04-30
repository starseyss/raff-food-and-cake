<x-admin-header />

<div class="ml-0 lg:ml-[90px] p-4 sm:p-6 lg:p-8 bg-[#F8F9FB] min-h-screen overflow-x-hidden">

    <!-- ================= HEADER ================= -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8 lg:mb-10">

        <!-- LEFT -->
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-start sm:items-center gap-3">
                <span class="p-2.5 bg-[#F59A40] rounded-2xl text-white shadow-lg shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 sm:h-7 sm:w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </span>

                Notifications
            </h1>

            <p class="text-sm text-gray-500 mt-2 font-medium">
                Manage and track all payment notifications
            </p>
        </div>

<!-- RIGHT -->
        <div class="w-full lg:w-auto">
            @if($unreadCount > 0)
            <form action="{{ route('admin.notifications.read-all') }}" method="POST">
                @csrf

                <button type="submit"
                    class="w-full sm:w-auto px-5 py-3 bg-[#F59A40] text-white rounded-2xl text-sm font-semibold hover:bg-orange-600 transition shadow-lg shadow-orange-200">

                    Mark All as Read

                </button>
            </form>
            @endif
        </div>

    </div>

     <!-- ================= STATS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 mb-8 lg:mb-10">

        <!-- CARD -->
        <div class="bg-white rounded-[2rem] p-5 sm:p-6 shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Total Notifications
            </p>

            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-2">
                {{ $notifications->total() }}
            </h2>
        </div>

         <!-- CARD -->
        <div class="bg-white rounded-[2rem] p-5 sm:p-6 shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Unread
            </p>

            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-2">
                {{ $unreadCount }}
            </h2>

            <p class="text-[10px] text-orange-600 font-bold bg-orange-50 px-2 py-1 rounded-lg mt-2 inline-block">
                New
            </p>
        </div>


        <!-- CARD -->
        <div class="bg-white rounded-[2rem] p-5 sm:p-6 shadow-sm border border-gray-100 sm:col-span-2 xl:col-span-1">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Read
            </p>

            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-2">
                {{ $notifications->total() - $unreadCount }}
            </h2>

            <p class="text-[10px] text-green-600 font-bold bg-green-50 px-2 py-1 rounded-lg mt-2 inline-block">
                Viewed
            </p>
        </div>

    </div>

    <!-- ================= NOTIFICATIONS LIST ================= -->
    <div class="bg-white rounded-[2rem] sm:rounded-[2.5rem] shadow-sm p-4 sm:p-6 lg:p-8 border border-gray-100">

        <!-- TITLE -->
        <div class="flex items-center gap-3 mb-6 sm:mb-8">
            <img src="{{ asset('images/notif.png') }}"
                alt="Notifications"
                class="w-9 h-9 sm:w-10 sm:h-10 object-contain">

            <h2 class="text-lg sm:text-xl font-bold text-gray-800">
                All Notifications
            </h2>
        </div>

               <!-- LIST -->
        <div class="space-y-4">

            @forelse($notifications as $notification)

            <div class="flex flex-col sm:flex-row sm:items-start gap-4 p-4 sm:p-5 rounded-3xl transition-all
                {{ $notification->is_read
                    ? 'bg-gray-50 border border-gray-100'
                    : 'bg-orange-50/50 border border-orange-100' }}">
                 <!-- TOP MOBILE -->
                <div class="flex items-start gap-4 flex-1 min-w-0">

                    <!-- ICON -->
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0
                        {{ $notification->is_read
                            ? 'bg-gray-200 text-gray-500'
                            : 'bg-[#F59A40] text-white' }}">

                        @if($notification->refund_data)
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08 .402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                        @else

                       <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                        @endif
                    </div>
<!-- CONTENT -->
                    <div class="flex-1 min-w-0">
                        <!-- TITLE -->
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <h3 class="font-bold text-gray-800 text-sm sm:text-base break-words">
                                {{ $notification->title }}
                            </h3>

                            @if(!$notification->is_read)
                            <span class="px-2 py-0.5 bg-red-500 text-white text-[10px] font-bold rounded-full">
                                NEW
                            </span>
                            @endif
                        </div>
<!-- MESSAGE -->
                        <p class="text-sm text-gray-600 mb-3 break-words leading-relaxed">
                            {{ $notification->message }}
                        </p>

                    <!-- REFUND -->
                        @if($notification->refund_data)

                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 mt-2">

                            <p class="text-xs font-semibold text-yellow-800 mb-1">
                                💳 Detail Rekening:
                            </p>
                             <p class="text-xs text-yellow-900 break-all">
                                {{ $notification->refund_data['bank_no'] }}
                                a/n
                                {{ $notification->refund_data['owner_name'] }}
                            </p>

                            @if($notification->refund_data['proof_url'])

                            <a href="{{ $notification->refund_data['proof_url'] }}"
                                target="_blank"
                                class="text-xs underline mt-2 inline-block text-yellow-700">

                                📸 Lihat Bukti

                            </a>
                            @endif
                        </div>
                    @endif
                        <!-- FOOTER -->
                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-400 mt-3">

                            <span>
                                {{ $notification->created_at->diffForHumans() }}
                            </span>

                            @if($notification->order)
                            <span class="text-orange-500 font-semibold break-all">
                                #{{ $notification->order->midtrans_order_id }}
                            </span>
                            @endif

                        </div>

                    </div>

                </div>  

                <!-- ACTIONS -->
                <div class="flex flex-row sm:flex-col lg:flex-row items-center gap-2 sm:pl-2">

                    @if(!$notification->is_read)

                    <form action="{{ route('admin.notifications.read', $notification->id) }}"
                        method="POST">

                        @csrf

                        <button type="submit"
                            class="w-9 h-9 flex items-center justify-center rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition"
                            title="Mark as Read">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7" />

                            </svg>

                        </button>

                    </form>

                    @endif

                   @if($notification->order)

                    <a href="{{ route('admin.list-order') }}"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition"
                        title="View Order">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                    </a>

                    @endif

                    <!-- REFUND -->
                    @if($notification->refund_data)

                        @if($notification->order && $notification->order->payment_status !== 'refunded')

                        <form action="{{ route('admin.notifications.process-refund', $notification->id) }}"
                            method="POST"
                            class="w-full sm:w-auto">

                            @csrf

                            <button type="submit"
                                onclick="return confirm('Yakin ingin menyelesaikan refund ini?')"
                                class="w-full sm:w-auto px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-xl transition whitespace-nowrap">

                                💸 Proses Refund

                            </button>

                        </form>

                        @else

        <div class="px-3 py-2 bg-green-100 text-green-700 text-xs font-bold rounded-xl whitespace-nowrap">
                            ✅ Sudah Refund
                        </div>

                        @endif

                    @endif

                </div>

            </div>

            @empty
            <!-- EMPTY -->
            <div class="flex flex-col items-center justify-center py-14 sm:py-16 text-gray-400 text-center px-4">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-14 w-14 sm:h-16 sm:w-16 mb-4 text-gray-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />

                </svg>

                <p class="text-lg font-medium">
                    No notifications yet
                </p>
                 <p class="text-sm mt-1">
                    Payment notifications will appear here when customers complete their orders.
                </p>

            </div>

            @endforelse

        </div>

       <!-- PAGINATION -->
        @if($notifications->hasPages())

        <div class="mt-8 overflow-x-auto">
            {{ $notifications->links() }}
        </div>

        @endif

    </div>

</div>

<x-scripts-admin />

