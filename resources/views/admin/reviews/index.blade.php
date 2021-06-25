@extends('admin/layouts.app')
@section('title')
    {{ __('Reviews') }}
@endsection
@section('breadcrumbs')
    <li> {{ __('Reviews') }}</li>
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-md-12">

            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font">{{ __('Reviews') }}</h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="{{ route('admin.reviews.create') }}">[{{ __('create new review') }}]
                            </a>
                        </li>
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> {{ __('Fullscreen') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">
                    <table id="reviews" class="table hover form-inline dt-bootstrap no-footer">
                        <thead>
                        <tr>
                            <th>{{ __('Client name') }}</th>
                            <th>{{ __('Review text') }}</th>
                            <th>{{ __('Video link') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(getCustomerReviews() as $review)
                            <tr>
                                <td>{{ $review['name'] }}</td>
                                <td>
                                    <textarea class="form-control"
                                              readonly>{{ $review['text'] ?? 'no text' }}</textarea>
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $review['video'] ?? 'no video'}}"
                                           readonly>
                                </td>
                                <td>
                                    <a type="button" class="btn btn-primary btn-xs"
                                       href="{{ route('admin.reviews.edit', ['id' => $review['id']]) }}">{{ __('edit') }}</a>
                                    <a type="button" class="btn btn-warning btn-xs" href="#" onclick="
                                            var result = confirm('{{ __('Please confirm deletion') }}');
                                            if(result) {
                                            event.preventDefault();
                                            document.getElementById('delete-{{ $review['id'] }}').submit()
                                            }">{{ __('delete') }}</a>
                                    <form action="{{ route('admin.reviews.destroy', ['id' => $review['id']]) }}"
                                          method="POST"
                                          id="delete-{{ $review['id'] }}" style="display: none;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @push('load-scripts')
                        <script>
                            $('#reviews').DataTable();
                        </script>
                    @endpush
                </div>
                <!-- /tile body -->

            </section>
            <!-- /tile -->

        </div>
        <!-- /col -->
    </div>
    <!-- /row -->

@endsection
