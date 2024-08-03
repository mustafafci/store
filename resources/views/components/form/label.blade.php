@props([
    'for' => '',
    'label',
])

<label for="{{ $for }}" {{ $attributes }}>{{ $label }}</label>
