<x-alert classes="bg-teal-100 text-teal-900 border-teal-500">
    @if(isset($title))
    <x-slot name="title">
        {{$title}}
    </x-slot>
    @endif
    {{ $slot }}
</x-alert>
