<div wire:ignore>
    <select data-placeholder="{{__('Select your option')}}" {!! $attributes->merge(["class" => 'select2']) !!}>
        <option></option>
        {{$slot}}
    </select>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                allowClear: true
            });
            $(".select2").on('change', function (e) {
                let elementName = $(this).attr('wire:model');
                if (!elementName) elementName = $(this).attr('wire:model.lazy');
                var data = $(this).select2("val");
                @this.$set(elementName, data);
            });
        });
    </script>
@endpush

