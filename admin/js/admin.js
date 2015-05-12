function gallerix2() {
    
    "use strict";
    
    this.init = function(){
        media.init();
        general.init();
        add_edit_post.init();
        list_posts.init();
        list_categories.init();
        tabs.init();
        validator.init();
    };
    
    var validator = {
        init: function(){
            jQuery("form").on("submit", function(e){
                
                jQuery('input,textarea,select').removeClass("invalid");
                
                var valid = true;
                
                jQuery('input,textarea,select').filter('[required]').each(function() {
                    if (!jQuery(this).val() || jQuery.trim(jQuery(this).val()) == "") {
                        jQuery(this).addClass("invalid");
                        valid = false;
                    }
                });
                
                if (valid !== true) {
                    alert("Please fill all required fields first!");
                }
                
                return valid;
            });
        }
    };
    
    var tabs = {
        init: function(){
            this.bindControls();
        },
        bindControls: function(){
            
            jQuery(".admin_section_tabs .fonts_tab").on("click", function(e) {
                e.preventDefault();
                jQuery(".gallerix2_section_colors").hide();
                jQuery(".gallerix2_section_disqus").hide();
                jQuery(".gallerix2_section_other").hide();
                jQuery(".gallerix2_section_fonts").show();
                jQuery(this).siblings().removeClass("active");
                jQuery(this).addClass("active");
            });
            
            jQuery(".admin_section_tabs .colors_tab").on("click", function(e) {
                e.preventDefault();
                jQuery(".gallerix2_section_colors").show();
                jQuery(".gallerix2_section_other").hide();
                jQuery(".gallerix2_section_disqus").hide();
                jQuery(".gallerix2_section_fonts").hide();
                jQuery(this).siblings().removeClass("active");
                jQuery(this).addClass("active");
            });
            
            jQuery(".admin_section_tabs .other_tab").on("click", function(e) {
                e.preventDefault();
                jQuery(".gallerix2_section_colors").hide();
                jQuery(".gallerix2_section_other").show();
                jQuery(".gallerix2_section_fonts").hide();
                jQuery(".gallerix2_section_disqus").hide();
                jQuery(this).siblings().removeClass("active");
                jQuery(this).addClass("active");
            });
            
            jQuery(".admin_section_tabs .disqus_tab").on("click", function(e) {
                e.preventDefault();
                jQuery(".gallerix2_section_colors").hide();
                jQuery(".gallerix2_section_other").hide();
                jQuery(".gallerix2_section_fonts").hide();
                jQuery(".gallerix2_section_disqus").show();
                jQuery(this).siblings().removeClass("active");
                jQuery(this).addClass("active");
            });
        }
    };
    
    var media = {
        element: false,
        frame: "",
        init: function() {
            
            media.frame = wp.media({
                button: {
                    text: "Pick Image"
                },
                library: {
                    type: 'image' 
                },
                frame: 'select',
                title: "Choose Image",
                multiple: true
            });
        }
    };
    
    var general = {
        init: function(){
            this.bindControls();
        },
         
        bindControls: function() {
            jQuery('.gallerix2_color_picker').each(function() {
                var th = this;
                
                var color = jQuery(th).val();
                
                jQuery(th).css({
                    backgroundColor: color
                });
                
                jQuery(th).ColorPicker({
                    color: color,
                    onShow: function(colpkr) {
                        jQuery(colpkr).fadeIn(250);
                        return false;
                    },
                    onHide: function(colpkr) {
                        jQuery(colpkr).fadeOut(250);
                        return false;
                    },
                    onChange: function(hsb, hex, rgb) {
                        jQuery(th).val("#"+hex);
                        
                        jQuery(th).css({
                            backgroundColor: jQuery(th).val()
                        });
                    }
                });
            });
        }
    };
    
    var list_categories = {
        init: function(){
            this.bindControls();
        },
        
        bindControls: function(){
            
            
            
            
            jQuery("button.categories_reorder").on("click", function(event){
                var th = this;
                
                jQuery(th).siblings().remove();
                
                jQuery(".list").children().each(function() {
                    var id = jQuery(this).attr("id").replace("category-", "");
                    var num = jQuery(this).find("input[type=text]").val();
                    jQuery(th).after('<input type="hidden" name="order[]" value="' + id + ":" + num + '" />');
                });
                
                jQuery(th).after('<input type="hidden" name="task" value="updateOrder" />');
            });
        }
    };
    
    var list_posts = {
        init: function(){
            this.bindControls();
        },
        
        bindControls: function(){
            
            jQuery("button.posts_reorder").on("click", function(event){
                var th = this;
                
                jQuery(th).siblings().remove();
                
                jQuery(".list").children().each(function() {
                    var id = jQuery(this).attr("id").replace("post-", "");
                    var num = jQuery(this).find("input[type=text]").val();
                    jQuery(th).after('<input type="hidden" name="order[]" value="' + id + ":" + num + '" />');
                });
                
                jQuery(th).after('<input type="hidden" name="task" value="updateOrder" />');
            });
        }
    };

    
    var add_edit_post = {
        init: function(){
            this.bindControls();
        },
        bindControls: function(){
            jQuery(document).on("click", ".remove_post_image", function(event){
                event.stopPropagation();
                event.preventDefault();
                if (jQuery('input[name="image[]"]').length > 1) {
                    jQuery(this).parents("label").remove();
                } else {
                    jQuery(this).parents("label").find("input").val("");
                }
            });
            
            jQuery(document).on("mouseover",'input[name="thumb"], input[name="image[]"]', function() {
                if (jQuery(this).val() != "") {
                    jQuery("#gallerix2-image-preview").remove();
                    var html = '<div id="gallerix2-image-preview"><p>Image Preview</p><img src="'+jQuery(this).val()+'" /></div>';
                        jQuery(html).appendTo("body");
                    
                    jQuery("#gallerix2-image-preview").css({
                        position:"fixed",
                        top: 40,
                        right:5,
                        background:"#FFF",
                        padding:10
                    });
                    
                    jQuery("#gallerix2-image-preview p").css({
                        fontSize:15,
                        lineheight:1,
                        margin: "0 0 10px"
                    });
                    
                    jQuery("#gallerix2-image-preview img").css({
                        width:350,
                        height:"auto"
                    });
                }
            });
            
            jQuery(document).on("mouseleave",'input[name="thumb"], input[name="image[]"]', function() {
                jQuery("#gallerix2-image-preview").remove();
            });
            
            jQuery(document).on("click",'input[name="thumb"], input[name="image[]"]', function() {
                media.element = this;
                media.frame.open();
            });
            
            
            media.frame.on('select', function() {
                var attachments = media.frame.state().get('selection');
                if (!media.element) return;
                
                var i = 0;
                
                attachments.map(function(attachment) {
                    attachment = attachment.toJSON();
                    
                    if (i == 0) {
                        jQuery(media.element).val(attachment.url);
                    } else {
                        var html = "";
                        
                        html = jQuery('.gallerix2-post-images label:first').clone();
                        
                        html.find('input[name="image[]"]').val(attachment.url);

                        html.fadeTo(250,1).appendTo(".gallerix2-post-images");
                    }
                    
                    i++;
                });
            });
            
            jQuery(".gallerix2-post-images").sortable();
            
            jQuery(".add_more_images").on("click", function(event){
                event.preventDefault();
                
                var html = "";
                
                html += '<label>';
                    html += '<span>Post Image</span>';
                    html += '<div class="remove_post_image"><i class="fa fa-times"></i></div>';
                    html += '<span class="caption_note">(Optional!)</span><br />';
                    html += '<input name="image[]" type="text" />';
                    html += '<p>(Post Image, Screenshot etc...)</p>';
                html += '</label>';
                
                jQuery(html).fadeTo(250,1).appendTo(".gallerix2-post-images");
                
            });
            
          
    
        }
    };
};

jQuery(document).ready(function(){
    new gallerix2().init();
});