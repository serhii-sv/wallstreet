<div class="col s12 m12 l6">
    <div class="card">
        @if(session()->has('success'))
        <div class="card-alert card green mb-0">
            <div class="card-content white-text">
                  <span class="card-title white-text darken-1 mb-0">
                    <i class="material-icons">notifications</i> @lang(session()->get('success'))</span>
                {{--<p>Пользователю начислен бонус </p>--}}
            </div>
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
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
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif
        <div class="card-content">
            <h4 class="card-title mb-4">Начислить бонус</h4>
            <form method="post" action="{{ route('dashboard.add.bonus') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Id or Login or email" id="name2" name="user" type="text" value="{{ old('user') ?? '' }}">
                        <label for="name2" class="active">Пользователь</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="23" type="text" name="amount" value="{{ old('amount') ?? '' }}">
                        <label class="active">Количество</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <div class="select-wrapper">
                            <select tabindex="-1" name="currency_id">
                                <option value="" disabled="" selected="">Выберите валюту</option>
                                @forelse($currencies as $item)
                                <option value="{{ $item->id }}" @if($item->id == old('currency_id')) selected="selected" @endif>{{ $item->name ?? '' }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <div class="select-wrapper">
                            <select tabindex="-1" name="payment_system_id">
                                <option value="" disabled="" selected="">Выберите платёжную систему</option>
                                @forelse($payment_system as $item)
                                <option value="{{ $item->id }}" @if($item->id == old('payment_system_id')) selected="selected" @endif>{{ $item->name ?? '' }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Начислить бонус
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
