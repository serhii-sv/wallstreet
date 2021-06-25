<?php $__env->startSection('title', __('FAQ')); ?>
<?php $__env->startSection('content'); ?>
    <div class="et_pb_section  et_pb_section_2 et_pb_with_background et_section_regular">


        <div class=" et_pb_row et_pb_row_1">
            <div class="et_pb_column et_pb_column_4_4  et_pb_column_1 et-last-child">


                <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left et_animated et_pb_text_0">


                    <div class="et_pb_text_inner">

                        <h2 style="text-align: center;"><strong><?php echo e(__('FAQ')); ?></strong></h2>

                    </div>
                </div> <!-- .et_pb_text -->
                <div class="et_pb_module et_pb_image et_pb_image_0 et_always_center_on_mobile">


                    <span class="et_pb_image_wrap"><img src="/images/ao.png" alt=""/></span>

                </div>
            </div> <!-- .et_pb_column -->


        </div> <!-- .et_pb_row -->
        <div class=" et_pb_row et_pb_row_2">
            <div class="et_pb_column et_pb_column_1_2  et_pb_column_2">


                <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_1">


                    <div class="et_pb_text_inner">

                        <p><?php echo e(__('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).')); ?></p>

                        <hr>

                        <?php $__currentLoopData = getFaqsList(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p style="font-weight: bold;"><?php echo e($faq['title']); ?></p>
                            <p><?php echo e($faq['text']); ?></p>
                            <hr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div> <!-- .et_pb_text -->
            </div> <!-- .et_pb_column -->


        </div> <!-- .et_pb_row -->

    </div> <!-- .et_pb_section -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.customer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>