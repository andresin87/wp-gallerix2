<div id="<?php echo $options->id; ?>" class="gallerix2">

    <h1 class="gallerix2-title"><?php echo $options->title; ?> <span class="gallerix2-breadcrumbs"></span></h1>
    <div class="gallerix2-category-button-close"><?php _e("Go back", "gallerix2"); ?></div>

    <?php
    $categories = Gallerix2::front_get_categories($options->cat);
    $catpage = 0;
    $catperpage = $options->catperpage;
    ?>

    <ul class="gallerix2-content">
        <?php foreach ($categories as $k => $cat) : ?>
            <?php
            if ($k % $catperpage === 0)
                $catpage++;
            ?>
            <li data-gallerix2-category="<?php echo $cat->id; ?>" data-gallerix2-category-page="<?php echo $catpage; ?>" class="gallerix2-category">
                <h2 class="gallerix2-category-title"><?php echo $cat->title; ?></h2>

                <div class="gallerix2-category-thumb-wrapper">
                    
                    <?php if ($options->catwrappertype == "strict") : ?>
                        <div class="gallerix2-category-thumb-stack-2"></div>
                        <div class="gallerix2-category-thumb-stack-1"></div>
                    <?php endif; ?>
                    
                    <?php if ($options->catwrappertype == "mixed") : ?>
                        <div class="gallerix2-category-thumb-stack-2 mixed-stack"></div>
                        <div class="gallerix2-category-thumb-stack-1 mixed-stack"></div>
                    <?php endif; ?>
                        
                    <div class="gallerix2-category-thumb">
                        <img src="<?php echo $cat->thumb == "" ? $cat->postthumb : $cat->thumb; ?>" alt="<?php echo $cat->title; ?>" />
                    </div>
                </div>
            </li>

            <?php
            $posts = Gallerix2::front_get_posts($cat->id);
            $postpage = 0;
            $postperpage = $options->postperpage;
            ?>

            <?php foreach ($posts as $j => $post) : ?>
                <?php if ($j % $postperpage === 0) $postpage++; ?>

                <li data-gallerix2-post-category="<?php echo $cat->id; ?>" data-gallerix2-post-page="<?php echo $postpage; ?>" data-gallerix2-post="<?php echo $post->id; ?>" class="gallerix2-post">
                    <div class="gallerix2-post-short" title="<?php echo $post->title; ?>">
                        <div class="gallerix2-post-short-inner">
                            <h2 class="gallerix2-post-title"><?php echo Gallerix2::truncate_string($post->title, $options->stitlelimit); ?></h2>
                            <div class="gallerix2-post-stats">
                                <div class="gallerix2-post-comments-count"><i class="fa fa-comment"></i>
                                    <span>
                                        <?php if ($options->disqus == "1") : ?>
                                            <a href=".#disqus_thread" data-disqus-identifier="<?php echo "Gallerix2PostID".$post->id;?>">0</a>
                                        <?php else: ?>
                                            <?php echo $post->comments; ?>
                                        <?php endif;?>
                                    </span>
                                </div>
                                <div class="gallerix2-post-likes"><i class="fa fa-heart"></i><span><?php echo $post->likes; ?></span></div>
                                <div class="gallerix2-post-views"><i class="fa fa-eye"></i><span><?php echo $post->views; ?></span></div>
                            </div>
                            <div class="gallerix2-post-stext">
                                <?php echo Gallerix2::truncate_string($post->short, $options->stextlimit); ?>
                            </div>
                        </div>
                    </div>
                    <div class="gallerix2-post-thumb">
                        <img src="<?php echo $post->thumb; ?>" alt="<?php echo $post->title; ?>" />
                    </div>

                    <div class="gallerix2-post-data">

                        <!-- Post html -->
                        
                        <div class="gallerix2-post-media">
                            <div class="gallerix2-post-media-images">
                                <?php $images = explode("||",$post->image); ?>
                                <?php $images = array_filter( $images, 'strlen' ); ?>
                                <?php foreach ($images as $k => $image) : ?>
                                    <img class="gallerix2-post-image" src="" data-gallerix2-post-image-src="<?php echo $image; ?>" />
                                <?php endforeach; ?>
                            </div>
                            
                            <?php if (count($images) > 1) : ?>
                                <div class="gallerix2-post-media-controls">
                                    <div class="gallerix2-post-media-control-prev"><i class="fa fa-chevron-left"></i></div>
                                    <div class="gallerix2-post-media-control-next"><i class="fa fa-chevron-right"></i></div>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                        
                        <div class="gallerix2-lightbox-post-wrapper-inner">
                            <h2 class="gallerix2-lightbox-post-title"><?php echo $post->title; ?></h2>
                            <div class="gallerix2-post-content"><?php echo $post->content; ?></div>
                            
                            <?php if ($options->enablecomments == "1") : ?>

                            <div class="gallerix2-post-comments">
                                <?php if ($options->disqus == "0") include("comments.php"); ?>
                            </div>
                            
                            <?php endif; ?>
                            
                            <?php $liked = isset($_COOKIE["gallerix2-post-id-" . $post->id . "-liked"]) ? "liked" : ""; ?>
                            <div class="fa fa-certificate gallerix2-lightbox-button-like <?php echo $liked; ?>">
                                <i class="fa fa-thumbs-up"></i>
                                <i class="fa fa-check checked"></i>
                            </div>
                        </div>

                        <!-- /Post html -->

                    </div>
                </li>

            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>

    <ul class="gallerix2-page-control">
        <li class="gallerix2-page-control-prev"><i class="fa fa-chevron-circle-left"></i></li>
        <li class="gallerix2-page-control-next"><i class="fa fa-chevron-circle-right"></i></li>
    </ul>

    <div class="gallerix2-blackbox" data-gallerix2-blackbox-id="<?php echo $options->id; ?>"></div>
    <div class="gallerix2-lightbox" data-gallerix2-lightbox-id="<?php echo $options->id; ?>">

        <div class="gallerix2-lightbox-side-control-strip">
            <div class="gallerix2-lightbox-side-control">
                <div class="gallerix2-lightbox-button-close"><i class="fa fa-times"></i></div>
                <div class="gallerix2-lightbox-button-prev"><i class="fa fa-chevron-left"></i></div>
                <div class="gallerix2-lightbox-button-next"><i class="fa fa-chevron-right"></i></div>
                
                <a target="_BLANK" href="" class="gallerix2-lightbox-social-facebook"><i class="fa fa-facebook"></i></a>
                <a target="_BLANK" href="" class="gallerix2-lightbox-social-twitter"><i class="fa fa-twitter"></i></a>
                <a target="_BLANK" href="" class="gallerix2-lightbox-social-pinterest"><i class="fa fa-pinterest"></i></a>
                <a target="_BLANK" href="" class="gallerix2-lightbox-social-googleplus"><i class="fa fa-google-plus"></i></a>
                
                
            </div>
        </div>
        <div class="gallerix2-lightbox-post-wrapper">
            <!-- Post data -->
        </div>
    </div>

    <div class="gallerix2-lightbox-preloader"></div>

</div>