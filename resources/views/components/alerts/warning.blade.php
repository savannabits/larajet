<x-alert classes="bg-yellow-100 text-yellow-900 border-yellow-500">
    @if(isset($title))
    <x-slot name="title">
        {{$title}}
    </x-slot>
    @endif
    {{ $slot }}
</x-alert>
