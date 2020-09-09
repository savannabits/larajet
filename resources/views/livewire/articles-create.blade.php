<x-slot name="header">
    <h4 class="font-black text-2xl">Create Article</h4>
</x-slot>

<div class="rounded p-4 bg-white mx-auto max-w-3xl shadow">
    @if($error)
        <x-alerts.error title="Server Error!">{{$error}}</x-alerts.error>
    @endif
    <form wire:submit.prevent="save">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="Name" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="data.name" />
            <x-jet-input-error for="data.name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="Description" />
            <textarea id="description" class="form-input w-full" wire:model="data.description" ></textarea>
            <x-jet-input-error for="data.description" class="mt-2" />
        </div>
        <div>
            <x-form.select2 wire:model.lazy="state" id="state" class="form-select">
                <option value="ALB">ALABAMA</option>
                <option value="ALK">ALASKA</option>
                <option value="MN">Minne</option>
                <option value="DC">District of Columbia</option>
            </x-form.select2>
            <x-jet-input-error for="state" class="mt-2" />
        </div>
        <div class="text-right">
            <x-jet-button type="submit">Submit</x-jet-button>
        </div>
    </form>
</div>

