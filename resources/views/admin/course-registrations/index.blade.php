<x-app-layout>
    <x-slot name="header">Course Students & Payments</x-slot>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Students</p><p class="text-2xl text-white font-bold">{{ $studentCount }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Enrollments</p><p class="text-2xl text-white font-bold">{{ $enrollmentCount }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Revenue</p><p class="text-2xl text-white font-bold">₦{{ number_format($paidTotal, 2) }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Pending Payments</p><p class="text-2xl text-white font-bold">{{ $pendingPayments }}</p></div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl overflow-hidden">
            <div class="p-4 border-b border-gray-700/50"><h3 class="text-white font-semibold">Registered Students</h3></div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-gray-400 bg-gray-900/40"><tr><th class="text-left p-3">Student</th><th class="text-left p-3">Course</th><th class="text-left p-3">Status</th><th class="text-left p-3">Progress</th></tr></thead>
                    <tbody class="divide-y divide-gray-700/50">
                        @forelse($enrollments as $enrollment)
                            <tr>
                                <td class="p-3 text-white">{{ $enrollment->user->name ?? 'Student' }}<br><span class="text-xs text-gray-500">{{ $enrollment->user->email ?? '' }}</span></td>
                                <td class="p-3 text-gray-300">{{ $enrollment->course->title ?? 'Course' }}</td>
                                <td class="p-3 text-gray-300">{{ ucfirst($enrollment->status) }}</td>
                                <td class="p-3 text-gray-300">{{ $enrollment->progress }}%</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="p-6 text-center text-gray-400">No enrollments yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">{{ $enrollments->links() }}</div>
        </div>

        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl overflow-hidden">
            <div class="p-4 border-b border-gray-700/50"><h3 class="text-white font-semibold">Recent Payments</h3></div>
            <div class="divide-y divide-gray-700/50">
                @forelse($payments as $payment)
                    <div class="p-4 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-white font-medium">{{ $payment->user->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500">{{ $payment->transaction_id }} • {{ $payment->payment_method }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-white">₦{{ number_format($payment->amount, 2) }}</p>
                            <p class="text-xs {{ in_array($payment->status, ['paid', 'successful']) ? 'text-green-400' : 'text-yellow-400' }}">{{ ucfirst($payment->status) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="p-6 text-center text-gray-400">No payments yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
