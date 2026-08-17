<div class="mb-10">
    <div class="flex items-center gap-1 sm:gap-2">
        @php
            $steps = [
                1 => 'Pendahuluan',
                2 => 'Data Diri',
                3 => 'Pendidikan',
                4 => 'Pembayaran',
                5 => 'Konfirmasi',
                6 => 'Selesai'
            ];
        @endphp

        @foreach($steps as $stepNum => $label)
            {{-- Step Circle & Label --}}
            <div class="flex items-center group relative">
                @if($stepNum < $currentStep)
                    {{-- Completed Step --}}
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border-2 flex items-center justify-center text-[11px] sm:text-xs font-black shrink-0 bg-navy border-navy text-cream shadow-xs" title="{{ $label }}">✓</div>
                @elseif($stepNum == $currentStep)
                    {{-- Current Step --}}
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border-2 flex items-center justify-center text-[11px] sm:text-xs font-black shrink-0 bg-orange border-orange text-white ring-4 ring-orangesoft shadow-xs" title="{{ $label }}">{{ $stepNum }}</div>
                @else
                    {{-- Future Step --}}
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border-2 flex items-center justify-center text-[11px] sm:text-xs font-bold shrink-0 bg-white border-navy/20 text-navy/40" title="{{ $label }}">{{ $stepNum }}</div>
                @endif
                
                {{-- Desktop Label --}}
                <span class="hidden md:block absolute -bottom-6 left-1/2 -translate-x-1/2 text-[11px] font-bold text-center whitespace-nowrap {{ $stepNum < $currentStep ? 'text-navy' : ($stepNum == $currentStep ? 'text-orange font-black' : 'text-navy/40') }}">
                    {{ $label }}
                </span>
            </div>

            {{-- Line between steps --}}
            @if(!$loop->last)
                @if($stepNum < $currentStep)
                    {{-- Completed Line --}}
                    <div class="flex-1 h-0.5 bg-navy"></div>
                @else
                    {{-- Future Line --}}
                    <div class="flex-1 h-0.5 bg-navy/15"></div>
                @endif
            @endif
        @endforeach
    </div>
</div>
