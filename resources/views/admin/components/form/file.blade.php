<div>
    @if ( !empty($optional) && $optional )
        <div class="flex justify-between">
            <label for="{{ $fieldname }}" class="block text-sm text-gray-700">{{ $label }}</label>
            <span class="text-sm text-gray-500" id="{{ $fieldname }}-optional">Optional</span>
        </div>
    @else
        <label for="{{ $fieldname }}" class="block text-sm text-gray-700">{{ $label }}</label>
    @endif
    <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
        <div class="space-y-1 text-center">
            @if ( !empty($file) )
                <img src="{{ asset($file) }}" alt="" class="mx-auto h-12 w-auto mb-2 text-gray-400">
            @else
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            @endif
            <div class="flex text-sm text-gray-600">
                <label for="{{ $fieldname }}" class="relative cursor-pointer rounded-md bg-white text-primary-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:text-primary-500">
                    <span>Upload a file</span>
                    {!! Form::file($fieldname, ['id' => $fieldname, 'class' => 'sr-only']) !!}
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG or JPG up to 5MB</p>
        </div>
    </div>
</div>