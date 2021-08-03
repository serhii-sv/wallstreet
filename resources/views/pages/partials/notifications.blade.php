@if(Session::has('success'))
    <div class="alert-wrap">
        <div class="card-alert card green">
            <div class="card-content white-text">
                <p>{{ Session::get('success') }}</p>
            </div>
            <div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert-wrap">
        <div class="card-alert card red">
            <div class="card-content white-text">
                <p>{{ Session::get('error') }}</p>
            </div>
            <div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </div>
@endif
