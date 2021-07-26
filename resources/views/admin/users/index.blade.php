@extends('admin/layouts.app-new')
@section('title'){{ __('Users list') }}@endsection
@section('breadcrumbs')
  <li> {{ __('Users list') }}</li>
@endsection
@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/pages/page-users.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/data-tables/css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
@endpush
@section('content')
  <section class="users-list-wrapper section">
    <div class="users-list-table">
      <div class="card">
        <div class="card-content">
          <!-- datatable start -->
          <div class="responsive-table">
            <table id="users-list-datatable" class="table">
              <thead>
                <tr>
                  <th>Идентификатор</th>
                  <th>Имя</th>
                  <th>Логин</th>
                  <th>Почта</th>
                  <th>Дата регистрации</th>
                  <th>Роль</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $user)
                  <tr>
                    <td>{{ $user->my_id ?? '' }}</td>
                    <td>
                      <a href="{{ route('admin.users.show', $user->id ) }}" target="_blank">{{ $user->name ?? '' }}</a>
                    </td>
                    <td>
                      <a href="{{ route('admin.users.show', $user->id ) }}" target="_blank">{{ $user->login ?? '' }}</a>
                    </td>
                    <td>
                      {{ $user->email ?? '' }}
                    </td>
                    <td>
                      {{ $user->created_at->format('d/m/Y H:i:s') ?? '' }}
                    </td>
                    <td>
                      @if($user->hasRole(['admin','root']))
                        <span class="chip green lighten-5">
                          <span class="green-text">Администратор</span>
                        </span>
                      @else
                        <span class="chip red lighten-5"><span class="red-text">Пользователь</span></span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('admin.users.edit', $user->id) }}" target="_blank"><i class="material-icons">edit</i></a>
                    </td>
                    <td>
                      <a href="{{ route('admin.users.show', $user->id ) }}" target="_blank"><i class="material-icons">remove_red_eye</i></a>
                    </td>
                  </tr>
                @empty
                @endforelse
              
              </tbody>
            </table>
            {{ $users->links() }}
          </div>
          <!-- datatable ends -->
        </div>
      </div>
    </div>
  </section>



@endsection
@push('scripts')
  <script src="{{ asset('admin/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
  
  <!--  <script src="{{ asset('admin/js/scripts/page-users.js') }}"></script>-->
@endpush