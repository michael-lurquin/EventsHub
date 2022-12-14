@php $class = 'block w-full sm:text-sm' @endphp

@if ( $errors->has($fieldname) )
    @php $class .= ' border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500' @endphp
@else
    @php $class .= ' border-gray-300 text-gray-600 placeholder-gray-500 focus:border-primary-500 focus:ring-primary-500' @endphp
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

@php $rows = !empty($rows) ? $rows : 3 @endphp
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
        @if ( !empty($leftIcon) )
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke="currentColor" aria-hidden="true">
                    {!! $leftIcon !!}
                </svg>
            </div>
        @elseif ( !empty($prefix) )
            <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm select-none">{{ $prefix }}</span>
        @endif

        @if ( !empty($disabled) && $disabled )
            {!! Form::textarea($fieldname, old($fieldname), ['class' => $class, 'id' => $fieldname, 'autocomplete' => $autocomplete, 'placeholder' => $placeholder, 'rows' => $rows, 'disabled' => 'disabled']) !!}
        @else
            {!! Form::textarea($fieldname, old($fieldname), ['class' => $class, 'id' => $fieldname, 'autocomplete' => $autocomplete, 'placeholder' => $placeholder, 'rows' => $rows]) !!}
        @endif

        @if ( $errors->has($fieldname) )
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
            </div>
        @elseif ( !empty($rightIcon) )
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke="currentColor" aria-hidden="true">
                    {!! $rightIcon !!}
                </svg>
            </div>
        @elseif ( !empty($suffix) )
            <span class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm select-none">{{ $suffix }}</span>
        @endif
    </div>
    @if ( $errors->has($fieldname) )
        <p class="mt-2 text-sm text-red-600" id="{{ $fieldname }}-error">{!! $errors->get($fieldname)[0] !!}</p>
    @elseif ( !empty($help) )
        <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endif
</div>