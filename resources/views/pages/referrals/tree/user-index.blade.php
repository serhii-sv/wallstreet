{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'eCommerce Pricing')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/pricing.css')}}">
@endsection

{{-- page content --}}
@section('content')
  <div class="row">
    <div class="col s12 m12 l12">
      <div id="basic-tabs" class="card card card-default scrollspy">
        <div class="card-content">
          <div class="display-flex justify-content-between">
            <h4 class="card-title">Дерево рефералов пользователя {{ $user->login ?? '' }}</h4>
          </div>
          <div class="row">
            <div class="col s12">
              <div class="row">
                <div class="plans-container" style="display: flex; flex-wrap: wrap;">
                  <table style="width:100%; height:400px;">
                    <tr>
                      <td style="vertical-align: central; text-align: center;">
                        <iframe src="{{ route('user.tree.reftree', $user->id) }}" style="width:100%; height: 500px;border: 1px solid #ebebeb;"></iframe>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

@section('page-script')
  <script>
  
  </script>
@endsection
