<x-app-layout>
    <!-- Page Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900 tracking-wide">
                {{ __('Dashboard') }}
            </h2>
            <span class="text-sm text-gray-500">
                {{ now()->format('F j, Y') }}
            </span>
        </div>
    </x-slot>

    <!-- Main Content -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Card -->
            <div class="bg-white shadow-lg sm:rounded-lg border border-gray-100 hover:shadow-xl transition duration-300">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        {{ __("Welcome Back!") }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __("You're logged in and ready to start writing your next journal entry.") }}
                    </p>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- New Entry -->
                <a href="{{ route('entries.create') }}" 
                   class="bg-gradient-to-r from-blue-500 to-indigo-500 p-6 rounded-lg text-white shadow hover:from-blue-600 hover:to-indigo-600 transition duration-300">
                    <h4 class="text-lg font-bold mb-1">✏️ New Journal Entry</h4>
                    <p class="text-sm opacity-90">Capture your thoughts and moments.</p>
                </a>

                <!-- My Entries -->
                <a href="{{ route('entries.index') }}" 
                   class="bg-gradient-to-r from-green-500 to-emerald-500 p-6 rounded-lg text-white shadow hover:from-green-600 hover:to-emerald-600 transition duration-300">
                    <h4 class="text-lg font-bold mb-1">📚 My Entries</h4>
                    <p class="text-sm opacity-90">View and manage your journal history.</p>
                </a>

                <!-- Profile -->
                <a href="{{ route('profile.edit') }}" 
                   class="bg-gradient-to-r from-purple-500 to-pink-500 p-6 rounded-lg text-white shadow hover:from-purple-600 hover:to-pink-600 transition duration-300">
                    <h4 class="text-lg font-bold mb-1">⚙️ Profile Settings</h4>
                    <p class="text-sm opacity-90">Update your personal information.</p>
                </a>

            </div>

            <!-- Recent Entries Preview -->
            <div class="bg-white shadow-lg sm:rounded-lg p-6 border border-gray-100">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    🕑 Recent Entries
                </h3>
                
                <div class="space-y-4">
                    @forelse($recentEntries ?? [] as $entry)
                        <div class="p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            <h4 class="font-bold text-gray-900">{{ $entry->title }}</h4>
                            <p class="text-sm text-gray-600">{{ Str::limit($entry->content, 100) }}</p>
                            <span class="text-xs text-gray-400">{{ $entry->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">No recent entries yet. Start writing today!</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
