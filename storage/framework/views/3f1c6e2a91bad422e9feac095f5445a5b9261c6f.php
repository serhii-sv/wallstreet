<!-- BEGIN: Footer-->
<footer
  class="<?php echo e($configData['mainFooterClass']); ?> <?php if($configData['isFooterFixed']=== true): ?><?php echo e('footer-fixed'); ?><?php else: ?> <?php echo e('footer-static'); ?> <?php endif; ?> <?php if($configData['isFooterDark']=== true): ?> <?php echo e('footer-dark'); ?> <?php elseif($configData['isFooterDark']=== false): ?> <?php echo e('footer-light'); ?> <?php else: ?> <?php echo e($configData['mainFooterColor']); ?> <?php endif; ?>">
  <div class="footer-copyright">
    <div class="container">
      Поставь цель. Составь план. Не ленись. Совершенствуйся. Будь ответственным. Не смотри на других. Верь в свой Успех.
    </div>
  </div>
</footer>

<!-- END: Footer-->
<?php /**PATH /Users/fladko/Work/Clients/Serhei/wallstreet/resources/views/panels/footer.blade.php ENDPATH**/ ?>