<a href="{{ config('app.client_site_url') }}" target="_blank"
  class="btn btn-buy-now gradient-45deg-indigo-purple gradient-shadow white-text buy-now-animhated tada">{{ \App\User::where('last_activity_at', '<', date('Y-m-d H:i:s'))->count() }}
</a>
