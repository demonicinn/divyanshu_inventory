<div>

    @include('components.stock_form')

    @include('components.stock_list')

    @push('scripts')
	<script>
        $(document).on('change', '.product_select', function(){
            let fieldId = $(this).data('id');
            let fieldValue = $(this).val();

            Livewire.dispatch('select-product', { fieldId: fieldId, fieldValue: fieldValue });
        });
    </script>
    @endpush
</div>
