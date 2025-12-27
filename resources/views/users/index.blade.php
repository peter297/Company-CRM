<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('session'))

                <div class="mb-4 green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('session') }}
                </div>

            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Companies
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>

                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="h-10 w-10 flex-shrink-0 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-semibold">
                                                {{ substr($user->name, 0, 2) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>

                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-6 px-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $user->role === 'manager' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $user->role === 'sales_rep' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap  text-sm text-gray-900">
                                        {{ $user->companies_count}}

                                    </td>



                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        @can('update', $user)
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="text-blue-500 hover:text-indigo-900">Edit</a>

                                        @endcan

                                        @can('delete', $user)
                                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline"
                                                onsubmit="return confirm('Are you Sure? This will delete all their companies')">
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


            </div>

        </div>

    </div>
</x-app-layout>