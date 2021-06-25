@extends('profile.layouts.customer')
@section('title', __('Operations'))
@section('content')

<section class="lk-section">
    <table class="table table-striped" id="operations-table" style="width:100%;">
        <thead>
        <tr>
            <th>{{ __('Amount') }}</th>
            <th>{{ __('Currency') }}</th>
            <th>{{ __('Type') }}</th>
            <th>{{ __('Approved') }}</th>
            <th>{{ __('Batch ID') }}</th>
            <th>{{ __('Date') }}</th>
        </tr>
        </thead>
    </table>
</section>

<script>document.getElementById("operationsProfilePageMenuItem").className = "navigation-icons__link navigation-icons__link--active";</script>

@push('script')
@endpush

@endsection

@push('load-scripts')
    <script>
        //initialize basic datatable
        jQuery('#operations-table').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[4, "desc"]],
            "ajax": '{{route('profile.operations.dataTable')}}',
            "columns": [
                {
                    "data": 'amount',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return row['amount'] + row['currency']['symbol'];
                    }
                },
                {"data": "currency.name"},
                {"data": "type_name"},
                {
                    "data": "approved", "render": function (data, type, row, meta) {
                        if (row['approved'] == 1) {
                            return '{{ __('yes') }}';
                        }
                        return '{{ __('no') }}';
                    }
                },
                {"data": "batch_id"},
                {"data": "created_at"},
            ],
        });
        //*initialize basic datatable
    </script>
@endpush
