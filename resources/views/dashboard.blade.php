<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('companies.create')}}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                Add Company
            </a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- -Quick Starts Card --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-600 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Companies</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $stats['total_companies'] }}
                                    </dd>
                                </dl>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- This month --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">This Month</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">
                                        {{ $stats['companies_this_month'] }}
                                    </dd>
                                </dl>

                            </div>

                        </div>

                    </div>


                </div>
                {{-- ### --}}

                {{-- This Week --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-600 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">This Week</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $stats['companies_this_week'] }}
                                    </dd>
                                </dl>

                            </div>

                        </div>

                    </div>


                </div>
                {{-- ### --}}



                {{-- My Companies --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-600 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">This Week</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $stats['my_companies'] }}</dd>
                                </dl>

                            </div>

                        </div>

                    </div>


                </div>
                {{-- ### --}}

            </div>

            {{-- Charts Row --}}

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Companies by Industry (Pie Chart) --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Companies by Industry</h3>
                        <canvas id="industryChart" height="200"></canvas>
                    </div>
                </div>

                {{-- Companies Over Time (Line Chart) --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Companies Added (Last 12 Months)</h3>
                        <canvas id="timeChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            {{-- Top Users & Recent Companies Row --}}

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Top Users bar CHart --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Users (Companies) </h3>
                        <canvas id="usersChart" height="200"></canvas>

                    </div>

                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Industries</h3>
                        <div class="space-y-4">
                            @forelse($topIndustries as $industry)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $industry->industry }}
                                        </span>

                                    </div>

                                    <span class="text-2xl font-semibold text-gray-900">{{ $industry->count }}</span>

                                </div>

                            @empty

                                    <p class="text-gray-900 font-semibold text-2xl">No Industry Data Available</p>
                            @endforelse
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const byIndustry = document.getElementById('industryChart').getContext('2d');

        new Chart(byIndustry, {
            type: 'pie',
            data: {
                labels: @json($companiesByIndustry->pluck('industry')),
                datasets: [{
                    data: @json($companiesByIndustry->pluck('count')),
                    backgroundColor: [
                        '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
                        '#EC4899', '#14B8A6', '#F97316', '#6366F1', '#84CC16'
                    ]
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Bar Chart for Users

        const usersData = document.getElementById('timeChart').getContext('2d');
        new Chart(usersData, {
            type: 'line',
            data: {
                labels: @json($companiesOverTime->pluck('month')),
                datasets: [{
                    label: 'Companies Added',
                    data: @json($companiesOverTime->pluck('count')),
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },

            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            },

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        });

        const usersCtx = document.getElementById('usersChart').getContext('2d');
        new Chart(usersCtx, {
            type: 'bar',
            data: {
                labels: @json($topUsers->pluck('assignedTo.name')),
                datasets: [{
                    label: 'Companies',
                    data: @json($topUsers->pluck('count')),
                    backgroundColor: '#10B981'
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>

</x-app-layout>
