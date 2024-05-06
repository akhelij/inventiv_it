@props(['text', 'class'])

<button type="button" {{ $attributes->merge(['class' => "shadow-md rounded-2xl py-2 font-medium flex justify-center items-center $class"]) }}>
    {{ $text }}
</button>