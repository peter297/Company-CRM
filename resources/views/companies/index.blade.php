<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __ ('Companies') }}
            </h2>
            @can('create', App\Models\Company::class)
               <a href="{{ route('companies.create')}}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
               Add Company
               </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Seuccess Message --}}
            @if (session('success'))
              <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">

                <span class="block sm:inline">{{ session('success') }}</span>
              </div>
                
            @endif

    {{-- Search and FIlters --}}

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6">
            <form action="{{ route('companies.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Search functionality --}}
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                        <input type="text"
                        name="search"
                        id="search"
                        value="{{ request('search') }}"
                        placeholder="Search companies..."
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Industry Filter --}}
                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                        <select name="industry" 
                        id="industry"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Industries</option>
                    @foreach ($industries  as $industry )
                    <option value="{{ $industry }}" {{ request('industry') == $industry ? 'selected' : '' }}>
                        {{ $industry }}
                    </option>  
                    @endforeach
                    
                    </select>
                    </div>

                    {{-- User FIlter (Only for Managers / Admins) --}}
                    @if (in_array(auth()->user()->role, ['manager', 'admin']))
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Assigned To</label>
                            <select name="user_id" 
                            id="user_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Users</option>
                            @foreach ($users as $user )
                                  <option value="{{ $user->id }}" {{ request("user_id") == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option> 
                            @endforeach
                          
                        </select>
                        </div>
                    @endif
                </div>

                <div class="flex justify-between items-center">
                    <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Apply Filters
                    </button>

                    @if (request()->hasAny(['search', 'industry', 'user_id']))
                    <a href="{{ route('companies.index') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">
                        Clear Filters
                    </a>       
                    @endif

                </div>

            </form>

        </div>

    </div>
    {{-- Companies Table --}}

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            @if ($companies->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Company Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Industry
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Assigned To
                            </th>
                             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>

                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($companies as $company )
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                                                {{ substr($company->name, 0, 2) }}
                                            </div>

                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('companies.show', $company) }}" class="hover:text-blue-600">
                                                    {{ $company->name }}

                                                </a>

                                            </div>
                                            @if ($company->website)
                                            <div class="text-sm text-gray-500">
                                                <a href="{{ $company->website }}" target="_blank" class="hover:text-blue-600">
                                                    {{ Str::limit($company->website, 30) }}
                                                </a>

                                            </div>
                                                
                                            @endif
                                        </div>

                                    </div>


                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $company->email ?? '-' }}</div>

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($company->industry)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $company->industry }}

                                    </span>
                                    @else
                                    <span class="text-sm text-gray-500">-</span>
                                        
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $company->assignedTo->name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    @can('view', $company)
                                    <a href="{{ route('companies.show', $company) }}"
                                    class="text-blue-600 hover:text-blue-900">View</a>
                                        
                                    @endcan

                                    {{-- @can('update', $company)
                                    <a href="{{ route('companies.edit', $company) }}"
                                   class="text-indigo-600 hover:text-indigo-900" >
                                   Edit
                                </a>
                                        
                                    @endcan --}}

                                    @can('delete', $company)
                                    <form action="{{ route('companies.destroy', $company) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this company');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                
                                      </form>
                                        
                                    @endcan

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>


            </div>

            {{-- Pagination --}}

            <div class="mt-4">
                {{ $companies->links() }}
            </div>

            @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>

                            <h3 class="mt-2 text-sm font-medium text-gray-900">No Companies Found</h3>
                            <p class="mt-1 text-sm text-gray-500">Get Started by Creating a new Company</p>
                            @can('create', App\Models\Company::class)
                            <div class="mt-6">
                                <a href="{{ route('companies.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Add a Company
                            </a>

                            </div>
                                
                            @endcan

            </div>

                
            @endif


        </div>

    </div>

     @if(in_array(auth()->user()->role, ['admin', 'manager']))
                <div class="mt-4 text-right">
                    <a href="{{ route('companies.trash') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        View Deleted Companies
                    </a>
                </div>
            @endif
        </div>
        </div>

    </div>

</x-app-layout>