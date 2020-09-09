<x-alert classes="bg-red-100 text-red-900 border-red-500">
    @if(isset($title))
    <x-slot name="title">
        {{$title}}
    </x-slot>
    @endif
    {{ $slot }}
</x-alert>
