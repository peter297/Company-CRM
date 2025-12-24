<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Register A Company') }}
            </h2>
            <a href="{{ route('companies.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('companies.store')}}"">
                        @csrf

                    {{-- Company Information Section --}}
                    <div class=" mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Company Information</h3>

                        <div class="grid grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">

                            {{-- Company Name --}}

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Company Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                            </div>

                            {{-- Phone --}}
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    Phone
                                </label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Website --}}

                            <div>
                                <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                                <input type="url" name="website" id="website" value="{{ old('website') }}"
                                    placeholder="http://www.example.com" class="tm-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('website')
                                        border-red-500
                                    @enderror">
                                @error('website')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Industry --}}

                            <div class="md:col-span-2">
                                <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                                <select name="industry" id="industry" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('industry')
                                    border-red-500
                                @enderror">
                                    <option value="">Select Industry</option>
                                    <option value="Technology {{ old('industry') == 'Technology' ? 'selected' : ''}}">
                                        Technology</option>
                                    <option value="Finance {{ old('industry') == 'Finance' ? 'selected' : '' }}">Finance
                                    </option>
                                    <option value="Healthcare {{ old('industry') == 'Healthcare' ? 'selected' : '' }}">
                                        Healthcare</option>
                                    <option value="Retail {{ old('industry') == 'Retail' ? 'selected' : '' }}">Retail
                                    </option>
                                    <option
                                        value="Manufacturing {{ old('industry') == 'Manufacturing' ? 'selected' : '' }}">
                                        Manufacturing</option>
                                    <option value="Education {{ old('industry') == 'Education' ? 'selected' : '' }}">
                                        Education</option>
                                    <option
                                        value="Real Estate {{ old('industry') == 'Real Estate' ? 'selected' : '' }}">
                                        Real Estate</option>
                                    <option value="Consulting {{ old('industry') == 'Consulting' ? 'selected' : '' }}">
                                        Consulting</option>
                                    <option value="Marketing {{ old('industry') == 'Marketing' ? 'selected' : '' }}">
                                        Marketing</option>
                                    <option
                                        value="Transportation {{ old('industry') == 'Transportation' ? 'selected' : '' }}">
                                        Transportation</option>
                                    <option value="Other {{ old('industry') == 'Other' ? 'selected' : '' }}">Other
                                    </option>
                                </select>
                                @error('industry')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                </div>

                {{-- Address Section --}}

                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Address</h3>
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                        {{-- Street Address --}}
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                Street Address
                            </label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('address') border-red-500 @enderror">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- State --}}
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700">State/Province</label>
                            <input type="text" name="state" id="state" value="{{ old('state') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('state') border-red-500 @enderror">
                            @error('state')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Postal Code --}}
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700">
                                Postal Code
                            </label>
                            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('postal_code') border-red-500 @enderror">
                            @error('postal_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                            
                        {{-- Country --}}

                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700">
                                Country
                            </label>
                            <input type="text" name="country" id="country" value="{{ old('country') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('country') border-red-500 @enderror">
                            @error('country')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Assignment and Notes Section --}}
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Additional information</h3>
                    <div class="grid grid-cols-1 gap-6">
                        {{-- Assign to --}}
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Assign To <span
                                    class="text-red-500">*</span></label>
                            <select name="user_id" id="user_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('user_id') border-red-500 @enderror">
                                <option value="">Select User</option>

                                @foreach ($users as $userOption)
                                    <option value="{{ $userOption->id }}" {{ old('user_id', auth()->id()) == $userOption->id ? 'selected' : '' }}>{{ $userOption->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- notes --}}

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                Notes
                            </label>
                            <textarea name="notes" id="notes" rows="8"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}

                <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('companies.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancel
                    </a>

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Create Company</button>

                </div>

                </form>
            </div>
        </div>

    </div>
    </div>
</x-app-layout>