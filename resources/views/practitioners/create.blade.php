@extends('layouts.admin')

@section('content')
<div class="flex justify-center fade-in py-6">
<div class="w-full max-w-4xl">
    
    <!-- Header -->
    <div class="mb-6 px-1">
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">New Practitioner Registration</h2>
        <p class="text-sm text-gray-500 mt-1">Fill in the details below to register a group or individual.</p>
    </div>

    <form method="POST" action="{{ route('practitioners.store') }}">
        @csrf

        <!-- Main Card Container -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-2xl shadow-gray-200/60 overflow-hidden flex flex-col">
            
            <!-- PROMINENT ERROR BANNER -->
            @if ($errors->any())
                <div class="mx-6 mt-6 mb-0 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <h4 class="text-sm font-bold text-red-800">Please correct the following errors:</h4>
                            <ul class="mt-2 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm text-red-600">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex flex-col md:flex-row flex-1">
                
                <!-- LEFT SIDE: Identity & Location -->
                <div class="w-full md:w-1/2 p-6 lg:p-8 border-b md:border-b-0 md:border-r border-dashed border-gray-200 space-y-5">
                    
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center">
                            <span class="text-[10px] font-bold text-emerald-600">1</span>
                        </div>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Identity & Location</h3>
                    </div>

                    <!-- Name -->
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Name of Group / Individual <span class="text-red-400">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-gray-50/50 text-gray-900 placeholder-gray-400 outline-none transition-all duration-200 hover:border-gray-300 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white @error('name') border-red-400 bg-red-50/50 @else border-gray-200 @enderror"
                               placeholder="e.g. Kaya Heritage Group">
                        @error('name')<p class="text-xs text-red-500 mt-1.5 pl-0.5">{{ $message }}</p>@enderror
                    </div>

                    <!-- Activity -->
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Activity <span class="text-red-400">*</span></label>
                        <input type="text" name="activity" value="{{ old('activity') }}" required
                               class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-gray-50/50 text-gray-900 placeholder-gray-400 outline-none transition-all duration-200 hover:border-gray-300 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white @error('activity') border-red-400 bg-red-50/50 @else border-gray-200 @enderror"
                               placeholder="e.g. Traditional Healing">
                        @error('activity')<p class="text-xs text-red-500 mt-1.5 pl-0.5">{{ $message }}</p>@enderror
                    </div>

                    <!-- Searchable County Dropdown -->
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1.5">County <span class="text-red-400">*</span></label>
                        
                        <div class="relative county-dropdown-container">
                            <!-- The visible search input -->
                            <input type="text" id="county-search" value="{{ old('county') }}" 
                                   class="w-full px-3.5 py-2.5 pr-9 text-sm border rounded-lg bg-gray-50/50 text-gray-900 placeholder-gray-400 outline-none transition-all duration-200 hover:border-gray-300 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white @error('county') border-red-400 bg-red-50/50 @else border-gray-200 @enderror"
                                   placeholder="Search county..." autocomplete="off">
                            
                            <!-- Dropdown Icon -->
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>

                            <!-- Hidden input to hold the actual selected value for form submission -->
                            <input type="hidden" name="county" id="county-value" value="{{ old('county') }}">

                            <!-- The Dropdown List -->
                            <ul id="county-list" class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg max-h-48 overflow-y-auto hidden">
                                @if(isset($counties))
                                    @foreach($counties as $countyName)
                                        <li class="county-item px-3.5 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 cursor-pointer transition-colors duration-100" data-value="{{ $countyName }}">
                                            {{ $countyName }}
                                        </li>
                                    @endforeach
                                @endif
                                <li id="no-results" class="hidden px-3.5 py-2 text-sm text-gray-400 cursor-default">
                                    No counties found
                                </li>
                            </ul>
                        </div>

                        @error('county')<p class="text-xs text-red-500 mt-1.5 pl-0.5">{{ $message }}</p>@enderror
                    </div>

                </div>

                <!-- RIGHT SIDE: Contact & Schedule -->
                <div class="w-full md:w-1/2 p-6 lg:p-8 space-y-5">
                    
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-5 h-5 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-[10px] font-bold text-blue-600">2</span>
                        </div>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Contact & Schedule</h3>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Phone Number <span class="text-red-400">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                               class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-gray-50/50 text-gray-900 placeholder-gray-400 outline-none transition-all duration-200 hover:border-gray-300 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white @error('phone') border-red-400 bg-red-50/50 @else border-gray-200 @enderror"
                               placeholder="+254 700 000 000">
                        @error('phone')<p class="text-xs text-red-500 mt-1.5 pl-0.5">{{ $message }}</p>@enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Email Address <span class="text-red-400">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-3.5 py-2.5 text-sm border rounded-lg bg-gray-50/50 text-gray-900 placeholder-gray-400 outline-none transition-all duration-200 hover:border-gray-300 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white @error('email') border-red-400 bg-red-50/50 @else border-gray-200 @enderror"
                               placeholder="group@example.com">
                        @error('email')<p class="text-xs text-red-500 mt-1.5 pl-0.5">{{ $message }}</p>@enderror
                    </div>

                    <!-- Dates Grid -->
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Reg. Date <span class="text-red-400">*</span></label>
                            <input type="date" name="registration_date" value="{{ old('registration_date') }}" required
                                   class="w-full px-3 py-2.5 text-sm border rounded-lg bg-gray-50/50 text-gray-900 outline-none transition-all duration-200 hover:border-gray-300 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white @error('registration_date') border-red-400 bg-red-50/50 @else border-gray-200 @enderror">
                            @error('registration_date')<p class="text-xs text-red-500 mt-1 pl-0.5">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Renewal Date <span class="text-red-400">*</span></label>
                            <input type="date" name="renewal_date" value="{{ old('renewal_date') }}" required
                                   class="w-full px-3 py-2.5 text-sm border rounded-lg bg-gray-50/50 text-gray-900 outline-none transition-all duration-200 hover:border-gray-300 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white @error('renewal_date') border-red-400 bg-red-50/50 @else border-gray-200 @enderror">
                            @error('renewal_date')<p class="text-xs text-red-500 mt-1 pl-0.5">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Subtle Info Box -->
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 mt-4">
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Renewal dates are automatically calculated based on county regulations. Certificates will be generated upon approval.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- UNIFIED FOOTER -->
            <div class="px-6 lg:px-8 py-4 bg-gray-50/80 border-t border-gray-100 flex items-center justify-between">
                <p class="text-xs text-gray-400"><span class="text-red-400">*</span> Indicates required field</p>
                <div class="flex items-center gap-3">
                    <a href="{{ url()->previous() }}" 
                       class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors duration-150">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-all duration-150 cursor-pointer shadow-sm shadow-emerald-600/20 hover:shadow-md hover:shadow-emerald-600/30">
                        Save Registration
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('county-search');
    const hiddenInput = document.getElementById('county-value');
    const dropdownList = document.getElementById('county-list');
    const items = document.querySelectorAll('.county-item');
    const noResults = document.getElementById('no-results');

    // Open dropdown on focus
    searchInput.addEventListener('focus', function () {
        dropdownList.classList.remove('hidden');
        filterItems(); // Ensure filtering is applied when reopened
    });

    // Filter items on typing
    searchInput.addEventListener('input', function () {
        hiddenInput.value = ''; // Clear hidden input while searching
        filterItems();
    });

    function filterItems() {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                item.classList.remove('hidden');
                visibleCount++;
            } else {
                item.classList.add('hidden');
            }
        });

        // Show "No results" if nothing matches
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    // Handle item click
    items.forEach(item => {
        item.addEventListener('click', function () {
            const selectedValue = this.getAttribute('data-value');
            
            // Update inputs
            searchInput.value = selectedValue;
            hiddenInput.value = selectedValue;

            // Visual feedback for selected item
            items.forEach(i => i.classList.remove('bg-emerald-50', 'text-emerald-700', 'font-medium'));
            this.classList.add('bg-emerald-50', 'text-emerald-700', 'font-medium');

            // Close dropdown
            dropdownList.classList.add('hidden');
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.county-dropdown-container')) {
            dropdownList.classList.add('hidden');
            
            // If the visible input is empty, clear the hidden input too
            if (searchInput.value === '') {
                hiddenInput.value = '';
            }
        }
    });

    // Handle validation failures gracefully (Pre-select old value on load)
    const oldValue = "{{ old('county') }}";
    if (oldValue) {
        items.forEach(item => {
            if (item.getAttribute('data-value') === oldValue) {
                item.classList.add('bg-emerald-50', 'text-emerald-700', 'font-medium');
            }
        });
    }
});
</script>
@endpush