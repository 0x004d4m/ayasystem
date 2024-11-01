<!-- textarea -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')
    <textarea
    	name="{{ $field['name'] }}"
        id="editor-{{ $field['name'] }}"
        class="form-control"
        @include('crud::fields.inc.attributes')
    >{{ old_empty_or_null($field['name'], '') ??  $field['value'] ?? $field['default'] ?? '' }}</textarea>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')
@push('crud_fields_scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor
                .create(document.querySelector('#editor-{{ $field['name'] }}'))
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endpush
