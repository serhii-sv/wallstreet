{{--@if(session()->has('success'))--}}
{{--  <div class="alert alert-success" role="alert">--}}
{{--    @lang(session()->get('success'))--}}
{{--  </div>--}}
{{--@endif--}}
@if(session()->has('success'))
  <div class="card-alert card gradient-45deg-green-teal mt-0">
    <div class="card-content white-text">
      <p>
        <i class="material-icons">check</i>
        {{ session()->get('success') }}
      </p>
    </div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
@endif

@if(session()->has('error'))
  <div class="card-alert card gradient-45deg-red-pink mt-0">
    <div class="card-content white-text">
      <p>
        <i class="material-icons">error</i>
        {{ session()->get('error') }}
      </p>
    </div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
@endif

@if(session()->has('info'))
    <div class="card-alert card gradient-45deg-light-blue-cyan mt-0">
        <div class="card-content white-text">
            <p>
{{--                <i class="material-icons">check</i>--}}
                {!! session()->get('info') !!}
            </p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <div class="card-alert card gradient-45deg-red-pink mt-0">
      <div class="card-content white-text">
        <p>
          <i class="material-icons">error</i>
          {{ $error }}
        </p>
      </div>
      <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  @endforeach
@endif
