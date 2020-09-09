<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <x-slot name="sidebar">
        <ul>
            <li class="py-4 px-4 border-b border-b-bg-blue-100">
                <a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="py-4 px-4 border-b border-b-bg-blue-100">
                <a href="{{route('article.index')}}">Articles</a>
            </li>
        </ul>
    </x-slot>
    <div class="overflow-hidden p-4 bg-white shadow sm:rounded-lg">
        <x-jet-welcome />
    </div>
</x-app-layout>
