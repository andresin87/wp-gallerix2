<?php
global $plugin_page;
$options = gallerix2::get_options();
?>
<!-- Admin Wrapper Start -->
<div class="admin_wrapper">

    <!-- Admin Section Start -->
    <div class="admin_section">

        <!-- Admin Section Header Start -->
        <div class="admin_section_header">
            <h2><?php _e("General Settings", "gallerix2"); ?></h2>
            <p><?php _e("Adjust Gallerix 2 general settings", "gallerix2"); ?></p>
        </div><!--/admin_section_header -->
        <!-- Admin Section Header End -->

        <!-- Admin Section Body Start -->
        <div class="admin_section_body">
            <form id="gallerix2-form-save" action="?page=<?php echo $plugin_page; ?>&view=general" method="POST">

                <div class="admin_section_tabs">
                    <button onclick="return false;" class="other_tab active">General</button>
                    <button onclick="return false;" class="colors_tab">Colors</button>
                    <button onclick="return false;" class="fonts_tab">Fonts</button>
                    <button onclick="return false;" class="disqus_tab">Disqus</button>
                </div>

                <!-- Colors -->
                <div class="gallerix2_section_colors">    
                    <label>
                        <span><?php _e("Title text color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="titlecolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->titlecolor; ?>" />
                        <p>(<?php _e("Title text color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Category / Post Wrapper Background Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="catpostwrapperbgcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->catpostwrapperbgcolor; ?>" />
                        <p>(<?php _e("Category / Post Wrapper Background Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Category / Post Wrapper Shadow Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="catpostwrappershadowcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->catpostwrappershadowcolor; ?>" />
                        <p>(<?php _e("Category / Post Wrapper Shadow Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Category title text color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="cattitlecolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->cattitlecolor; ?>" />
                        <p>(<?php _e("Category title text color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post title text color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="posttitlecolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->posttitlecolor; ?>" />
                        <p>(<?php _e("Post title text color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post description text color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postdesccolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->postdesccolor; ?>" />
                        <p>(<?php _e("Post description text color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post description comments text color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postdesccommentscolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->postdesccommentscolor; ?>" />
                        <p>(<?php _e("Comments count text color in the description block", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post description likes text color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postdesclikescolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->postdesclikescolor; ?>" />
                        <p>(<?php _e("Likes count text color in the description block", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post description views text color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postdescviewscolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->postdescviewscolor; ?>" />
                        <p>(<?php _e("Views count text color in the description block", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post description comments icon color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postdesccommentsiconcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->postdesccommentsiconcolor; ?>" />
                        <p>(<?php _e("Comments icon color in the description block", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post description likes icon color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postdesclikesiconcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->postdesclikesiconcolor; ?>" />
                        <p>(<?php _e("Likes count icon color in the description block", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post description views icon color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postdescviewsiconcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->postdescviewsiconcolor; ?>" />
                        <p>(<?php _e("Views count icon color in the description block", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Navigation Buttons Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="navigationbuttonscolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->navigationbuttonscolor; ?>" />
                        <p>(<?php _e("(Next / Previous) Buttons Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Navigation Buttons Hover Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="navigationbuttonscolorhover" type="text" class="gallerix2_color_picker" value="<?php echo $options->navigationbuttonscolorhover; ?>" />
                        <p>(<?php _e("(Next / Previous) Buttons Hover Color", "gallerix2"); ?>)</p>
                    </label>


                    <!-- Lightbox colors -->
                    <div class="gallerix2_separator"></div>

                    <label>
                        <span><?php _e("Blackbox Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="blackboxcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->blackboxcolor; ?>" />
                        <p>(<?php _e("Background screen color during lightbox view", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Background Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxbgcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxbgcolor; ?>" />
                        <p>(<?php _e("Lightbox Background Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Left Navigation Background Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxleftnavbgcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxleftnavbgcolor; ?>" />
                        <p>(<?php _e("Lightbox Left Navigation Background Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Shadow Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxshadowcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxshadowcolor; ?>" />
                        <p>(<?php _e("Lightbox Shadow Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Title Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxtitlecolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxtitlecolor; ?>" />
                        <p>(<?php _e("Lightbox Post Title Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Description Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxdesccolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxdesccolor; ?>" />
                        <p>(<?php _e("Lightbox Post Description Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Share Links Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxsharelinkscolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxsharelinkscolor; ?>" />
                        <p>(<?php _e("Lightbox Share Links Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Share Links Hover Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxsharelinkscolorhover" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxsharelinkscolorhover; ?>" />
                        <p>(<?php _e("Lightbox Share Links Hover Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Header Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsheadercolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentsheadercolor; ?>" />
                        <p>(<?php _e("Lightbox Comments Header Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Author Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsauthorcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentsauthorcolor; ?>" />
                        <p>(<?php _e("Lightbox Comments Author Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Date Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsdatecolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentsdatecolor; ?>" />
                        <p>(<?php _e("Lightbox Comments Date Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Text Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentstextcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentstextcolor; ?>" />
                        <p>(<?php _e("Lightbox Comments Text Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Reply Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsreplycolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentsreplycolor; ?>" />
                        <p>(<?php _e("Lightbox Comments Reply Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Reply Hover Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsreplycolorhover" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentsreplycolorhover; ?>" />
                        <p>(<?php _e("Lightbox Comments Reply Hover Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Load More Comments Button Background", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxloadmorebgcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxloadmorebgcolor; ?>" />
                        <p>(<?php _e("Lightbox Load More Comments Button Background", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Load More Comments Button Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxloadmorecolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxloadmorecolor; ?>" />
                        <p>(<?php _e("Lightbox Load More Comments Button Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Load More Comments Button Hover Background", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxloadmorebgcolorhover" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxloadmorebgcolorhover; ?>" />
                        <p>(<?php _e("Lightbox Load More Comments Button Hover Background", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Load More Comments Button Hover Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxloadmorecolorhover" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxloadmorecolorhover; ?>" />
                        <p>(<?php _e("Lightbox Load More Comments Button Hover Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Load More Comments Borders Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxloadmoreborders" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxloadmoreborders; ?>" />
                        <p>(<?php _e("Lightbox Load More Comments Borders Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Header Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentformheadercolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentformheadercolor; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Header Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Input Background Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentforminputbgcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentforminputbgcolor; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Input Background Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Input Text Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentforminputcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentforminputcolor; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Input Text Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Input Border Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentforminputbordercolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentforminputbordercolor; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Input Border Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Submit Button Background Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentformsubmitbuttonbgcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentformsubmitbuttonbgcolor; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Submit Button Background Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Submit Button Text Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentformsubmitbuttoncolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentformsubmitbuttoncolor; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Submit Button Text Color", "gallerix2"); ?>)</p>
                    </label>


                    <label>
                        <span><?php _e("Lightbox Comment Form Submit Button Hover Background Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentformsubmitbuttonbgcolorhover" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentformsubmitbuttonbgcolorhover; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Submit Button Hover Background Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Submit Button Hover Text Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentformsubmitbuttoncolorhover" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentformsubmitbuttoncolorhover; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Submit Button Hover Text Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Cancel Reply Text Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentformcancelreplycolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxcommentformcancelreplycolor; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Cancel Reply Text Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Navigation Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxnavigationcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxnavigationcolor; ?>" />
                        <p>(<?php _e("Lightbox Navigation Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Navigation Hover Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxnavigationcolorhover" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxnavigationcolorhover; ?>" />
                        <p>(<?php _e("Lightbox Navigation Color Hover", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Media Navigation Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxmedianavigationcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxmedianavigationcolor; ?>" />
                        <p>(<?php _e("Lightbox Media Navigation (Next/Prev post image controls) Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Media Navigation Hover Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxmedianavigationcolorhover" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxmedianavigationcolorhover; ?>" />
                        <p>(<?php _e("Lightbox Media Navigation (Next/Prev post image controls) Color Hover", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Like Button Background Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxlikebuttonbgcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxlikebuttonbgcolor; ?>" />
                        <p>(<?php _e("Lightbox Like Button Background Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Like Button Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxlikebuttoncolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxlikebuttoncolor; ?>" />
                        <p>(<?php _e("Lightbox Like Button Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Liked Button Background Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxlikedbuttonbgcolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxlikedbuttonbgcolor; ?>" />
                        <p>(<?php _e("Lightbox Like Button Background Color", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Liked Button Color", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxlikedbuttoncolor" type="text" class="gallerix2_color_picker" value="<?php echo $options->lightboxlikedbuttoncolor; ?>" />
                        <p>(<?php _e("Lightbox Like Button Color", "gallerix2"); ?>)</p>
                    </label>

                </div>

                <div class="gallerix2_section_fonts">

                    <!-- Fonts -->

                    <?php $fontsArray = gallerix2::get_google_fonts(); ?>

                    <label>
                        <span><?php _e("Title Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="titlefont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->titlefont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Title Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Category Title Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="cattitlefont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->cattitlefont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Category Title Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Title Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="posttitlefont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->posttitlefont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Post Title Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Description Text Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="postdescfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->postdescfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Post Description Text Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Comments Count Text Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="postcommentsfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->postcommentsfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Post Comments Count Text Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Likes Count Text Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="postlikesfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->postcommentsfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Post Likes Count Text Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Views Count Text Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="postviewsfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->postviewsfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Post Views Count Text Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <!-- Lightbox fonts --> 
                    <div class="gallerix2_separator"></div>
                    <label>
                        <span><?php _e("Lightbox Title Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxtitlefont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxtitlefont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Title Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Description Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxdescfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxdescfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Description Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Share Links Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxsharelinksfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxsharelinksfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Share Links Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Header Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentsheaderfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentsheaderfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Comments Header Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Author Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentsauthorfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentsauthorfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Comments Author Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Date Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentsdatefont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentsdatefont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Comments Date Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Text Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentstextfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentstextfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Comments Text Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Reply Link Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentsreplylinkfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentsreplylinkfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Comments Reply Link Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Load More Comments Button Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentsloadmorefont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentsloadmorefont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Load More Comments Button Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Header Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentformheaderfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentformheaderfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Comment Form Header Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Input Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentforminputfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentforminputfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Comment Form Input Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Submit Button Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentformbuttonfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentformbuttonfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Comment Form Submit Button Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Cancel Reply Text Font-Family", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="lightboxcommentformcancelreplyfont">
                            <?php foreach ($fontsArray as $key => $font) : ?>
                                <option value="<?php echo $key; ?>" <?php if ($options->lightboxcommentformcancelreplyfont == $font) echo 'selected="selected"'; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Lightbox Comment Form Cancel Reply Text Font-Family", "gallerix2"); ?>)</p>
                    </label>

                    <!--Sizes-->
                    <div class="gallerix2_separator"></div>
                    <label>
                        <span><?php _e("Title Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="titlefontsize" type="text" value="<?php echo $options->titlefontsize; ?>" />
                        <p>(<?php _e("Title Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Category Title Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="cattitlefontsize" type="text" value="<?php echo $options->cattitlefontsize; ?>" />
                        <p>(<?php _e("Category Title Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Title Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="posttitlefontsize" type="text" value="<?php echo $options->posttitlefontsize; ?>" />
                        <p>(<?php _e("Post Title Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Description Text Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postdescfontsize" type="text" value="<?php echo $options->postdescfontsize; ?>" />
                        <p>(<?php _e("Post Description Text Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Comments Count Text Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postcommentsfontsize" type="text" value="<?php echo $options->postcommentsfontsize; ?>" />
                        <p>(<?php _e("Post Comments Count Text Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Likes Count Text Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postlikesfontsize" type="text" value="<?php echo $options->postlikesfontsize; ?>" />
                        <p>(<?php _e("Post Likes Count Text Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Post Views Count Text Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="postviewsfontsize" type="text" value="<?php echo $options->postviewsfontsize; ?>" />
                        <p>(<?php _e("Post Views Count Text Font size", "gallerix2"); ?>)</p>
                    </label>

                    <!-- Lightbox font sizes --> 
                    <div class="gallerix2_separator"></div>
                    <label>
                        <span><?php _e("Lightbox Title Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxtitlefontsize" type="text" value="<?php echo $options->lightboxtitlefontsize; ?>" />
                        <p>(<?php _e("Lightbox Title Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Description Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxdescfontsize" type="text" value="<?php echo $options->lightboxdescfontsize; ?>" />
                        <p>(<?php _e("Lightbox Description Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Share Links Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxsharelinksfontsize" type="text" value="<?php echo $options->lightboxsharelinksfontsize; ?>" />
                        <p>(<?php _e("Lightbox Share Links Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Header Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsheaderfontsize" type="text" value="<?php echo $options->lightboxcommentsheaderfontsize; ?>" />
                        <p>(<?php _e("Lightbox Comments Header Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Author Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsauthorfontsize" type="text" value="<?php echo $options->lightboxcommentsauthorfontsize; ?>" />
                        <p>(<?php _e("Lightbox Comments Author Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Date Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsdatefontsize" type="text" value="<?php echo $options->lightboxcommentsdatefontsize; ?>" />
                        <p>(<?php _e("Lightbox Comments Date Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Text Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentstextfontsize" type="text" value="<?php echo $options->lightboxcommentstextfontsize; ?>" />
                        <p>(<?php _e("Lightbox Comments Text Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comments Reply Link Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsreplylinkfontsize" type="text" value="<?php echo $options->lightboxcommentsreplylinkfontsize; ?>" />
                        <p>(<?php _e("Lightbox Comments Reply Link Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Load More Comments Button Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentsloadmorefontsize" type="text" value="<?php echo $options->lightboxcommentsloadmorefontsize; ?>" />
                        <p>(<?php _e("Lightbox Load More Comments Button Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Header Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentformheaderfontsize" type="text" value="<?php echo $options->lightboxcommentformheaderfontsize; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Header Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Input Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentforminputfontsize" type="text" value="<?php echo $options->lightboxcommentforminputfontsize; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Input Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Submit Button Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentformbuttonfontsize" type="text" value="<?php echo $options->lightboxcommentformbuttonfontsize; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Submit Button Font size", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Lightbox Comment Form Cancel Reply Text Font size", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="lightboxcommentformcancelreplyfontsize" type="text" value="<?php echo $options->lightboxcommentformcancelreplyfontsize; ?>" />
                        <p>(<?php _e("Lightbox Comment Form Cancel Reply Text Font size", "gallerix2"); ?>)</p>
                    </label>
                </div>

                
                
                <!--Disqus Section--> 
                <div class="gallerix2_section_disqus">
                    <label>
                        <h3>To moderate Disqus go to your <a target="_BLANK" href="https://disqus.com/admin/moderate/">Disqus Admin Panel</a></h3>
                    </label>
                    <label>
                        <span><?php _e("Enable Disqus", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="disqus">
                            <option value="0" <?php if ($options->disqus == 0) echo 'selected="selected"'; ?>>No</option>
                            <option value="1" <?php if ($options->disqus == 1) echo 'selected="selected"'; ?>>Yes</option>
                        </select>
                        <p>(<?php _e("Enable Disqus or use the default plugin comments", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Site Name", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="disqussite" type="text" value="<?php echo $options->disqussite; ?>" />
                        <p>(<?php _e("The Site Name (disqus_shortname) as typed in the Disqus Admin", "gallerix2"); ?>)</p>
                    </label>
                </div>



                <!-- Other -->
                <div class="gallerix2_section_other">       

                    <label>
                        <span><?php _e("Plugin Title", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input name="title" type="text" value="<?php echo $options->title; ?>" />
                        <p>(<?php _e("Plugin Title", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Default Categories", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Required!", "gallerix2"); ?>)</span><br />
                        <select required name="cat[]" multiple>
                            <?php $categories = gallerix2::get_categories(true); ?>
                            <?php $active_cats = explode(",", $options->cat); ?>
                            <?php foreach ($categories as $category) : ?>
                                <option <?php if (in_array($category->id, $active_cats)) echo "selected"; ?> value="<?php echo $category->id ?>"><?php echo $category->title ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>(<?php _e("Categories to display by default)", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Thumb Width", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input required name="thumbwidth" type="text" value="<?php echo $options->thumbwidth; ?>" />
                        <p>(<?php _e("Thumbnail Width in Pixels", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Thumb Height", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input required name="thumbheight" type="text" value="<?php echo $options->thumbheight; ?>" />
                        <p>(<?php _e("Thumbnail Height in Pixels", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Categories Per Page", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Required!", "gallerix2"); ?>)</span><br />
                        <input required name="catperpage" type="text" value="<?php echo $options->catperpage; ?>" />
                        <p>(<?php _e("Maximum number of categories per page", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Posts Per Page", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Required!", "gallerix2"); ?>)</span><br />
                        <input required name="postperpage" type="text" value="<?php echo $options->postperpage; ?>" />
                        <p>(<?php _e("Maximum number of posts per page", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Posts Short Title Characters Limit", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input required name="stitlelimit" type="text" value="<?php echo $options->stitlelimit; ?>" />
                        <p>(<?php _e("Posts Short Title Characters Limit", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Posts Short Description Characters Limit", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input required name="stextlimit" type="text" value="<?php echo $options->stextlimit; ?>" />
                        <p>(<?php _e("Posts Short Description Characters Limit", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Category Wrapper Type", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="catwrappertype">
                            <option <?php if ($options->catwrappertype == "strict") echo "selected"; ?> value="strict">Strict</option>
                            <option <?php if ($options->catwrappertype == "mixed") echo "selected"; ?> value="mixed">Mixed</option>
                            <option <?php if ($options->catwrappertype == "standard") echo "selected"; ?> value="standard">Standard</option>
                        </select>
                        <p>(<?php _e("Category  Wrapper Type", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Category / Post Wrapper Shadow", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="catpostwrapper">
                            <option <?php if ($options->catpostwrapper == "0") echo "selected"; ?> value="0">Disable</option>
                            <option <?php if ($options->catpostwrapper == "1") echo "selected"; ?> value="1">Enable</option>
                        </select>
                        <p>(<?php _e("Enable/Disable Category / Post Wrapper Shadow", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Swap Animation", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="swapanimation">
                            <option <?php if ($options->swapanimation == "random") echo "selected"; ?> value="random">Random</option>
                            <option <?php if ($options->swapanimation == "fade") echo "selected"; ?> value="fade">Fade</option>
                            <option <?php if ($options->swapanimation == "zoom") echo "selected"; ?> value="zoom">Zoom</option>
                            <option <?php if ($options->swapanimation == "jump") echo "selected"; ?> value="jump">Jump</option>
                            <option <?php if ($options->swapanimation == "flipx") echo "selected"; ?> value="flipx">Flip X Axis</option>
                            <option <?php if ($options->swapanimation == "flipy") echo "selected"; ?> value="flipy">Flip Y Axis</option>
                            <option <?php if ($options->swapanimation == "pop") echo "selected"; ?> value="pop">Pop</option>
                            <option <?php if ($options->swapanimation == "around") echo "selected"; ?> value="around">Around</option>
                            <option <?php if ($options->swapanimation == "ontop") echo "selected"; ?> value="ontop">On Top</option>
                            <option <?php if ($options->swapanimation == "suckin") echo "selected"; ?> value="suckin">Suck In</option>
                            <option <?php if ($options->swapanimation == "rotatecorner") echo "selected"; ?> value="rotatecorner">Rotate Corner</option>
                        </select>
                        <p>(<?php _e("Swap Categories / Posts animation", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Enable Comments", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="enablecomments">
                            <option <?php if ($options->enablecomments == "1") echo "selected"; ?> value="1">Yes</option>
                            <option <?php if ($options->enablecomments == "0") echo "selected"; ?> value="0">No</option>
                        </select>
                        <p>(<?php _e("Enable Comments", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Only registered users can post comments", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="commentsrequireuser">
                            <option <?php if ($options->commentsrequireuser == "1") echo "selected"; ?> value="1">Yes</option>
                            <option <?php if ($options->commentsrequireuser == "0") echo "selected"; ?> value="0">No</option>
                        </select>
                        <p>(<?php _e("Only registered users can post comments", "gallerix2"); ?>)</p>
                    </label>

                    <label>
                        <span><?php _e("Comments Per Load", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <input required name="commentsperload" type="text" value="<?php echo $options->commentsperload; ?>" />
                        <p>(<?php _e("Maximum number of comments per load", "gallerix2"); ?>)</p>
                    </label>
                    
                     <label>
                        <span><?php _e("Enable/Disable URL navigation", "gallerix2"); ?></span>
                        <span class="caption_note">(<?php _e("Optional.", "gallerix2"); ?>)</span><br />
                        <select name="rtnavigation">
                            <option <?php if ($options->rtnavigation == "0") echo "selected"; ?> value="0">Disable</option>
                            <option <?php if ($options->rtnavigation == "1") echo "selected"; ?> value="1">Enable</option>
                        </select>
                        <p>(<?php _e("Enable/Disable URL navigation using GET params (modern browsers only)", "gallerix2"); ?>)</p>
                    </label>

                </div>

                <button><?php _e("Save Settings", "gallerix2"); ?></button>
                <input type="hidden" name="task" value="save" />
            </form>
            <form method="POST">
                <button><?php _e("Reset Defaults", "gallerix2"); ?></button>
                <input type="hidden" name="task" value="reset" />
            </form>
            <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>';"><?php _e("Cancel", "gallerix2"); ?></button>

        </div><!--/admin_section_body-->
        <!-- Admin Section Body End -->

    </div><!--/admin_section -->
    <!-- Admin Section End -->

</div><!--/admin_wrapper-->
<!-- Admin Wrapper End -->