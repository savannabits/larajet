<button wire:click="{{$orderFunction}}('{{ $orderBy }}')" {{$attributes}}>
    <strong>
        {{ $slot }}
        <span x-if="$orderBy == '{{$orderBy}}'">
            <i x-if="$orderDirection == 'asc'" class="fas fa-arrow-down"></i>
            <i x-else class="fas fa-arrow-up"></i>
        </span>
    </strong>
</button>
