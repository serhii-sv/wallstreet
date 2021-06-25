@extends('admin/layouts.app')
@section('title')
    {{ __('FAQ list') }}
@endsection
@section('breadcrumbs')
    <li> {{ __('FAQ list') }}</li>
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
                    <h1 class="custom-font">{{ __('FAQ list') }}</h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="{{ route('admin.faqs.create') }}"
                               style="font-weight: bold;">[{{ __('add new faq') }}]
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
                    <table id="faqs" class="table hover form-inline dt-bootstrap no-footer">
                        <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Text') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(getFaqsList() as $faq)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" value="{{ $faq['title'] }}" readonly>
                                </td>
                                <td>
                                    <textarea class="form-control" readonly>
                                        {{ $faq['text'] ?? 'no text' }}
                                    </textarea>
                                </td>
                                <td>
                                    <a type="button" class="btn btn-primary btn-xs"
                                       href="{{ route('admin.faqs.edit', ['id' => $faq['id']]) }}">{{ __('edit') }}</a>
                                    <a type="button" class="btn btn-warning btn-xs" href="#" onclick="
                                            var result = confirm('{{ __('Please confirm deletion') }}');
                                            if(result) {
                                            event.preventDefault();
                                            document.getElementById('delete-{{ $faq['id'] }}').submit()
                                            }">{{ __('delete') }}</a>
                                    <form action="{{ route('admin.faqs.destroy', ['id' => $faq['id']]) }}"
                                          method="POST"
                                          id="delete-{{ $faq['id'] }}" style="display: none;">
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
                            $('#faqs').DataTable();
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
