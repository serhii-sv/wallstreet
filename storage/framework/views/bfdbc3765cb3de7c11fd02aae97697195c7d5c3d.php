<a href="#"
    style="width: 49.5px"
    target="_blank"
    data-target="slide-out-right"
    class="btn btn-buy-now gradient-45deg-indigo-purple gradient-shadow white-text buy-now-animhated tada sidenav-trigger">
  <?php echo e(\App\User::where('last_activity_at', '>', date('Y-m-d H:i:s', strtotime('- 5 minutes')))->count()); ?>

</a>
<?php /**PATH /Users/fladko/Work/Clients/Serhei/wallstreet/resources/views/pages/partials/buy-now.blade.php ENDPATH**/ ?>