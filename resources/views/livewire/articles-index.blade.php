<div class="overflow-hidden bg-white p-4 min-w-64 shadow-md sm:rounded-lg">
    <div class="text-right mb-4">
        {{ $date_filter }}
        <x-datepicker wire:model.lazy="date_filter" inputRef="pikaday" placeholder="Pick A Day"></x-datepicker>
        <x-jet-input autofocus wire:model.debounce.500ms="search" placeholder="Search Records"></x-jet-input>
        <a class="bg-green-800 p-2 px-4 rounded-full text-white m-2" href="{{route('article.create')}}">Create Article</a>
    </div>
    <table class="table-fixed w-full">
        <thead>
        <tr class="border p-2">
            <th class="p-2 text-left"><x-table.orderable-column orderFunction="orderBy" orderBy="id">Id</x-table.orderable-column></th>
            <th class="p-2 text-left"><x-table.orderable-column orderFunction="orderBy" orderBy="slug">Slug</x-table.orderable-column></th>
            <th class="p-2 text-left"><x-table.orderable-column orderFunction="orderBy" orderBy="name">Name</x-table.orderable-column> </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if(!$articles->count())
            <td colspan="4">
                <x-alerts.warning>There is no data to display</x-alerts.warning>
            </td>
        @else
        @foreach($articles as $article)
            @php /**@var \App\Models\Article $article*/ @endphp
            <tr class="p-4 border border-gray-100">
                <td class="p-2">{{$article->id }}</td>
                <td class="p-2">{{$article->slug }}</td>
                <td class="p-2">{{$article->name }}</td>
                <td class="p-2"></td>
            </tr>
        @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr class="text-right">
            <td colspan="4">{{$articles->links()}}</td>
        </tr>
        </tfoot>
    </table>
</div>
