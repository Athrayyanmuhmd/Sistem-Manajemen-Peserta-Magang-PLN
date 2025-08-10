@props(['intern'])

@php
    $progress = $intern->progressStatus;
    $realTimeProgress = $intern->calculateRealTimeProgress();
@endphp

<div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-all duration-200">
    <div class="flex items-start justify-between mb-3">
        <div class="flex-1 min-w-0">
            <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $intern->name }}</h4>
            <p class="text-xs text-gray-500">{{ $intern->division->name ?? 'No Division' }}</p>
        </div>
        <div class="flex-shrink-0 ml-3">
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                @switch($progress['color'])
                    @case('green')
                        bg-green-100 text-green-800
                        @break
                    @case('blue')
                        bg-blue-100 text-blue-800
                        @break
                    @case('yellow')
                        bg-yellow-100 text-yellow-800
                        @break
                    @case('red')
                        bg-red-100 text-red-800
                        @break
                    @default
                        bg-gray-100 text-gray-800
                @endswitch
            ">
                {{ $realTimeProgress }}%
            </span>
        </div>
    </div>
    
    <!-- Progress Bar -->
    <div class="mb-2">
        <div class="relative">
            <div class="overflow-hidden h-2 text-xs flex rounded-full bg-gray-200">
                <div 
                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center transition-all duration-500 ease-out
                        @switch($progress['color'])
                            @case('green')
                                bg-gradient-to-r from-green-400 to-green-500
                                @break
                            @case('blue')
                                bg-gradient-to-r from-blue-400 to-blue-500
                                @break
                            @case('yellow')
                                bg-gradient-to-r from-yellow-400 to-yellow-500
                                @break
                            @case('red')
                                bg-gradient-to-r from-red-400 to-red-500
                                @break
                            @default
                                bg-gradient-to-r from-gray-400 to-gray-500
                        @endswitch
                    "
                    style="width: {{ $realTimeProgress }}%"
                    data-progress="{{ $realTimeProgress }}"
                >
                </div>
            </div>
            
            <!-- Progress indicator dot (if active) -->
            @if($progress['status'] === 'in-progress' || $progress['status'] === 'on-track')
                <div class="absolute top-0 h-2 w-2 bg-white rounded-full shadow-sm animate-pulse"
                     style="left: {{ max(0, min(100, $realTimeProgress)) }}%; transform: translateX(-50%); margin-top: 0px;">
                </div>
            @endif
        </div>
    </div>
    
    <!-- Status Message -->
    <div class="flex items-center justify-between text-xs">
        <span class="text-gray-600 flex-1">{{ $progress['message'] }}</span>
        @if($intern->start_date && $intern->end_date)
            <span class="text-gray-400 ml-2">{{ $intern->start_date->format('d/m') }} - {{ $intern->end_date->format('d/m') }}</span>
        @endif
    </div>
    
    <!-- Additional info for special statuses -->
    @if($progress['status'] === 'at-risk')
        <div class="mt-2 flex items-center text-xs text-yellow-700 bg-yellow-50 px-2 py-1 rounded">
            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            Perlu monitoring ketat
        </div>
    @elseif($progress['status'] === 'overdue')
        <div class="mt-2 flex items-center text-xs text-red-700 bg-red-50 px-2 py-1 rounded">
            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Evaluasi segera diperlukan
        </div>
    @elseif($progress['status'] === 'almost-done')
        <div class="mt-2 flex items-center text-xs text-green-700 bg-green-50 px-2 py-1 rounded">
            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Siapkan evaluasi akhir
        </div>
    @endif
</div>