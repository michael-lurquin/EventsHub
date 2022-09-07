@php $class = 'block w-full sm:text-sm' @endphp

@if ( $errors->has($fieldname) )
    @php $class .= ' border-red-300 text-red-900 placeholder-red-500 focus:border-red-500 focus:ring-red-500' @endphp
@else
    @php $class .= ' border-gray-300 text-gray-600 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500' @endphp
@endif

@if ( !empty($disabled) && $disabled )
    @php $class .= ' disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500' @endphp
@endif 

@if ( !empty($leftIcon) )
    @php $class .= ' pl-10' @endphp
@endif
@if ( !empty($rightIcon) )
    @php $class .= ' pr-10' @endphp
@endif

@if ( !empty($prefix) || !empty($suffix) )
    @php $class .= ' px-3 py-2 min-w-0 flex-1' @endphp
@endif

@if ( !empty($prefix) )
    @php $class .= ' rounded-r-md' @endphp
@endif
@if ( !empty($suffix) )
    @php $class .= ' rounded-l-md' @endphp
@endif

@if ( !empty($prefix) && !empty($suffix) )
    @php $class = str_replace(' rounded-r-md', '', $class) @endphp
    @php $class = str_replace(' rounded-l-md', '', $class) @endphp
@elseif ( empty($prefix) && empty($suffix) )
    @php $class = str_replace(' rounded-r-md', '', $class) @endphp
    @php $class = str_replace(' rounded-l-md', '', $class) @endphp
    @php $class .= ' rounded-md' @endphp
@endif

@php $placeholder = !empty($placeholder) ? $placeholder : null @endphp
@php $autocomplete = !empty($autocomplete) ? $autocomplete : 'off' @endphp

<div>
    @if ( !empty($optional) && $optional )
        <div class="flex justify-between">
            <label for="{{ $fieldname }}" class="block text-sm text-gray-700">{{ $label }}</label>
            <span class="text-sm text-gray-500" id="{{ $fieldname }}-optional">Optional</span>
        </div>
    @else
        <label for="{{ $fieldname }}" class="block text-sm text-gray-700 @if ( !empty($hiddenLabel) && $hiddenLabel ) sr-only @endif">{{ $label }}</label>
    @endif

    <div class="relative mt-1 flex rounded-md shadow-sm">
        @if ( !empty($prefix) )
            <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm select-none">{{ $prefix }}</span>
        @elseif ( !empty($leftIcon) )
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke="currentColor" aria-hidden="true">
                    {!! $leftIcon !!}
                </svg>
            </div>
        @endif

        @if ( !empty($disabled) && $disabled )
            {!! Form::date($fieldname, old($fieldname), ['class' => $class, 'id' => $fieldname, 'autocomplete' => $autocomplete, 'placeholder' => $placeholder, 'disabled' => 'disabled']) !!}
        @else
            {!! Form::date($fieldname, old($fieldname), ['class' => $class, 'id' => $fieldname, 'autocomplete' => $autocomplete, 'placeholder' => $placeholder]) !!}
        @endif

        @if ( !empty($suffix) )
            <span class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm select-none">{{ $suffix }}</span>
        @elseif ( !empty($rightIcon) )
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    {!! $rightIcon !!}
                </svg>
            </div>
        @endif
    </div>
    @if ( $errors->has($fieldname) )
        <p class="mt-2 text-sm text-red-600" id="{{ $fieldname }}-error">{!! $errors->get($fieldname)[0] !!}</p>
    @endif
</div>