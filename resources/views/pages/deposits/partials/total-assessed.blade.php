<span class="badge  green-text  lighten-5 text-accent-4">{{ $deposit->currency->symbol }} {{ number_format($deposit->total_assessed(), $deposit->currency->precision, '.', ',') ?? 0 }}</span>
