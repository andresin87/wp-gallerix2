function gallerix2() {

    "use strict";

    var glob = {
        instance: "",
        lightbox: "",
        blackbox: "",
        params: ""
    };

    this.init = function(params) {
          
        glob.instance = "#" + params.id;
        glob.lightbox = "[data-gallerix2-lightbox-id=" + params.id + "]";
        glob.blackbox = "[data-gallerix2-blackbox-id=" + params.id + "]";
        glob.params   = params;
        
        lightbox.init();
        categories.init();
        posts.init();
        pagination.init();
        rtnavigation.init();
        
    };
    
    var rtnavigation = {
        init: function () {
            
            if (glob.params.rtnavigation == "0") return;
            
            this.goNav();
            this.bindControls();

        },
        
        goNav: function () {
            
            var getcat = helper.getUrlParameter("gcat");
            var getcatpage = helper.getUrlParameter("gcatpage");
            var getpost = helper.getUrlParameter("gpost");
            var getpostpage = helper.getUrlParameter("gpostpage");
            
            
             if (getcat) {
                // Navigate to category

                helper.afterAnimation(function () {
                    // Paginate category

                    if (getcatpage != 1) {
                        categories.cpage = getcatpage;
                        categories.swap();
                        pagination.recheck();
                    }
                    
                    if (getcat <= 0) return;
                    
                    helper.afterAnimation(function () {
                        // Open category
                        categories.open(getcat);

                        helper.afterAnimation(function () {

                            if (getpost) {
                                // Navigate to post

                                // Paginate post
                                if (getpostpage != 1) {
                                    posts.cpage = getpostpage;
                                    posts.swap();
                                    pagination.recheck();
                                }
                                
                                if (getpost <= 0) return;
                                
                                // Open lightbox
                                helper.afterAnimation(function () {
                                    
                                    posts.cat = getcat;
                                    posts.id = getpost;
                                    lightbox.open();
                                });
                            }
                        });
                    });
                });
            }
        },
        
        bindControls: function(){
            jQuery(glob.instance).find(".gallerix2-category").on("click", function () {
                helper.updateURL(posts.cat, categories.cpage, 0, 1);
            });
            
            jQuery(glob.instance).find(".gallerix2-post").on("click", function () {
                helper.updateURL(posts.cat, categories.cpage, posts.id, posts.cpage);
                lightbox.updateSocials();
            });
            
            jQuery(glob.instance).find(".gallerix2-page-control-next, .gallerix2-page-control-prev").on("click", function() {
                
                if (pagination.categoryBrowsing) {
                    helper.updateURL(0, categories.cpage, 0, posts.cpage);
                } else {
                    helper.updateURL(posts.cat, categories.cpage, 0, posts.cpage);
                }
                
            });
            
            jQuery(glob.instance).find(".gallerix2-category-button-close").on("click", function() {
                helper.updateURL(posts.cat, categories.cpage, 0, posts.cpage);
            });
            
            jQuery(glob.blackbox).on("click", function() {
                helper.updateURL(posts.cat, categories.cpage, 0, posts.cpage);
            });
            
            jQuery(glob.lightbox).find(".gallerix2-lightbox-button-next, .gallerix2-lightbox-button-prev").on("click", function(e) {
                helper.updateURL(posts.cat, categories.cpage, posts.id, posts.cpage);
            });
            
             jQuery(glob.lightbox).find(".gallerix2-lightbox-button-close").on("click", function(e) {
                helper.updateURL(posts.cat, categories.cpage, 0, posts.cpage);
            });
            
        }
    };
    
    var helper = {
        
        updateURL: function (cat,catpage, post, postpage) {
            var url = window.location.href;
            url = helper.updateURLParameter(url, 'gcat', cat);
            url = helper.updateURLParameter(url, 'gcatpage', catpage);
            url = helper.updateURLParameter(url, 'gpost', post);
            url = helper.updateURLParameter(url, 'gpostpage', postpage);
            if (history.pushState) {
                window.history.pushState({path: url}, '', url);
            }
        },
        
        updateURLParameter: function (url, param, paramVal) {

            var TheAnchor         = null;
            var newAdditionalURL  = "";
            var tempArray         = url.split("?");
            var baseURL           = tempArray[0];
            var additionalURL     = tempArray[1];
            var temp              = "";

            if (additionalURL) {
                var tmpAnchor = additionalURL.split("#");
                var TheParams = tmpAnchor[0];
                TheAnchor = tmpAnchor[1];
                if (TheAnchor)
                    additionalURL = TheParams;

                tempArray = additionalURL.split("&");

                for (var i = 0; i < tempArray.length; i++) {
                    if (tempArray[i].split('=')[0] != param) {
                        newAdditionalURL += temp + tempArray[i];
                        temp = "&";
                    }
                }
            } else {
                var tmpAnchor = baseURL.split("#");
                var TheParams = tmpAnchor[0];
                TheAnchor = tmpAnchor[1];

                if (TheParams)
                    baseURL = TheParams;
            }

            if (TheAnchor)
                paramVal += "#" + TheAnchor;

            var rows_txt = temp + "" + param + "=" + paramVal;
            return baseURL + "?" + newAdditionalURL + rows_txt;
        },
        
        getUrlParameter: function (sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) {
                    return sParameterName[1];
                }
            }
        },
        
        afterAnimation: function(callback){
            var waitanimation = setInterval(function(){
                
                if (animator.isanimating) return;
                
                if (typeof callback === "function") {
                    callback.call();
                }
                
                clearInterval(waitanimation);
                
            }, 100);
        },
        
        windowResize: function(callback) {
            if (typeof callback !== "function")
                return;

            var wait;

            jQuery(window).on("resize", function() {
                clearTimeout(wait);
                wait = setTimeout(function() {
                    callback();
                }, 100);
            });
        }

    };

    var sunflower = {
        normalizex: 100,
        normalizey: 50,
        $el: false,
        init: function($el) {
            if (!$el)
                return;
            this.$el = $el;
            this.bindControls();
        },
        bindControls: function() {

            jQuery(window).on("mousemove", function(e) {
                var $el = sunflower.$el;

                var box = $el.first().parent();
                var xc = box.offset().left + box.width() / 2;
                var yc = box.offset().top + box.height() / 2;

                var x = Math.round((e.pageX - xc));
                var y = Math.round((e.pageY - yc));

                x = 1 * x / sunflower.normalizex;
                y = -1 * y / sunflower.normalizey;

                $el.css("transform",
                        "rotateY(" + x + "deg)   \n\
                         rotateX(" + y + "deg)   \n\
                         translateX(" + x + "px) \n\
                         translateY(" + -y + "px)");
            });

        }
    };

    var arranger = {
        space: 20,
        speed: 700,
        delay: 0,
        easing: "easeInOutExpo",
        /*
         * @close method
         * Arrange method for open category posts animations
         * Re-arranges new objects (css) and runs animation
         * Used by @animator posts.close method
         */
        close: function($li, totalDuration, animation) {
            if ($li.is(":animated"))
                return;

            $li.addClass("gallerix2-arranger-reposition");

            $li = $li.filter(":visible"); // Arrange visible blocks only

            var w = $li.first().width(),
                    h = $li.first().height(),
                    s = arranger.space,
                    l = 0,
                    c = 0,
                    o = 0,
                    max = Math.floor((jQuery(glob.instance).width() + arranger.space) / ($li.first().width() + arranger.space));

            if (max <= 0)
                max = 1;
            if (max > $li.length)
                max = $li.length;


            var _ulrepos = function() {
                jQuery($li).parent().stop().animate({
                    height: (Math.ceil($li.length / max)) * (h + s)
                }, {
                    duration: arranger.speed,
                    easing: arranger.easing
                });
            };

            var _retract = function() {
                var $cat = categories.$li.filter("[data-gallerix2-category=" + posts.cat + "]");
                posts.$li.filter(":visible").each(function(i) {
                    var th = this;
                    setTimeout(function() {
                        jQuery(th).stop().animate({
                            left: $cat.position().left,
                            top: $cat.position().top
                        }, {
                            duration: arranger.speed,
                            easing: arranger.easing
                        });
                    }, i * arranger.delay);
                });
            };

            var _complete = function() {
                setTimeout(function() {
                    animator.isanimating = false;
                    animator.cleanClass(posts.$li.filter(":visible"));
                }, totalDuration);
            };

            if (jQuery($li).parent().height() < (Math.ceil($li.length / max)) * (h + s)) {
                // OLD < NEW - expand first, animation waits
                _ulrepos();

                setTimeout(function() {
                    if (typeof animation === "function") {
                        animation.call();
                        _retract();
                        _complete();
                    }
                }, arranger.speed);
            } else

            if (jQuery($li).parent().height() > (Math.ceil($li.length / max)) * (h + s)) {
                // NEW < OLD - animation first, UL waits
                setTimeout(function() {
                    _ulrepos();
                }, totalDuration);

                if (typeof animation === "function") {
                    animation.call();
                    _retract();
                    _complete();
                }
            } else {
                // NEW = OLD - run animation
                if (typeof animation === "function") {
                    animation.call();
                    _retract();
                    _complete();
                }
            }

            o = $li.first().parent().width() / 2 - (max * (w + s) - s) / 2;

            if (o < 0)
                o = 0;

            $li.each(function(i) {
                var x = 0, y = 0;

                if (c + 1 > max) {
                    c = 0;
                    l = l + 1;
                }

                x = (w + s) * c;
                y = (h + s) * l;

                var th = this;

                jQuery(th).stop().css({
                    left: o + x,
                    top: y
                }, {
                    duration: arranger.speed,
                    easing: arranger.easing
                });

                c++;

            });

            $li.removeClass("gallerix2-arranger-reposition");
        },
        /*
         * @open method
         * Arrange method for open category posts animations
         * Re-arranges new objects (css) and runs animation
         * Used by @animator categories.open method
         */
        open: function($li, totalDuration, animation) {

            if ($li.is(":animated"))
                return;

            var w = $li.first().width(),
                    h = $li.first().height(),
                    s = arranger.space,
                    l = 0,
                    c = 0,
                    o = 0,
                    max = Math.floor((jQuery(glob.instance).width() + arranger.space) / ($li.first().width() + arranger.space));

            if (max <= 0)
                max = 1;
            if (max > $li.length)
                max = $li.length;


            var _ulrepos = function() {
                jQuery($li).parent().stop().animate({
                    height: (Math.ceil($li.length / max)) * (h + s)
                }, {
                    duration: arranger.speed,
                    easing: arranger.easing
                });
            };

            var _expand = function() {
                o = $li.first().parent().width() / 2 - (max * (w + s) - s) / 2;

                if (o < 0)
                    o = 0;

                var $cat = categories.$li.filter("[data-gallerix2-category=" + posts.cat + "]");

                $li.each(function(i) {
                    jQuery(this).css({
                        left: $cat.position().left + Math.floor(Math.random() * 15) + 1,
                        top: $cat.position().top + Math.floor(Math.random() * 15) + 1
                    });
                });

                $li.each(function(i) {
                    var x = 0, y = 0;

                    if (c + 1 > max) {
                        c = 0;
                        l = l + 1;
                    }

                    x = (w + s) * c;
                    y = (h + s) * l;

                    var th = this;

                    setTimeout(function() {
                        jQuery(th).stop().animate({
                            left: o + x,
                            top: y
                        }, {
                            duration: arranger.speed,
                            easing: arranger.easing
                        });
                    }, i * arranger.delay);

                    c++;

                });
            };

            var _complete = function() {
                setTimeout(function() {
                    animator.isanimating = false;
                    animator.cleanClass(categories.$li.filter(":visible"));
                }, totalDuration);
            };

            if (jQuery($li).parent().height() < (Math.ceil($li.length / max)) * (h + s)) {
                // OLD < NEW - expand first, animation waits
                _ulrepos();
                setTimeout(function() {
                    if (typeof animation === "function") {
                        animation.call();
                        _expand();
                        _complete();
                    }
                }, arranger.speed);
            } else

            if (jQuery($li).parent().height() > (Math.ceil($li.length / max)) * (h + s)) {
                // NEW < OLD - animation first, UL waits
                setTimeout(function() {
                    _ulrepos();
                }, totalDuration);

                if (typeof animation === "function") {
                    animation.call();
                    _expand();
                    _complete();
                }
            } else {
                // NEW = OLD - run animation
                if (typeof animation === "function") {
                    animation.call();
                    _expand();
                    _complete();
                }
            }

        },
        /*
         * @swap method
         * Arrange method for swap animations
         * Re-arranges new objects (css) and runs animation
         * Used by @animator general methods
         */
        swap: function($li, totalDuration, animation) {

            if ($li.is(":animated"))
                return;

            $li.addClass("gallerix2-arranger-reposition");

            $li = $li.filter(":visible"); // Arrange visible blocks only

            var w = $li.first().width(),
                    h = $li.first().height(),
                    s = arranger.space,
                    l = 0,
                    c = 0,
                    o = 0,
                    max = Math.floor((jQuery(glob.instance).width() + arranger.space) / ($li.first().width() + arranger.space));

            if (max <= 0)
                max = 1;
            if (max > $li.length)
                max = $li.length;


            var _ulrepos = function() {
                jQuery($li).parent().stop().animate({
                    height: (Math.ceil($li.length / max)) * (h + s)
                }, {
                    duration: arranger.speed,
                    easing: arranger.easing
                });
            };

            if (jQuery($li).parent().height() < (Math.ceil($li.length / max)) * (h + s)) {
                // OLD < NEW - expand first, animation waits
                _ulrepos();
                setTimeout(function() {
                    if (typeof animation === "function") {
                        animation.call();
                    }
                }, arranger.speed);
            } else

            if (jQuery($li).parent().height() > (Math.ceil($li.length / max)) * (h + s)) {
                // NEW < OLD - animation first, UL waits
                setTimeout(function() {
                    _ulrepos();
                }, totalDuration);

                if (typeof animation === "function") {
                    animation.call();
                }
            } else {
                // NEW = OLD - run animation
                if (typeof animation === "function") {
                    animation.call();
                }
            }

            o = $li.first().parent().width() / 2 - (max * (w + s) - s) / 2;

            if (o < 0)
                o = 0;

            $li.each(function(i) {
                var x = 0, y = 0;

                if (c + 1 > max) {
                    c = 0;
                    l = l + 1;
                }

                x = (w + s) * c;
                y = (h + s) * l;

                var th = this;

                jQuery(th).stop().css({
                    left: o + x,
                    top: y
                }, {
                    duration: arranger.speed,
                    easing: arranger.easing
                });

                c++;

            });

            $li.removeClass("gallerix2-arranger-reposition");
        },
        /*
         * @arrange method
         * Re-arranges current visible objects (animation) 
         * Used by @window.resize
         */
        arrange: function($li) {
            if (animator.isanimating === true) return;

            $li = $li.filter(":visible"); // Arrange visible blocks only

            var w = $li.first().width(),
                    h = $li.first().height(),
                    s = arranger.space,
                    l = 0,
                    c = 0,
                    o = 0,
                    max = Math.floor((jQuery(glob.instance).width() + arranger.space) / ($li.first().width() + arranger.space));

            if (max <= 0)
                max = 1;
            if (max > $li.length)
                max = $li.length;

            jQuery($li).parent().stop().animate({
                height: (Math.ceil($li.length / max)) * (h + s)
            }, {
                duration: arranger.speed,
                easing: arranger.easing
            });

            o = $li.first().parent().width() / 2 - (max * (w + s) - s) / 2;

            if (o < 0)
                o = 0;

            $li.each(function(i) {
                var x = 0, y = 0;

                if (c + 1 > max) {
                    c = 0;
                    l = l + 1;
                }

                x = (w + s) * c;
                y = (h + s) * l;

                var th = this;

                setTimeout(function() {
                    jQuery(th).stop().animate({
                        left: o + x,
                        top: y
                    }, {
                        duration: arranger.speed,
                        easing: arranger.easing
                    });
                }, i * arranger.delay);

                c++;

            });
        }
    };

    var animator = {
        isanimating: false,
        direction: "forward",
        cleanClass: function($el) {
            // Clear animation classes from objects
            var classes = new Array(
                    "gallerix2-animation-fadeNew",
                    "gallerix2-animation-fadeOld",
                    "gallerix2-animation-zoomNew",
                    "gallerix2-animation-zoomOld",
                    "gallerix2-animation-jumpNew",
                    "gallerix2-animation-jumpOld",
                    "gallerix2-animation-flipxNew",
                    "gallerix2-animation-flipxOld",
                    "gallerix2-animation-flipyNew",
                    "gallerix2-animation-flipyOld",
                    "gallerix2-animation-popNew",
                    "gallerix2-animation-popOld",
                    "gallerix2-animation-aroundNew",
                    "gallerix2-animation-aroundOld",
                    "gallerix2-animation-ontopNew",
                    "gallerix2-animation-ontopOld",
                    "gallerix2-animation-suckinNew",
                    "gallerix2-animation-suckinOld",
                    "gallerix2-animation-rotatecornerNew",
                    "gallerix2-animation-rotatecornerOld",
                    "gallerix2-animation-expandfadeNew",
                    "gallerix2-animation-expandfadeOld",
                    "gallerix2-animation-retractfadeNew",
                    "gallerix2-animation-retractfadeOld",
                    "gallerix2-animation-translateCenterToLeft",
                    "gallerix2-animation-translateRightToCenter",
                    "gallerix2-animation-translateCenterToRight",
                    "gallerix2-animation-translateLeftToCenter"
                    );

            classes = classes.join(" ");

            $el.removeClass(classes);
        },
        /*
         * Category Open/Close specific animations 
         */

        category: {
            close: {
                faderetract: function($old, $new) {
                    animator.isanimating = true;

                    var animationDuration = 700;
                    var elementDelay = 0;
                    var lilength = $new.length > $old.length ? $new.length : $old.length;
                    var totalDuration = lilength * elementDelay + animationDuration;
                    
                    var animation = function() {
                        animator.cleanClass($old);
                        animator.cleanClass($new);
                        $old.addClass("gallerix2-animation-retractfadeOld");
                        $new.addClass("gallerix2-animation-retractfadeNew");
                    };

                    // arranger.close
                    arranger.close($new, totalDuration, animation);
                }
            },
            open: {
                fadeexpand: function($old, $new) {
                    animator.isanimating = true;

                    var animationDuration = 700;
                    var elementDelay = 0;
                    var lilength = $new.length > $old.length ? $new.length : $old.length;
                    var totalDuration = lilength * elementDelay + animationDuration;
                    
                    var animation = function() {
                        animator.cleanClass($old);
                        animator.cleanClass($new);
                        $old.addClass("gallerix2-animation-expandfadeOld");
                        $new.addClass("gallerix2-animation-expandfadeNew");
                    };

                    // arranger.open 
                    arranger.open($new, totalDuration, animation);
                }
            }
        },
        /*
         * Lightbox Swap Animations
         * Uses @lightbox.swap method
         */

        lightbox: {
            translateCenterToLeft: function() {
                animator.isanimating = true;
                jQuery("body").addClass("gallerix2-no-horizontal-scroll");
                var $wrapper = jQuery(glob.lightbox);
                animator.cleanClass($wrapper);
                $wrapper.addClass("gallerix2-animation-translateCenterToLeft");

            },
            translateRightToCenter: function() {
                var $wrapper = jQuery(glob.lightbox);
                animator.cleanClass($wrapper);
                $wrapper.addClass("gallerix2-animation-translateRightToCenter");

                setTimeout(function() {
                    animator.cleanClass($wrapper);
                    jQuery("body").removeClass("gallerix2-no-horizontal-scroll");
                    animator.isanimating = false;
                    lightbox.updateSocials();
                    if (glob.params.disqus == "1") {
                        lightbox.disqus.loadComments();
                    }
                }, 700);
            },
            translateCenterToRight: function() {
                animator.isanimating = true;
                jQuery("body").addClass("gallerix2-no-horizontal-scroll");
                var $wrapper = jQuery(glob.lightbox);
                animator.cleanClass($wrapper);
                $wrapper.addClass("gallerix2-animation-translateCenterToRight");
            },
            translateLeftToCenter: function() {
                var $wrapper = jQuery(glob.lightbox);
                animator.cleanClass($wrapper);
                $wrapper.addClass("gallerix2-animation-translateLeftToCenter");

                setTimeout(function() {
                    animator.isanimating = false;
                    animator.cleanClass($wrapper);
                    jQuery("body").removeClass("gallerix2-no-horizontal-scroll");
                    lightbox.updateSocials();
                    if (glob.params.disqus == "1") {
                        lightbox.disqus.loadComments();
                    }
                }, 700);
            }

        },
        /*
         * General Swap Animations
         * Uses @arranger.swap method
         */

        general: {
            fade: function($old, $new) {

                animator.isanimating = true;

                var animationDuration = 500;
                var elementDelay = 150;
                var lilength = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration = lilength * elementDelay + animationDuration;
                
                var animation = function() {

                    if (animator.direction != "forward") {
                        $old = jQuery($old.get().reverse());
                        $new = jQuery($new.get().reverse());
                    }

                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-fadeOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-fadeNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.isanimating = false;
                        animator.cleanClass($old);
                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);

            },
            zoom: function($old, $new) {

                animator.isanimating = true;

                jQuery("body").addClass("gallerix2-no-horizontal-scroll");

                var animationDuration = 500;
                var elementDelay = 150;
                var lilength = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration = lilength * elementDelay + animationDuration;
                
                var animation = function() {

                    if (animator.direction != "forward") {
                        $old = jQuery($old.get().reverse());
                        $new = jQuery($new.get().reverse());
                    }

                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-zoomOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-zoomNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.cleanClass($old);
                        animator.isanimating = false;
                        jQuery("body").removeClass("gallerix2-no-horizontal-scroll");

                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);
            },
            jump: function($old, $new) {

                animator.isanimating = true;

                jQuery("body").addClass("gallerix2-no-horizontal-scroll");

                var animationDuration = 500;
                var animationDelay    = 500;
                var elementDelay      = 50;
                var lilength          = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration     = lilength * elementDelay + animationDuration + animationDelay;
                
                var animation = function() {

                    if (animator.direction != "forward") {
                        $old = jQuery($old.get().reverse());
                        $new = jQuery($new.get().reverse());
                    }

                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-jumpOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-jumpNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.cleanClass($old);
                        animator.isanimating = false;
                        jQuery("body").removeClass("gallerix2-no-horizontal-scroll");

                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);
            },
            flipx: function($old, $new) {

                animator.isanimating = true;

                jQuery("body").addClass("gallerix2-no-horizontal-scroll");

                var animationDuration = 600;
                var animationDelay = 0;
                var elementDelay = 75;
                var lilength = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration = lilength * elementDelay + animationDuration + animationDelay;
                
                var animation = function() {

                    if (animator.direction != "forward") {
                        $old = jQuery($old.get().reverse());
                        $new = jQuery($new.get().reverse());
                    }

                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-flipxOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-flipxNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.cleanClass($old);
                        animator.isanimating = false;
                        jQuery("body").removeClass("gallerix2-no-horizontal-scroll");

                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);
            },
            flipy: function($old, $new) {

                animator.isanimating = true;

                jQuery("body").addClass("gallerix2-no-horizontal-scroll");

                var animationDuration = 600;
                var animationDelay = 0;
                var elementDelay = 175;
                var lilength = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration = lilength * elementDelay + animationDuration + animationDelay;
                
                var animation = function() {

                    if (animator.direction != "forward") {
                        $old = jQuery($old.get().reverse());
                        $new = jQuery($new.get().reverse());
                    }

                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-flipyOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-flipyNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.cleanClass($old);
                        animator.isanimating = false;
                        jQuery("body").removeClass("gallerix2-no-horizontal-scroll");

                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);
            },
            pop: function($old, $new) {

                animator.isanimating = true;

                jQuery("body").addClass("gallerix2-no-horizontal-scroll");

                var animationDuration = 700;
                var animationDelay = 600;
                var elementDelay = 75;
                var lilength = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration = lilength * elementDelay + animationDuration + animationDelay;

                var animation = function() {

                    if (animator.direction != "forward") {
                        $old = jQuery($old.get().reverse());
                        $new = jQuery($new.get().reverse());
                    }

                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-popOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-popNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.cleanClass($old);
                        animator.isanimating = false;
                        jQuery("body").removeClass("gallerix2-no-horizontal-scroll");

                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);
            },
            around: function($old, $new) {

                animator.isanimating = true;

                jQuery("body").addClass("gallerix2-no-horizontal-scroll");

                var animationDuration = 700;
                var animationDelay = 350;
                var elementDelay = 175;
                var lilength = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration = lilength * elementDelay + animationDuration + animationDelay;
                
                var animation = function() {
                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-aroundOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-aroundNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.cleanClass($old);
                        animator.isanimating = false;
                        jQuery("body").removeClass("gallerix2-no-horizontal-scroll");

                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);
            },
            ontop: function($old, $new) {

                animator.isanimating = true;

                jQuery("body").addClass("gallerix2-no-horizontal-scroll");

                var animationDuration = 700;
                var animationDelay = 0;
                var elementDelay = 0;
                var lilength = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration = lilength * elementDelay + animationDuration + animationDelay;
                
                var animation = function() {
                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-ontopOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-ontopNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.cleanClass($old);
                        animator.isanimating = false;
                        jQuery("body").removeClass("gallerix2-no-horizontal-scroll");

                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);
            },
            suckin: function($old, $new) {

                animator.isanimating = true;

                jQuery("body").addClass("gallerix2-no-horizontal-scroll");

                var animationDuration = 700;
                var animationDelay = 0;
                var elementDelay = 75;
                var lilength = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration = lilength * elementDelay + animationDuration + animationDelay;
                
                var animation = function() {

                    if (animator.direction != "forward") {
                        $old = jQuery($old.get().reverse());
                        $new = jQuery($new.get().reverse());
                    }

                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-suckinOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-suckinNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.cleanClass($old);
                        animator.isanimating = false;
                        jQuery("body").removeClass("gallerix2-no-horizontal-scroll");

                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);
            },
            rotatecorner: function($old, $new) {

                animator.isanimating = true;

                jQuery("body").addClass("gallerix2-no-horizontal-scroll");

                var animationDuration = 700;
                var animationDelay = 0;
                var elementDelay = 175;
                var lilength = $new.length > $old.length ? $new.length : $old.length;
                var totalDuration = lilength * elementDelay + animationDuration + animationDelay;
                
                var animation = function() {

                    if (animator.direction != "forward") {
                        $old = jQuery($old.get().reverse());
                        $new = jQuery($new.get().reverse());
                    }

                    $old.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-rotatecornerOld");
                        }, i * elementDelay);
                    });

                    $new.each(function(i) {
                        var th = this;
                        setTimeout(function() {
                            animator.cleanClass(jQuery(th));
                            jQuery(th).addClass("gallerix2-animation-rotatecornerNew");
                        }, i * elementDelay);
                    });

                    setTimeout(function() {
                        animator.cleanClass($old);
                        animator.isanimating = false;
                        jQuery("body").removeClass("gallerix2-no-horizontal-scroll");

                    }, totalDuration);
                };

                arranger.swap($new, totalDuration, animation);
            }
        }
    };

    var categories = {
        totalpages: 0,
        perpage: 8,
        cpage: 1,
        $li: "",
        animation: "random",
        init: function() {
            
            categories.perpage   = glob.params.catperpage;
            categories.animation = glob.params.swapanimation;
            
            this.$li = jQuery(glob.instance).find(".gallerix2-category");
            this.totalpages = Math.ceil(this.$li.length / this.perpage);

            this.swap();

            this.bindControls();
        },
        bindControls: function() {
            helper.windowResize(function() {
                arranger.arrange(categories.$li);
            });

            categories.$li.on("touchstart", function(e) {
                e.preventDefault();
                jQuery(this).trigger("click");
            });

            categories.$li.on("click", function(e) {
                if (animator.isanimating === true) return;
                var id = jQuery(this).attr("data-gallerix2-category");
                categories.open(id);
            });

            jQuery(glob.instance).find(".gallerix2-category-button-close").on("touchstart", function(e) {
                e.preventDefault();
                jQuery(this).trigger("click");
            });
            
            jQuery(glob.instance).find(".gallerix2-category-button-close").on("click", function() {
                if (animator.isanimating === true) return;
                categories.close();
            });
        },
        close: function() {
            jQuery(glob.instance).find(".gallerix2-breadcrumbs").text("");
            jQuery(glob.instance).find(".gallerix2-category-button-close").hide();

            var $old = posts.$li.filter(":visible");
            var $new = categories.$li.filter("[data-gallerix2-category-page=" + categories.cpage + "]");

            animator.category.close.faderetract($old, $new);

            posts.cpage = 1;

            pagination.setToCategory();
        },
        open: function(id) {
            var title = categories.$li.filter("[data-gallerix2-category=" + id + "]").find(".gallerix2-category-title").text();
            jQuery(glob.instance).find(".gallerix2-breadcrumbs").text(" / " + title);
            jQuery(glob.instance).find(".gallerix2-category-button-close").show();

            posts.cpage = 1;

            posts.cat = id;

            var $old = categories.$li.filter(":visible");
            var $new = posts.$li.filter("[data-gallerix2-post-category=" + posts.cat + "][data-gallerix2-post-page=" + posts.cpage + "]");
            var $total = posts.$li.filter("[data-gallerix2-post-category=" + posts.cat + "]");

            posts.totalpages = Math.ceil($total.length / posts.perpage);

            animator.category.open.fadeexpand($old, $new);

            pagination.setToPage();

        },
        /*
         * Uses @animator.general methods
         */
        swap: function(direction) {

            var $new = categories.$li.filter("[data-gallerix2-category-page=" + this.cpage + "]");
            var $old = categories.$li.not("[data-gallerix2-category-page=" + this.cpage + "]").filter(":visible");

            animator.direction = direction ? direction : "forward";

            switch (categories.animation) {

                case "random":

                    var animationArray = new Array(
                            "zoom",
                            "scale",
                            "jump",
                            "flipx",
                            "flipy",
                            "pop",
                            "around",
                            "ontop",
                            "suckin",
                            "rotatecorner"
                            );

                    categories.animation = animationArray[Math.floor(Math.random() * animationArray.length)];
                    categories.swap(animator.direction);
                    categories.animation = "random";

                    break;

                case "zoom" :
                    animator.general.zoom($old, $new);
                    break;

                case "jump" :
                    animator.general.jump($old, $new);
                    break;

                case "flipx" :
                    animator.general.flipx($old, $new);
                    break;

                case "flipy" :
                    animator.general.flipy($old, $new);
                    break;

                case "pop" :
                    animator.general.pop($old, $new);
                    break;

                case "around" :
                    animator.general.around($old, $new);
                    break;

                case "ontop" :
                    animator.general.ontop($old, $new);
                    break;

                case "suckin" :
                    animator.general.suckin($old, $new);
                    break;

                case "rotatecorner" :
                    animator.general.rotatecorner($old, $new);
                    break;

                case "fade" :
                default:
                    animator.general.fade($old, $new);
            }

        }
    };

    var posts = {
        totalpages: 0,
        perpage: 8,
        cpage: 1,
        cat: 0,
        id: 0,
        $li: "",
        animation: "random",
        init: function() {
            posts.perpage = glob.params.postperpage;
            posts.animation = glob.params.swapanimation;
            this.$li = jQuery(glob.instance).find(".gallerix2-post");
            this.bindControls();
        },
        bindControls: function() {

            helper.windowResize(function() {
                arranger.arrange(posts.$li);
            });

            posts.$li.on("touchstart", function(e) {
                e.preventDefault();
                jQuery(this).trigger("click");
            });
            
            posts.$li.on("click", function() {
                posts.id = jQuery(this).attr("data-gallerix2-post");
                lightbox.open();

                if (!cookies.exists("gallerix2-post-id-" + posts.id + "-viewed")) {
                    ajax.post.viewed();
                }

            });
        },
        /*
         * Uses @animator.general methods
         */
        swap: function(direction) {

            var $old = posts.$li.filter(":visible");
            var $new = posts.$li.filter("[data-gallerix2-post-category=" + posts.cat + "][data-gallerix2-post-page=" + posts.cpage + "]");

            animator.direction = direction ? direction : "forward";

            switch (posts.animation) {

                case "random":

                    var animationArray = new Array(
                            "zoom",
                            "scale",
                            "jump",
                            "flipx",
                            "flipy",
                            "pop",
                            "around",
                            "ontop",
                            "suckin",
                            "rotatecorner"
                            );

                    posts.animation = animationArray[Math.floor(Math.random() * animationArray.length)];
                    posts.swap(animator.direction);
                    posts.animation = "random";

                    break;

                case "zoom" :
                    animator.general.zoom($old, $new);
                    break;

                case "jump" :
                    animator.general.jump($old, $new);
                    break;

                case "flipx" :
                    animator.general.flipx($old, $new);
                    break;

                case "flipy" :
                    animator.general.flipy($old, $new);
                    break;

                case "pop" :
                    animator.general.pop($old, $new);
                    break;

                case "around" :
                    animator.general.around($old, $new);
                    break;

                case "ontop" :
                    animator.general.ontop($old, $new);
                    break;

                case "suckin" :
                    animator.general.suckin($old, $new);
                    break;

                case "rotatecorner" :
                    animator.general.rotatecorner($old, $new);
                    break;

                case "fade" :
                default:
                    animator.general.fade($old, $new);
            }

        }

    };

    var pagination = {
        categoryBrowsing: true,
        init: function() {

            this.bindControls();

            jQuery(glob.instance).find(".gallerix2-page-control-prev, .gallerix2-page-control-next").hide();

            if (categories.totalpages > 1) {
                jQuery(glob.instance).find(".gallerix2-page-control-next").show();
            }
        },
        recheck: function() {

            switch (pagination.categoryBrowsing) {
                case true :

                    if (categories.totalpages > 1 && categories.cpage < categories.totalpages) {
                        jQuery(glob.instance).find(".gallerix2-page-control-next").fadeIn();
                    } else {
                        jQuery(glob.instance).find(".gallerix2-page-control-next").fadeOut();
                    }

                    if (categories.totalpages > 1 && categories.cpage > 1) {
                        jQuery(glob.instance).find(".gallerix2-page-control-prev").fadeIn();
                    } else {
                        jQuery(glob.instance).find(".gallerix2-page-control-prev").fadeOut();
                    }

                    break;

                case false:

                    if (posts.totalpages > 1 && posts.cpage < posts.totalpages) {
                        jQuery(glob.instance).find(".gallerix2-page-control-next").fadeIn();
                    } else {
                        jQuery(glob.instance).find(".gallerix2-page-control-next").fadeOut();
                    }

                    if (posts.totalpages > 1 && posts.cpage > 1) {
                        jQuery(glob.instance).find(".gallerix2-page-control-prev").fadeIn();
                    } else {
                        jQuery(glob.instance).find(".gallerix2-page-control-prev").fadeOut();
                    }
                    break;
            }


        },
        bindControls: function() {

            // Key events

            jQuery(document).on("keydown", function(e) {
                switch (e.which) {
                    case 37:
                        e.preventDefault();
                        jQuery(glob.instance).find(".gallerix2-page-control-prev").trigger("click");
                        break;

                    case 39:
                        e.preventDefault();
                        jQuery(glob.instance).find(".gallerix2-page-control-next").trigger("click");
                        break;
                }
            });

            // Touch events

            jQuery(glob.instance).find(".gallerix2-page-control-next").on("touchstart", function(e) {
                e.preventDefault();
                jQuery(glob.instance).find(".gallerix2-page-control-next").trigger("click");
            });

            jQuery(glob.instance).find(".gallerix2-page-control-prev").on("touchstart", function(e) {
                e.preventDefault();
                jQuery(glob.instance).find(".gallerix2-page-control-prev").trigger("click");
            });

            // Click events 

            jQuery(glob.instance).find(".gallerix2-page-control-next").on("click", function() {

                if (animator.isanimating === true) return;

                if (pagination.categoryBrowsing === true) {
                    if (categories.cpage + 1 > categories.totalpages) return;

                    categories.cpage = categories.cpage + 1;

                    if (categories.cpage >= categories.totalpages) {
                        jQuery(this).fadeOut();
                    }

                    if (categories.totalpages > 1) {
                        jQuery(glob.instance).find(".gallerix2-page-control-prev").fadeIn();
                    }

                    categories.swap("forward");
                }

                if (pagination.categoryBrowsing === false) {
                    if (posts.cpage + 1 > posts.totalpages)
                        return;

                    posts.cpage = posts.cpage + 1;

                    if (posts.cpage >= posts.totalpages) {
                        jQuery(this).fadeOut();
                    }

                    if (posts.totalpages > 1) {
                        jQuery(glob.instance).find(".gallerix2-page-control-prev").fadeIn();
                    }

                    posts.swap("forward");
                }


            });

            jQuery(glob.instance).find(".gallerix2-page-control-prev").on("click", function() {

                if (animator.isanimating === true) return;

                if (pagination.categoryBrowsing === true) {
                    if (categories.cpage - 1 <= 0)
                        return;

                    categories.cpage = categories.cpage - 1;

                    if (categories.cpage <= 1) {
                        jQuery(this).fadeOut();
                    }

                    if (categories.totalpages > 1) {
                        jQuery(glob.instance).find(".gallerix2-page-control-next").fadeIn();
                    }

                    categories.swap("backward");
                }

                if (pagination.categoryBrowsing === false) {
                    if (posts.cpage - 1 <= 0)
                        return;

                    posts.cpage = posts.cpage - 1;

                    if (posts.cpage <= 1) {
                        jQuery(this).fadeOut();
                    }

                    if (posts.totalpages > 1) {
                        jQuery(glob.instance).find(".gallerix2-page-control-next").fadeIn();
                    }

                    posts.swap("backward");
                }

            });
        },
        setToPage: function() {
            this.categoryBrowsing = false;
            this.recheck();
        },
        setToCategory: function() {
            this.categoryBrowsing = true;
            this.recheck();
        }
    };

    var lightbox = {
        init: function() {
            this.bindControls();
            
            if (glob.params.disqus == "1") {
                lightbox.disqus.loadCommentsCount();
            }
        },
          
        disqus: {
        
            loadCommentsCount: function() {
                window.disqus_shortname = glob.params.disqussite;

                jQuery.ajax({
                    type: "GET",
                    url: "//" + disqus_shortname + ".disqus.com/count.js",
                    dataType: "script",
                    cache: true
                });
            },
            
            loadComments: function() {
                jQuery('<div id="disqus_thread"></div>').appendTo(jQuery(glob.lightbox).find(".gallerix2-post-comments"));

                window.disqus_shortname   = glob.params.disqussite;
                window.disqus_url         = window.location.href + "#!Gallerix2PostDiscussion" + posts.id;
                window.disqus_identifier  = "Gallerix2PostID" + posts.id;
                window.disqus_title       = jQuery(glob.lightbox).find(".gallerix2-lightbox-post-title").text();

                if (typeof DISQUS === "undefined") {
                    jQuery.ajax({
                        type: "GET",
                        url: "//" + disqus_shortname + ".disqus.com/embed.js",
                        dataType: "script",
                        cache: true
                    });
                } else {
                    DISQUS.reset({
                        reload: true
                    });
                }
            }
        },
        
        
        positionControls: function(reset) {
            
            if (reset) {
                jQuery(glob.lightbox).find(".gallerix2-lightbox-side-control").css({
                    top: 0
                });

                return;
            }
            
            if (jQuery(glob.lightbox).is(":visible")) {

                var scroll = jQuery(document).scrollTop() + jQuery("#wpadminbar").height();

                var max = scroll
                        - jQuery(glob.lightbox).position().top;

                var min = jQuery(glob.lightbox).position().top + jQuery(glob.lightbox).height()
                        - jQuery(glob.lightbox).find(".gallerix2-lightbox-side-control").height();


                // Do not allow control to go above top (glue to top)
                if (max < 0) {
                    jQuery(glob.lightbox).find(".gallerix2-lightbox-side-control").css({
                        top: 0
                    });
                }

                // During scroll controls should be visible (glued to top position of the screen)
                if (max > 0 && scroll < min) {
                    jQuery(glob.lightbox).find(".gallerix2-lightbox-side-control").css({
                        top: max
                    });
                }
                
                // Do not allow controls to go below lightbox (glue to bottom)
                if (scroll > min) {
                    jQuery(glob.lightbox).find(".gallerix2-lightbox-side-control").css({
                        bottom: 0
                    });
                }

                
            }
        },
        
        bindControls: function() {
            
            jQuery(document).on("touchstart", glob.lightbox + " .gallerix2-post-media-control-next", function(e){
                e.preventDefault();
                jQuery(this).trigger("click");
            });
            jQuery(document).on("touchstart", glob.lightbox + " .gallerix2-post-media-control-prev", function(e){
                e.preventDefault();
                jQuery(this).trigger("click");
            });
            
            jQuery(document).on("click", glob.lightbox + " .gallerix2-post-media-control-next", function(){
                lightbox.mediaswap("next");
            });
            jQuery(document).on("click", glob.lightbox + " .gallerix2-post-media-control-prev", function(){
                lightbox.mediaswap("prev");
            });
            
            jQuery(document).on("scroll", function(e) {
                lightbox.positionControls();
            });
            
            jQuery(document).on("click", glob.lightbox + " .gallerix2-comments-load-more-button", function(e) {
                ajax.comment.loadMore();
            });

            jQuery(document).on("click", glob.lightbox + " .gallerix2-lightbox-button-like", function(e) {
                if (!cookies.exists("gallerix2-post-id-" + posts.id + "-liked")) {
                    ajax.post.liked();
                    jQuery(this).addClass("liked");
                }
            });

            jQuery(document).on("click", glob.lightbox + " .gallerix2-form-button-submit", function(e) {
                lightbox.comment.submit();
            });

            jQuery(document).on("click", glob.lightbox + " .galleri2-post-comment-reply", function(e) {
                e.preventDefault();
                jQuery(glob.lightbox).find(".galleri2-post-comment-reply").show();
                jQuery(this).hide();
                jQuery(this).after(jQuery(glob.lightbox).find(".gallerix2-comment-form"));
                jQuery(glob.lightbox).find(".gallerix2-leave-comment-cancel").show();

                var commentid = jQuery(this).parent().attr("data-gallerix2-comment-id");
                jQuery(glob.lightbox).find(".gallerix2-comment-form").attr("data-gallerix-comment-form-reply-to", commentid);

            });

            jQuery(document).on("click", glob.lightbox + " .gallerix2-leave-comment-cancel", function(e) {
                e.preventDefault();
                jQuery(glob.lightbox).find(".galleri2-post-comment-reply").show();
                jQuery(glob.lightbox).find(".gallerix2-lightbox-button-like").before(jQuery(glob.lightbox).find(".gallerix2-comment-form"));
                jQuery(glob.lightbox).find(".gallerix2-leave-comment-cancel").hide();
                jQuery(glob.lightbox).find(".gallerix2-comment-form").attr("data-gallerix-comment-form-reply-to", "0");
            });




            // Touch events

            jQuery(glob.lightbox).find(".gallerix2-lightbox-button-next").on("touchstart", function(e) {
                e.preventDefault();
                jQuery(glob.lightbox).find(".gallerix2-lightbox-button-next").trigger("click");
            });

            jQuery(glob.lightbox).find(".gallerix2-lightbox-button-prev").on("touchstart", function(e) {
                e.preventDefault();
                jQuery(glob.lightbox).find(".gallerix2-lightbox-button-prev").trigger("click");
            });

            // keydown events

            jQuery(document).on("keydown", function(e) {

                if (!jQuery(glob.lightbox).is(":visible"))
                    return;

                switch (e.which) {
                    case 37:
                        e.preventDefault();
                        jQuery(glob.lightbox).find(".gallerix2-lightbox-button-prev").trigger("click");
                        break;

                    case 39:
                        e.preventDefault();
                        jQuery(glob.lightbox).find(".gallerix2-lightbox-button-next").trigger("click");
                        break;
                }
            });

            jQuery(glob.blackbox).on("click", function() {
                lightbox.close();
            });

            jQuery(glob.lightbox).find(".gallerix2-lightbox-button-close").on("click", function(e) {
                lightbox.close();
            });

            jQuery(glob.lightbox).find(".gallerix2-lightbox-button-next").on("click", function() {
                if (animator.isanimating === true)
                    return;
                var $old = jQuery(glob.instance).find("[data-gallerix2-post-category=" + posts.cat + "][data-gallerix2-post=" + posts.id + "]");
                var $new = $old.next().filter("[data-gallerix2-post-category=" + posts.cat + "]");
                if ($new.length > 0) {
                    posts.id = $new.attr("data-gallerix2-post");
                    lightbox.swap("forward");
                }
            });

            jQuery(glob.lightbox).find(".gallerix2-lightbox-button-prev").on("click", function() {
                if (animator.isanimating === true)
                    return;
                var $old = jQuery(glob.instance).find("[data-gallerix2-post-category=" + posts.cat + "][data-gallerix2-post=" + posts.id + "]");
                var $prev = $old.prev().filter("[data-gallerix2-post-category=" + posts.cat + "]");
                if ($prev.length > 0) {
                    posts.id = $prev.attr("data-gallerix2-post");
                    lightbox.swap("backward");
                }
            });
        },
        swap: function(direction) {

            animator.direction = direction;

            var html = jQuery(glob.instance).find("[data-gallerix2-post-category=" + posts.cat + "][data-gallerix2-post=" + posts.id + "]").find(".gallerix2-post-data").html();

            var $wrapper = jQuery(glob.lightbox).find(".gallerix2-lightbox-post-wrapper");
            var translateDelay = 700;

            jQuery("body").addClass("gallerix2-no-horizontal-scroll");

            if (animator.direction == "forward") {
                animator.lightbox.translateCenterToLeft();
                setTimeout(function() {
                    lightbox.positionControls(true);
                    jQuery(glob.instance).find(".gallerix2-lightbox-preloader").show();
                    $wrapper.empty();
                    jQuery(html).appendTo($wrapper);
                    
                    var imagesrc = jQuery(glob.lightbox).find(".gallerix2-post-image:first").attr("data-gallerix2-post-image-src");
                    jQuery(glob.lightbox).find(".gallerix2-post-image:first").attr("src", imagesrc);
                    
                    $wrapper.find("img").imagesLoaded(function() {
                        jQuery(glob.instance).find(".gallerix2-lightbox-preloader").hide();
                        
                        jQuery(glob.lightbox).css({
                            top: jQuery(document).scrollTop() + jQuery("#wpadminbar").height() + 10
                        });
                        
                        animator.lightbox.translateRightToCenter();
                    });
                }, translateDelay);
            } else {
                animator.lightbox.translateCenterToRight();
                setTimeout(function() {
                    lightbox.positionControls(true);
                    jQuery(glob.instance).find(".gallerix2-lightbox-preloader").show();
                    $wrapper.empty();
                    jQuery(html).appendTo($wrapper);
                    
                    var imagesrc = jQuery(glob.lightbox).find(".gallerix2-post-image:first").attr("data-gallerix2-post-image-src");
                    jQuery(glob.lightbox).find(".gallerix2-post-image:first").attr("src", imagesrc);
                    
                    $wrapper.find("img").imagesLoaded(function() {
                        jQuery(glob.instance).find(".gallerix2-lightbox-preloader").hide();
                        
                        jQuery(glob.lightbox).css({
                            top: jQuery(document).scrollTop() + jQuery("#wpadminbar").height() + 10
                        });
                        
                        animator.lightbox.translateLeftToCenter();
                    });
                }, translateDelay);
            }
            
            if (!cookies.exists("gallerix2-post-id-" + posts.id + "-viewed")) {
                ajax.post.viewed();
            }
           
        },
        
        mediaswap: function (direction) {
            
            var current = jQuery(glob.lightbox).find(".gallerix2-post-media-images img").filter(":visible");
            
            if (direction == "next") {
                var image = current.next();
                
                if (image.length <= 0) {
                    image = current.siblings().first();
                }
            }
            
            if (direction == "prev") {
                var image = current.prev();
                
                if (image.length <= 0) {
                    image = current.siblings().last();
                }
            }
            
            var imagesrc = image.attr("data-gallerix2-post-image-src");
                image.attr("src", imagesrc);
                
                    
                current.fadeOut(250, function() {
                    
                    image.css({
                       display: "block",
                       visibility:"hidden"
                    });
                    
                    jQuery(image).imagesLoaded(function() {
                        current.hide();
                        image.fadeTo(0,0).css({
                            visibility:"visible"
                        }).fadeTo(250, 1);
                        
                        lightbox.updateSocials();
                    });
                });
                    
        },
        
        updateSocials: function(){
            
            var url = encodeURIComponent(window.location.href);
            var img = jQuery(glob.lightbox).find(".gallerix2-post-image").filter(":visible").attr("src");
            
            var fb = "http://www.facebook.com/sharer/sharer.php?u=" + url;            
            jQuery(glob.lightbox).find(".gallerix2-lightbox-social-facebook").attr("href", fb);
            
            var tw = "http://twitter.com/home?status=" + url;
            jQuery(glob.lightbox).find(".gallerix2-lightbox-social-twitter").attr("href", tw);
            
            var pin = "http://www.pinterest.com/pin/create/button/?url="+url+"&amp;media="+img+"&amp;description="+url;
            jQuery(glob.lightbox).find(".gallerix2-lightbox-social-pinterest").attr("href", pin);
            
            var gp = "https://plus.google.com/share?url=" + url;
            jQuery(glob.lightbox).find(".gallerix2-lightbox-social-googleplus").attr("href", gp);
            
        },
        
        open: function() {
            var html = jQuery(glob.instance).find("[data-gallerix2-post-category=" + posts.cat + "][data-gallerix2-post=" + posts.id + "]").find(".gallerix2-post-data").html();
            
            if (!html)
                return;
            
            lightbox.positionControls(true);
            
            jQuery(glob.blackbox).appendTo("body");
            jQuery(glob.lightbox).appendTo("body");
            
            jQuery(glob.blackbox).show();
            
            jQuery(glob.instance).find(".gallerix2-lightbox-preloader").show();

            jQuery(html).appendTo(jQuery(glob.lightbox).find(".gallerix2-lightbox-post-wrapper"));
            
            var imagesrc = jQuery(glob.lightbox).find(".gallerix2-post-image:first").attr("data-gallerix2-post-image-src");
            jQuery(glob.lightbox).find(".gallerix2-post-image:first").attr("src", imagesrc);
            
            jQuery(glob.lightbox).find("img").imagesLoaded(function() {
                
                jQuery(glob.instance).find(".gallerix2-lightbox-preloader").hide();

                if (jQuery(glob.blackbox).is(":visible")) {
                    jQuery(glob.lightbox).css({
                        top: jQuery(document).scrollTop() + jQuery("#wpadminbar").height() + 10
                    }).fadeIn();
                }
            });
            
            lightbox.updateSocials();
            
            if (glob.params.disqus == "1") {
                lightbox.disqus.loadComments();
            }
            
        },
        close: function() {
            jQuery(glob.lightbox).find(".gallerix2-lightbox-post-wrapper").empty();
            jQuery(glob.blackbox).hide();
            jQuery(glob.lightbox).hide();
            
            jQuery(glob.blackbox).appendTo(jQuery(glob.instance));
            jQuery(glob.lightbox).appendTo(jQuery(glob.instance));

            //var $el = jQuery(glob.instance).find("[data-gallerix2-post-category=" + posts.cat + "][data-gallerix2-post=" + posts.id + "]");

            var $el = jQuery(glob.instance);

            jQuery('html, body').animate({
                scrollTop: jQuery($el).offset().top - jQuery("#wpadminbar").height() - 10
            }, {
                duration: 750,
                easing: "easeInOutExpo"
            });

        },
        comment: {
            isValidUrlAddress: function(URL) {
                var pattern = new RegExp(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i);
                return pattern.test(URL);
            },
            isValidEmailAddress: function(emailAddress) {
                var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
                return pattern.test(emailAddress);
            },
            submit: function() {

                var $form = jQuery(glob.lightbox).find(".gallerix2-comment-form");

                var valid = true;

                $form.children().removeClass("gallerix2-comment-field-invalid");

                var $name = $form.find("input[name='gallerix2-form-name']");
                var $email = $form.find("input[name='gallerix2-form-email']");
                var $website = $form.find("input[name='gallerix2-form-website']");
                var $comment = $form.find("textarea[name='gallerix2-form-comment']");
                var replyto = jQuery(glob.lightbox).find(".gallerix2-comment-form").attr("data-gallerix-comment-form-reply-to");

                if ($name.length > 0) {
                    if (jQuery.trim($name.val()) == "") {
                        $name.addClass("gallerix2-comment-field-invalid");
                        valid = false;
                    }

                    if (!lightbox.comment.isValidEmailAddress($email.val())) {
                        $email.addClass("gallerix2-comment-field-invalid");
                        valid = false;
                    }

                    if ($website.val() != "" && !lightbox.comment.isValidUrlAddress($website.val())) {
                        $website.addClass("gallerix2-comment-field-invalid");
                        valid = false;
                    }
                } else {
                    $name = false;
                    $email = false;
                    $website = false;
                }

                if (jQuery.trim($comment.val()) == "") {
                    $comment.addClass("gallerix2-comment-field-invalid");
                    valid = false;
                }

                if (valid === true) {

                    var data = {
                        action: "gallerix2_send_comment",
                        gallerix2commentdata: {
                            postid: posts.id,
                            replyto: replyto,
                            name: $name ? $name.val() : "",
                            email: $email ? $email.val() : "",
                            website: $website ? $website.val() : "",
                            comment: $comment.val()
                        }
                    };

                    ajax.comment.send(data);
                }

            }
        }
    };

    var ajax = {
        request: false,
        comment: {
            loadMore: function(){
                
                var offset = jQuery(glob.lightbox).find(".gallerix2-post-comment").not(".gallerix2-post-comment-level-1").length;
                
                var data = {
                    action: "gallerix2_load_more_comments",
                    gallerix2commentdata: {
                        postid: posts.id,
                        offset: offset
                    }
                };
                
                ajax.request = jQuery.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: data,
                    dataType: "json",
                    
                    beforeSend: function() {
                        if (ajax.request)  ajax.request.abort();
                        
                        jQuery(glob.lightbox).find(".gallerix2-comments-load-more-button").hide();
                        jQuery(glob.lightbox).find(".gallerix2-comments-load-more-loader").show();
                        
                    },
                    
                    success: function(data){
                        if (data.status == "ok") {
                            
                            jQuery(glob.lightbox).find(".gallerix2-comments-load-more-button").show();
                            jQuery(glob.lightbox).find(".gallerix2-comments-load-more-loader").hide();
                            
                            if (data.content) {
                                jQuery(data.content).fadeIn(1000).appendTo(jQuery(glob.lightbox).find(".gallerix2-post-comments-list"));
                                
                            } else {
                                // No more content
                                jQuery(glob.lightbox).find(".gallerix2-comments-load-more").remove();
                            }
                        }
                    },
                    
                    error: function(xhr, status, thrown) {
                        console.log(xhr + " " + status + " " + thrown);
                    },
                    
                    complete: function(){
                        ajax.request = false;
                    }
                });
            },
            send: function(data) {

                ajax.request = jQuery.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: data,
                    dataType: "json",
                    
                    beforeSend: function() {
                        if (ajax.request)
                            ajax.request.abort();

                        jQuery(glob.lightbox).find(".gallerix2-comment-form-status").text("");
                        jQuery(glob.lightbox).find(".gallerix2-comment-form-content").fadeOut(250, function() {
                            jQuery(glob.lightbox).find(".gallerix2-comment-form-loader").fadeIn(250);
                        });

                    },
                    
                    success: function(data) {
                        if (data.status == "ok") {

                            setTimeout(function() {

                                jQuery(glob.lightbox).find(".gallerix2-comment-form-loader").fadeOut(250, function() {

                                    jQuery(glob.lightbox).find(".gallerix2-comment-form-status").text(gallerix2L10n.commentsent);

                                    jQuery(glob.lightbox).find(".gallerix2-comment-form-status").fadeIn(250, function() {
                                        setTimeout(function() {
                                            jQuery(glob.lightbox).find(".gallerix2-comment-form-status").fadeOut(250, function() {
                                                jQuery(glob.lightbox).find(".gallerix2-comment-form-content").fadeIn(450);

                                                var content = data.content;
                                                var replyto = data.replyto;
                                                
                                                if (replyto == 0) {
                                                    // Fresh comment
                                                    jQuery(content).prependTo(jQuery(glob.lightbox).find(".gallerix2-post-comments-list"));
                                                    jQuery(content).prependTo(posts.$li.filter("[data-gallerix2-post="+posts.id+"]").find(".gallerix2-post-comments-list"));
                                                    
                                                } else {
                                                    // Reply
                                                    jQuery(content).insertAfter(jQuery(glob.lightbox).find("[data-gallerix2-comment-id=" + replyto + "]"));
                                                    jQuery(content).insertAfter(posts.$li.filter("[data-gallerix2-post="+posts.id+"]").find("[data-gallerix2-comment-id=" + replyto + "]"));
                                                }
                                                
                                                // Increment comments 
                                                var $el_1  = posts.$li.filter("[data-gallerix2-post=" + posts.id + "]").find(".gallerix2-post-comments-count").find("span");
                                                var $el_2  = jQuery(glob.lightbox).find(".gallerix2-post-comments-title span");
                                                var $el_3  = posts.$li.filter("[data-gallerix2-post=" + posts.id + "]").find(".gallerix2-post-comments-title span");
                                                var newval = parseInt(jQuery($el_1).html(), 10) + 1;
                                                
                                                $el_1.html(newval);
                                                $el_2.html(newval);
                                                $el_3.html(newval);
                                                
                                                // Reset comment form
                                                jQuery(glob.lightbox).find(".galleri2-post-comment-reply").show();
                                                jQuery(glob.lightbox).find(".gallerix2-lightbox-button-like").before(jQuery(glob.lightbox).find(".gallerix2-comment-form"));
                                                jQuery(glob.lightbox).find(".gallerix2-leave-comment-cancel").hide();
                                                jQuery(glob.lightbox).find(".gallerix2-comment-form").attr("data-gallerix-comment-form-reply-to", "0");
                                                
                                                
                                            });
                                        }, 1000);
                                    });
                                });

                            }, 1000);
                        }
                    },
                    
                    error: function(xhr, status, thrown) {
                        console.log(xhr + " " + status + " " + thrown);
                    },
                    
                    complete: function() {
                        ajax.request = false;
                    }
                });

            }
        },
        post: {
            liked: function() {

                var data = {
                    action: "gallerix2_post_liked",
                    gallerix2postdata: {
                        postid: posts.id
                    }
                };

                ajax.request = jQuery.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: data,
                    dataType: "json",
                    
                    beforeSend: function() {
                        if (ajax.request)
                            ajax.request.abort();
                    },
                    
                    success: function() {
                        var $el = posts.$li.filter("[data-gallerix2-post=" + posts.id + "]").find(".gallerix2-post-likes").find("span");
                        var newval = parseInt(jQuery($el).html(), 10) + 1;
                        $el.html(newval);
                        
                        posts.$li.filter("[data-gallerix2-post=" + posts.id + "]").find(".gallerix2-lightbox-button-like").addClass("liked");
                    },
                    
                    error: function(xhr, status, thrown) {
                        console.log(xhr + " " + status + " " + thrown);
                    },
                    
                    complete: function() {
                        ajax.request = false;
                    }
                });
            },
            
            viewed: function() {

                var data = {
                    action: "gallerix2_post_viewed",
                    gallerix2postdata: {
                        postid: posts.id
                    }
                };

                ajax.request = jQuery.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: data,
                    dataType: "json",
                    
                    beforeSend: function() {
                        if (ajax.request)
                            ajax.request.abort();
                    },
                    
                    success: function() {
                        var $el = posts.$li.filter("[data-gallerix2-post=" + posts.id + "]").find(".gallerix2-post-views").find("span");
                        var newval = parseInt(jQuery($el).html(), 10) + 1;
                        $el.html(newval);
                    },
                    
                    error: function(xhr, status, thrown) {
                        console.log(xhr + " " + status + " " + thrown);
                    },
                    
                    complete: function() {
                        ajax.request = false;
                    }
                });
            }
        }

    };

    var cookies = {
       
        exists: function(name) {
            if (!name)
                return false;
            var cookie = jQuery.cookie(name);
            return cookie ? true : false;
        }

    };

}

jQuery(document).ready(function() {
    if (typeof gallerix2_instance !== "undefined") {
        var i = 0;
        while (gallerix2_instance[i]) {
            new gallerix2().init(gallerix2_instance[i]);
            i++;
        }
        delete gallerix2_instance;
    }
});