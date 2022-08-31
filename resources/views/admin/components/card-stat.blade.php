<div class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
    <dt>
        <div class="absolute rounded-md bg-{{ $card['color'] }}-50 p-3">
            <svg class="h-6 w-6 text-{{ $card['color'] }}-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                {!! $card['icon'] !!}
            </svg>
        </div>
        <p class="ml-16 truncate text-sm font-medium text-gray-500">{{ $card['title'] }}</p>
    </dt>
    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
        <p class="text-2xl font-semibold text-gray-700">{{ $card['value'] }}{{ $card['format'] }}</p>
        <p class="ml-2 flex items-baseline text-sm font-semibold {{ $card['variation']['type'] === 'increased' ? 'text-green-500' : 'text-red-500' }}">
            <svg class="h-5 w-5 flex-shrink-0 self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                @if ( $card['variation']['type'] === 'increased' )
                    <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                @else
                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                @endif
            </svg>
            <span class="sr-only"> {{ ucfirst($card['variation']['type']) }} by </span>
            {{ $card['variation']['value'] }}{{ $card['variation']['format'] }}
        </p>
        <a href="{{ $card['link'] }}" class="absolute text-sm font-medium inset-x-0 bottom-0 bg-{{ $card['color'] }}-600 hover:bg-{{ $card['color'] }}-700 text-white px-4 py-4 sm:px-6">
            View all<span class="sr-only"> {{ $card['title'] }} stats</span></a>
        </a>
    </dd>
</div>