@php $class = 'mt-1 block w-full sm:text-sm' @endphp

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
    @php $class .= ' py-2 pl-3 pr-10 rounded-md' @endphp
@endif

@php $values = !empty($empty) && $empty ? ['' => ''] + $values : $values @endphp

<div>
    @if ( !empty($optional) && $optional )
        <div class="flex justify-between">
            <label for="{{ $fieldname }}" class="block text-sm text-gray-700">{{ $label }}</label>
            <span class="text-sm text-gray-500" id="{{ $fieldname }}-optional">Optional</span>
        </div>
    @else
        <label for="{{ $fieldname }}" class="block text-sm text-gray-700">{{ $label }}</label>
    @endif
    {!! Form::select($fieldname, $values, null, ['class' => $class]) !!}
    @if ( $errors->has($fieldname) )
        <p class="mt-2 text-sm text-red-600" id="{{ $fieldname }}-error">{!! $errors->get($fieldname)[0] !!}</p>
    @elseif ( !empty($help) )
        <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endif
</div>