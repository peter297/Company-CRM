<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $company->name }}
            </h2>

            <div class="flex space-x-2">
                <a href="{{ route('companies.index')}}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Back to List
                </a>

                @can('update', $company)
                    <a href="{{ route('companies.edit', $company)}}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        Edit Company

                    </a>

                @endcan

            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Success Message --}}
            @if (session('session'))

                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('session') }}</span>

                </div>

            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-x-6">
                    {{-- Company Information Card --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 px-4 h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center text-white text-3xl font-bold sm:hidden">
                                        {{ substr($company->name, 0, 2) }}
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-2xl font-bold text-gray-900">{{ $company->name }}</h3>
                                        @if ($company->industry)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 ">{{ $company->industry }}</span>
                                        @endif

                                    </div>

                                </div>

                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Contact Information --}}
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 uppercase mb-3">Contact Information
                                    </h4>

                                    @if ($company->email)

                                        <div class="mb-3">
                                            <p class="text-xs text-gray-500">Email</p>
                                            <a href="mailto:{{ $company->email }}"
                                                class="text-sm text-blue-600 hover:text-blue-800">

                                                {{ $company->email }}</a>

                                        </div>
                                    @endif

                                    @if ($company->phone)
                                        <div class="mb-3">
                                            <p class="text-xs text-gray-500">Phone</p>
                                            <a href="tel:{{ $company->phone }}" class="text-sm text-gray-600">

                                                {{ $company->phone }}</a>
                                        </div>
                                    @endif

                                    @if ($company->website)
                                        <p class="text-xs text-gray-500">Website</p>
                                        <a href="{{ $company->website }}" target="_blank"
                                            class="text-sm text-blue-600 hover:text-blue-800">{{ $company->website }}</a>
                                    @endif
                                </div>

                                {{-- Address Information --}}

                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 uppercase mb-3">Address</h4>

                                    @if ($company->full_address)

                                        <p class="text-sm text-gray-900">{{ $company->full_address }}</p>

                                    @else
                                        <p class="text-sm text-gray-900 italic">No Adress Provided</p>
                                    @endif
                                </div>

                            </div>

                            {{-- Notes --}}
                            @if ($company->notes)
                                <div class="mt-6  border-t border-b border-gray-200 py-6">
                                    <h4 class="text-sm font-semibold text-gray-700 uppercase mb-3">Notes</h4>
                                    <p class="text-sm text-gray-900 whitespace-pre-line">{{ $company->notes }}</p>

                                </div>

                            @endif

                        </div>

                    </div>

                    {{-- Activities Section --}}

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activities</h3>
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No activities yet</p>
                                <p class="text-xs text-gray-400">Activities module coming soon</p>
                            </div>
                        </div>

                    </div>

                </div>

                {{-- Sidebar --}}

                <div class="space-y-6">
                    {{-- Quick Info Card --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Details</h3>

                            <div class="space-y-4">
                                {{-- Assigned To --}}
                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Assigned To</p>
                                    <div class="mt-1 flex items-center">
                                        <div
                                            class="flex-shrink-0 h-8 w-8 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 text-xs font-semibold">
                                            {{ substr($company->assignedTo->name, 0, 2) }}
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $company->assignedTo->name }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ ucfirst($company->assignedTo->role) }}
                                            </p>

                                        </div>
                                    </div>
                                </div>

                                {{-- Creates Date --}}

                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Created</p>
                                    <p class="text-sm text-gray-900">{{ $company->created_at->format('d M, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $company->created_at->diffForHumans() }}</p>
                                </div>

                                {{-- Last Updated --}}

                                <div>
                                    <p class="text-xs text-gray-500 uppercase">Updated</p>
                                    <p class="text-sm text-gray-900">{{ $company->updated_at->format('d M, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $company->updated_at->diffForHumans() }}</p>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Actions Hard --}}

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>

                            <div class="space-y-2">
                                @can('update', $company)
                                    <a href="{{ route('companies.edit', $company) }}"
                                        class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm font-medium">
                                        Edit Company
                                    </a>
                                @endcan

                                @can('delete', $company)
                                    <form method="POST" action="{{ route('companies.destroy', $company) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this company?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="block w-full text-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm font-medium">
                                            Delete Company
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h3>

                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Contacts</span>
                                    <span class="text-lg font-semibold text-gray-900">0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Deals</span>
                                    <span class="text-lg font-semibold text-gray-900">0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Tasks</span>
                                    <span class="text-lg font-semibold text-gray-900">0</span>
                                </div>
                            </div>

                            <p class="mt-4 text-xs text-gray-400 text-center">Full stats coming soon</p>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>

</x-app-layout>