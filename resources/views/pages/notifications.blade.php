<div class="col s12 m12 l12">
    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                @if(session()->has('success'))
                    <div class="card-alert card green mb-0">
                        <div class="card-content white-text">
                                  <span class="card-title white-text darken-1 mb-0">
                                    <i class="material-icons">notifications</i> @lang(session()->get('success'))</span>
                        </div>
                        <button type="button" class="close white-text" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="card-alert card red mb-0">
                        <div class="card-content white-text">
                                  <span class="card-title white-text darken-1 mb-0">
                                    <i class="material-icons">notifications</i> @lang(session()->get('error'))</span>
                        </div>
                        <button type="button" class="close white-text" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="card-alert card red lighten-2 mb-0">
                        <div class="card-content text-white">
                                     <span class="card-title white-text darken-1 mb-0">
                                    <i class="material-icons">notifications</i> {{ __("Error") }}</span>
                            @foreach ($errors->all() as $error)
                                <p class="white-text darken-5">{{ $error }}</p>
                            @endforeach
                        </div>
                        <button type="button" class="close white-text" data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
