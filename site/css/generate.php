<?php
$prefix = "body";
$options = Gallerix2::get_options();

Gallerix2::load_google_fonts(); ?>
<style type="text/css">
    
    
    
    <?php echo $prefix ?> .gallerix2-category-thumb-stack-1,
    <?php echo $prefix ?> .gallerix2-category-thumb-stack-2,
    <?php echo $prefix ?> .gallerix2-category-thumb,
    <?php echo $prefix ?> .gallerix2-post-thumb {
        <?php if ($options->catpostwrapper == "1") : ?>
        box-shadow: 0px 2px 2px <?php echo Gallerix2::hex2rgba($options->catpostwrappershadowcolor, "0.3"); ?>;
        <?php else : ?>
        box-shadow: none !important;
        <?php endif; ?>
        
        background:<?php echo $options->catpostwrapperbgcolor; ?>
    }
    
    <?php echo $prefix ?> .gallerix2-category-thumb,
    <?php echo $prefix ?> .gallerix2-post-thumb {
        border-color: <?php echo $options->catpostwrapperbgcolor; ?>
    }
    
    <?php echo $prefix ?> .gallerix2-category-title,
    <?php echo $prefix ?> .gallerix2-post-short-inner {
        background:<?php echo $options->catpostwrapperbgcolor; ?>
    }
    
    
    <?php echo $prefix ?> .gallerix2-category,
    <?php echo $prefix ?> .gallerix2-category-thumb ,
    <?php echo $prefix ?> .gallerix2-post,
    <?php echo $prefix ?> .gallerix2-post-thumb {
        width: <?php echo $options->thumbwidth; ?>px;
        height: <?php echo $options->thumbheight; ?>px;
    }
    
    <?php echo $prefix ?> .gallerix2-category-thumb img,
    <?php echo $prefix ?> .gallerix2-post-thumb img {
        width: <?php echo $options->thumbwidth - 20; ?>px;
        height: <?php echo $options->thumbheight - 20; ?>px;
    }
    
    <?php echo $prefix ?> .gallerix2-category-thumb-stack-1 {
        height: <?php echo $options->thumbheight; ?>px;
    }
    
    <?php echo $prefix ?> .gallerix2-category-thumb-stack-2 {
        height: <?php echo $options->thumbheight; ?>px;
    }
    
    
    <?php echo $prefix ?> .gallerix2-title {
        color: <?php echo $options->titlecolor; ?>;
        <?php echo Gallerix2::font_to_css($options->titlefont); ?>
        font-size: <?php echo $options->titlefontsize; ?>;
    }
    
    <?php echo $prefix ?> .gallerix2-category-button-close {
        color: <?php echo $options->titlecolor; ?>;
        <?php echo Gallerix2::font_to_css($options->titlefont); ?>
        font-size: <?php echo $options->titlefontsize; ?>;
    }
    
    <?php echo $prefix ?> .gallerix2-category-title {
        color: <?php echo $options->cattitlecolor; ?>;
        <?php echo Gallerix2::font_to_css($options->cattitlefont); ?>
        font-size: <?php echo $options->cattitlefontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-title {
        color: <?php echo $options->posttitlecolor; ?>;
        <?php echo Gallerix2::font_to_css($options->posttitlefont); ?>
        font-size: <?php echo $options->posttitlefontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-stext {
        color: <?php echo $options->postdesccolor; ?>;
        <?php echo Gallerix2::font_to_css($options->postdescfont); ?>
        font-size: <?php echo $options->postdescfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-comments-count span {
        color: <?php echo $options->postdesccommentscolor; ?>;
        <?php echo Gallerix2::font_to_css($options->postcommentsfont); ?>
        font-size: <?php echo $options->postcommentsfontsize; ?>;
        line-height: <?php echo $options->postcommentsfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-likes span {
        color: <?php echo $options->postdesclikescolor; ?>;
        <?php echo Gallerix2::font_to_css($options->postlikesfont); ?>
        font-size: <?php echo $options->postlikesfontsize; ?>;
        line-height: <?php echo $options->postlikesfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-views span {
        color: <?php echo $options->postdescviewscolor; ?>;
        <?php echo Gallerix2::font_to_css($options->postviewsfont); ?>
        font-size: <?php echo $options->postviewsfontsize; ?>;
        line-height: <?php echo $options->postviewsfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-comments-count i {
        color: <?php echo $options->postdesccommentsiconcolor; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-likes i {
        color: <?php echo $options->postdesclikesiconcolor; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-views i {
        color: <?php echo $options->postdescviewsiconcolor; ?>;
    }

    <?php echo $prefix ?> .gallerix2-page-control i {
        color: <?php echo $options->navigationbuttonscolor; ?>;
    }

    <?php echo $prefix ?> .gallerix2-page-control i:hover {
        color: <?php echo $options->navigationbuttonscolorhover; ?>;
    }

    
    

    <?php echo $prefix ?> .gallerix2-blackbox {
        background: <?php echo $options->blackboxcolor; ?>;
    }

    <?php echo $prefix ?> .gallerix2-lightbox-post-wrapper {
        background: <?php echo $options->lightboxbgcolor; ?>;
        box-shadow: 20px 20px 0 0 <?php echo $options->lightboxshadowcolor; ?>;
    }

    <?php echo $prefix ?> .gallerix2-lightbox-side-control-strip {
        background: <?php echo $options->lightboxleftnavbgcolor; ?>;
    }

    <?php echo $prefix ?> .gallerix2-lightbox-post-title {
        color: <?php echo $options->lightboxtitlecolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxtitlefont); ?>
        font-size: <?php echo $options->lightboxtitlefontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-content {
        color: <?php echo $options->lightboxdesccolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxdescfont); ?>
        font-size: <?php echo $options->lightboxdescfontsize; ?>;
    }

    
    <?php echo $prefix ?> .gallerix2-lightbox-social-facebook,
    <?php echo $prefix ?> .gallerix2-lightbox-social-twitter,
    <?php echo $prefix ?> .gallerix2-lightbox-social-pinterest,
    <?php echo $prefix ?> .gallerix2-lightbox-social-googleplus {
         color: <?php echo $options->lightboxsharelinkscolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxsharelinksfont); ?>
        font-size: <?php echo $options->lightboxsharelinksfontsize; ?>;
    }
    
    <?php echo $prefix ?> .gallerix2-lightbox-social-facebook:hover,
    <?php echo $prefix ?> .gallerix2-lightbox-social-twitter:hover,
    <?php echo $prefix ?> .gallerix2-lightbox-social-pinterest:hover,
    <?php echo $prefix ?> .gallerix2-lightbox-social-googleplus:hover {
         color: <?php echo $options->lightboxsharelinkscolorhover; ?>;
    }
    
    <?php echo $prefix ?> .gallerix2-post-comments-title {
        color: <?php echo $options->lightboxcommentsheadercolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentsheaderfont); ?>
        font-size: <?php echo $options->lightboxcommentsheaderfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-comment-author {
        color: <?php echo $options->lightboxcommentsauthorcolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentsauthorfont); ?>
        font-size: <?php echo $options->lightboxcommentsauthorfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-comment-date {
        color: <?php echo $options->lightboxcommentsdatecolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentsdatefont); ?>
        font-size: <?php echo $options->lightboxcommentsdatefontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-comment-text {
        color: <?php echo $options->lightboxcommentstextcolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentstextfont); ?>
        font-size: <?php echo $options->lightboxcommentstextfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-comment-reply {
        color: <?php echo $options->lightboxcommentsreplycolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentsreplylinkfont); ?>
        font-size: <?php echo $options->lightboxcommentsreplylinkfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-comment-reply:hover {
        color: <?php echo $options->lightboxcommentsreplycolorhover; ?>;
    }

    <?php echo $prefix ?> .gallerix2-comments-load-more-button {
        background: <?php echo $options->lightboxloadmorebgcolor; ?>;
        color: <?php echo $options->lightboxloadmorecolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentsloadmorefont); ?>
        font-size: <?php echo $options->lightboxcommentsloadmorefontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-comments-load-more-button:hover {
        background: <?php echo $options->lightboxloadmorebgcolorhover; ?>;
        color: <?php echo $options->lightboxloadmorecolorhover; ?>;
    }

    <?php echo $prefix ?> .gallerix2-post-comments-list {
        border-bottom: 1px solid <?php echo $options->lightboxloadmoreborders; ?>;
    }

    <?php echo $prefix ?> .gallerix2-comments-load-more {
        border-bottom: 1px solid <?php echo $options->lightboxloadmoreborders; ?>;
    }

    <?php echo $prefix ?> .gallerix2-leave-comment-title {
        color: <?php echo $options->lightboxcommentformheadercolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentformheaderfont); ?>
        font-size: <?php echo $options->lightboxcommentformheaderfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-form-field, 
    <?php echo $prefix ?> .gallerix2-form-textarea {
        background: <?php echo $options->lightboxcommentforminputbgcolor; ?>;
        color: <?php echo $options->lightboxcommentforminputcolor; ?>;
        border: 1px solid <?php echo $options->lightboxcommentforminputbordercolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentforminputfont); ?>
        font-size: <?php echo $options->lightboxcommentforminputfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-form-button-submit {
        background: <?php echo $options->lightboxcommentformsubmitbuttonbgcolor; ?>;
        color: <?php echo $options->lightboxcommentformsubmitbuttoncolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentformbuttonfont); ?>
        font-size: <?php echo $options->lightboxcommentformbuttonfontsize; ?>;
    }

    <?php echo $prefix ?> .gallerix2-form-button-submit:hover {
        background: <?php echo $options->lightboxcommentformsubmitbuttonbgcolorhover; ?>;
        color: <?php echo $options->lightboxcommentformsubmitbuttoncolorhover; ?>;
    }

    <?php echo $prefix ?> .gallerix2-leave-comment-cancel {
        color: <?php echo $options->lightboxcommentformcancelreplycolor; ?>;
        <?php echo Gallerix2::font_to_css($options->lightboxcommentformcancelreplyfont); ?>
        font-size: <?php echo $options->lightboxcommentformcancelreplyfontsize; ?>;
    }
    
    <?php echo $prefix ?> .gallerix2-lightbox-button-prev,
    <?php echo $prefix ?> .gallerix2-lightbox-button-next, 
    <?php echo $prefix ?> .gallerix2-lightbox-button-close {
        color: <?php echo $options->lightboxnavigationcolor; ?>;
    }
    <?php echo $prefix ?> .gallerix2-lightbox-button-prev:hover,
    <?php echo $prefix ?> .gallerix2-lightbox-button-next:hover, 
    <?php echo $prefix ?> .gallerix2-lightbox-button-close:hover {
        color: <?php echo $options->lightboxnavigationcolorhover; ?>;
    }
    
    <?php echo $prefix ?> .gallerix2-post-media-control-prev,
    <?php echo $prefix ?> .gallerix2-post-media-control-next {
        color: <?php echo $options->lightboxmedianavigationcolor; ?>;
    }
    <?php echo $prefix ?> .gallerix2-post-media-control-prev:hover,
    <?php echo $prefix ?> .gallerix2-post-media-control-next:hover {
        color: <?php echo $options->lightboxmedianavigationcolorhover; ?>;
    }
    
 
    
    
    <?php echo $prefix ?> .gallerix2-lightbox-button-like {
        color: <?php echo $options->lightboxlikebuttonbgcolor; ?>
    }
    
    <?php echo $prefix ?> .gallerix2-lightbox-button-like i {
        color: <?php echo $options->lightboxlikebuttoncolor; ?>
    }
    
    <?php echo $prefix ?> .gallerix2-lightbox-button-like.liked {
        color: <?php echo $options->lightboxlikedbuttonbgcolor; ?>
    }
    
    <?php echo $prefix ?> .gallerix2-lightbox-button-like.liked i {
        color: <?php echo $options->lightboxlikedbuttoncolor; ?>
    }
    
    
    
</style>