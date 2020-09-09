<input
    x-data
    x-ref="{{$inputRef}}"
    x-init="initDatepicker"
    type="text"
    {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm'])!!}
>
@push("scripts")
    <script>
        function initDatepicker() {
            var el = this.$refs["{{$inputRef}}"];
            var config = {};
            @if(isset($enableTime) && $enableTime)
            config.enableTime = true;
            @endif
            var picker = flatpickr(el,config);
        }
    </script>
@endpush

