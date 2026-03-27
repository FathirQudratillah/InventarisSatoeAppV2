@props(['active' => false])

<a {{ $attributes->merge([
    'class' =>
        ($active
            ? 'bg-slate-700 text-white'
            : 'text-slate-300 hover:bg-slate-700 hover:text-white'
        ) .
        ' group flex items-center rounded-md px-3 py-2 text-sm font-medium transition'
]) }}>
    {{ $slot }}
</a>
