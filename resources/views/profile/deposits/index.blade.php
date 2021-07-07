@extends('profile.layouts.customer')
@section('title', __('Deposits'))
@section('content')

<section class="lk-section">
    <h4 class="title">{{ __('Create a new deposit') }}</h4>
    <div class="plan-item plan-item--line">
        <div class="plan-item__left">
            <p class="plan-item__name">0.77% {{ __('per day') }}</p>
            <a class="btn btn--accent2" href="{{ route('profile.deposits.create') }}">{{ __('Create deposit') }}</a>
        </div>
        <div class="plan-item__content">
            <ul class="information-icons">
                <li class="information-icons__item">
                    <div class="information-icons__icon"><img src="/img/icons/icon-calendar.svg" alt="">
                    </div>
                    <div class="information-icons__content">
                        <p class="information-icons__title">{{ __('Plan duration') }}</p>
                        <p class="information-icons__name">{{ __('100 days') }}</p>
                    </div>
                </li>
                <li class="information-icons__item">
                    <div class="information-icons__icon"><img src="/img/icons/icon-cash.svg" alt="">
                    </div>
                    <div class="information-icons__content">
                        <p class="information-icons__title">{{ __('Daily interest') }}
                        </p>
                        <p class="information-icons__name">0.77%
                        </p>
                    </div>
                </li>
                <li class="information-icons__item">
                    <div class="information-icons__icon"><img src="/img/icons/icon-monets.svg" alt="">
                    </div>
                    <div class="information-icons__content">
                        <p class="information-icons__title">{{ __('Minimum investment') }}
                        </p>
                        <p class="information-icons__name">USD 10$
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
<section class="lk-section">
    <h3 class="title">{{ __('Active deposits list') }}</h3>
    <div>
        <div>
            <table class="table table-striped" id="deposits-table-active" style="width:100%;">
                <thead>
                <tr>
                    <th>{{ __('Currency') }}</th>
                    <th>{{ __('Rate') }}</th>
                    <th>{{ __('Earnings') }}</th>
                    <th>{{ __('Invested') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Closing') }}</th>
                </tr>
                </thead>
            </table>
            <hr><br>
            <h3 class="title">{{ __('Closed deposits list') }}</h3>
            <table class="table table-striped" id="deposits-table-closed" style="width:100%;">
                <thead>
                <tr>
                    <th>{{ __('Currency') }}</th>
                    <th>{{ __('Rate') }}</th>
                    <th>{{ __('Earnings') }}</th>
                    <th>{{ __('Invested') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Closing') }}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

<script>document.getElementById("depositsProfilePageMenuItem").className = "navigation-icons__link navigation-icons__link--active";</script>

@endsection

@push('script')
@endpush

@push('load-scripts')
    <script>
        //initialize basic datatable
        jQuery('#deposits-table-active').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[5, "desc"]],
            "ajax": '{{route('profile.deposits.dataTable', ['active' => 1])}}',
            "columns": [
                {"data": "currency.name"},
                {"data": "rate.name"},
                {
                    "data": 'daily',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['daily'] + '% {{ __('per day') }}';
                    }
                },
                {
                    "data": 'invested',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['invested'] + row['currency']['symbol'];
                    }
                },
                {
                    "data": 'active',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['active'] == 1 ? '{{ __('active') }}' : '{{ __('closed') }}';
                    }
                },
                {"data": "closing_at"},
            ],
        });
        //*initialize basic datatable
    </script>
@endpush

@push('load-scripts')
    <script>
        //initialize basic datatable
        jQuery('#deposits-table-closed').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[5, "desc"]],
            "ajax": '{{route('profile.deposits.dataTable', ['active' => 0])}}',
            "columns": [
                {"data": "currency.name"},
                {"data": "rate.name"},
                {
                    "data": 'daily',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['daily'] + '% {{ __('per day') }}';
                    }
                },
                {
                    "data": 'invested',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['invested'] + row['currency']['symbol'];
                    }
                },
                {
                    "data": 'active',
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return row['active'] == 1 ? '{{ __('active') }}' : '{{ __('closed') }}';
                    }
                },
                {"data": "closing_at"},
            ],
        });
        //*initialize basic datatable
    </script>
@endpush
