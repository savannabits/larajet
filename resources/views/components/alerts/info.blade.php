<x-alert classes="bg-blue-100 text-blue-900 border-blue-500">
    @if(isset($title))
    <x-slot name="title">
        {{$title}}
    </x-slot>
    @endif
    {{ $slot }}
</x-alert>
