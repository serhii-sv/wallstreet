<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script>
    let url = "<?php echo e($taskAction->source_address); ?>";
    url = url.replace('watch?v=', 'embed/');
    document.write('<iframe width="100%" height="100%" src="'+ url +'" frameborder="0"></iframe>');

    setTimeout(function(){
        $.ajax({
            type    : "POST",
            url     : "<?php echo e(route('youtube.watch.save', ['taskAction' => $taskAction->id, 'userId' => $userId])); ?>",
            success : function(res) {
                alert('ok');
            },
        });
    }, 3000);
</script>