var menuBgDefault=!1;function saveThemeSettings(){let e=$(".navbar-dark-checkbox"),a=null;void 0===e.data("unset_dark")&&(a=e.prop("checked")),$.ajax({url:"/theme-settings",method:"post",data:{_token:$('meta[name="csrf-token"]').attr("content"),"menu-color":$(".menu-color-option.selected").data("color"),"menu-dark":$(".menu-dark-checkbox").prop("checked"),"menu-bg-color":$(".menu-bg-color-option.selected").data("color"),"menu-collapsed":$(".menu-collapsed-checkbox").prop("checked"),"menu-selection":$(".menu-selection-radio:checked").val(),"navbar-color":$(".navbar-color-option.selected").data("color"),"navbar-dark":a,"navbar-fixed":$(".navbar-fixed-checkbox").prop("checked"),"footer-dark":$(".footer-dark-checkbox").prop("checked"),"footer-fixed":$(".footer-fixed-checkbox").prop("checked")},success:e=>{M.toast({html:e.message,classes:e.success?"green":"red"})}})}$(document).ready((function(){$(".theme-cutomizer").sidenav({edge:"right"});new PerfectScrollbar(".theme-cutomizer",{suppressScrollX:!0});function e(e){e?($(".menu-dark-checkbox").prop("checked",!0),$(".sidenav-main").removeClass("sidenav-light").addClass("sidenav-dark")):($(".menu-dark-checkbox").prop("checked",!1),$(".sidenav-main").addClass("sidenav-light").removeClass("sidenav-dark"))}function a(e){e?($(".sidenav-main").removeClass("nav-lock"),$(".navbar-main.nav-collapsible").removeClass("sideNav-lock").addClass("nav-expanded"),$(".navbar-toggler i").html("radio_button_unchecked"),$("#main").addClass("main-full"),$(".sidenav-main.nav-collapsible, .navbar .brand-sidebar").trigger("mouseleave")):($(".sidenav-main").addClass("nav-lock").removeClass("nav-collapsed"),$(".navbar-main.nav-collapsible").addClass("sideNav-lock").removeClass("nav-collapsed"),$(".navbar-toggler i").html("radio_button_checked"),$("#main").removeClass("main-full"),$(".sidenav-main.nav-collapsible, .navbar .brand-sidebar").trigger("mouseenter"))}function o(e){r(".navbar-main"),e?($(".navbar-dark-checkbox").prop("checked",!0),$(".navbar-main").removeClass("navbar-light").addClass("navbar-dark")):($(".navbar-dark-checkbox").prop("checked",!1),$(".navbar-main").addClass("navbar-light").removeClass("navbar-dark"))}function n(e){e?($(".footer-dark-checkbox").prop("checked",!0),$(".page-footer").removeClass("footer-light").addClass("footer-dark")):($(".footer-dark-checkbox").prop("checked",!1),$(".page-footer").addClass("footer-light").removeClass("footer-dark"))}function r(e){$(e).removeClass("gradient-45deg-indigo-blue gradient-45deg-purple-deep-orange gradient-45deg-light-blue-cyan gradient-45deg-purple-amber gradient-45deg-purple-deep-purple gradient-45deg-deep-orange-orange gradient-45deg-green-teal gradient-45deg-indigo-light-blue gradient-45deg-red-pink red purple pink deep-purple cyan teal light-blue amber darken-3 brown darken-2 gradient-45deg-indigo-purple gradient-45deg-deep-purple-blue")}$("body").hasClass("vertical-modern-menu")||$("body").hasClass("vertical-menu-nav-dark")?menuBgDefault=!0:$("body").hasClass("vertical-gradient-menu")||$("body").hasClass("vertical-dark-menu")?($(".menu-color").hide(),menuBgDefault=!0):$("body").hasClass("horizontal-menu")&&$(".menu-options").hide(),$(".menu-color-option").click((function(e){$(".menu-color .menu-color-option").removeClass("selected"),$(this).addClass("selected");var a=$(this).attr("data-color");saveThemeSettings(),function(e){r(".sidenav-main .sidenav li a.active"),$(".sidenav-main .sidenav li a.active").css({background:"none","box-shadow":"none"}),$(".sidenav-main .sidenav li a.active").addClass(e+" gradient-shadow")}(a)})),$(".menu-bg-color-option").click((function(a){$(".menu-bg-color .menu-bg-color-option").removeClass("selected"),$(this).addClass("selected");var o=$(this).attr("data-color");saveThemeSettings(),e(!0),function(e){r(".sidenav-main"),$(".sidenav-main").addClass(e+" sidenav-gradient")}(o)})),$(".menu-dark-checkbox").click((function(a){$(".menu-dark-checkbox").prop("checked")?e(!0):e(!1),saveThemeSettings()})),$(".menu-selection-radio").click((function(e){var a=$(this).val();saveThemeSettings(),function(e){$(".sidenav-main").removeClass("sidenav-active-square sidenav-active-rounded").addClass(e)}(a)})),$(".menu-collapsed-checkbox").click((function(e){$(".menu-collapsed-checkbox").prop("checked")?a(!0):a(!1),saveThemeSettings()})),$(".navbar-color-option").click((function(e){$(".navbar-color .navbar-color-option").removeClass("selected"),$(this).addClass("selected");var a=$(this).attr("data-color");$(".navbar-dark-checkbox").data("unset_dark",!0),function(e){r(".navbar-main"),$(".navbar-main").addClass(e),$("body").hasClass("vertical-modern-menu")&&(r(".content-wrapper-before"),$(".content-wrapper-before").addClass(e))}(a),saveThemeSettings()})),$(".navbar-dark-checkbox").click((function(e){$(".navbar-dark-checkbox").prop("checked")?o(!0):o(!1),saveThemeSettings()})),$(".navbar-fixed-checkbox").click((function(e){$(".navbar-fixed-checkbox").prop("checked")?$("#header .navbar").addClass("navbar-fixed"):$("#header .navbar").removeClass("navbar-fixed"),saveThemeSettings()})),$(".footer-dark-checkbox").click((function(e){r(".page-footer"),$(".footer-dark-checkbox").prop("checked")?n(!0):n(!1),saveThemeSettings()})),$(".footer-fixed-checkbox").click((function(e){$(".footer-fixed-checkbox").prop("checked")?$(".page-footer").addClass("footer-fixed").removeClass("footer-static"):$(".page-footer").removeClass("footer-fixed").addClass("footer-static"),saveThemeSettings()})),$("html[data-textdirection='rtl']").length>0&&$(".theme-cutomizer").sidenav({edge:"left"})}));
