!function(a){function b(){var a={bg_color:"background-color",padding:"padding",margin_bottom:"margin-bottom",bg_image:"background-image"},b=vc.edit_element_block_view.model.get("params"),c=_.reduce(a,function(a,c,d){var e=b[d];return _.isUndefined(e)||!e.length?a:("bg_image"===d&&(e="url("+e+")"),a+c+": "+e+";")},"",this);return c?".tmp_class{"+c+"}":""}var c,d;d=vc.CssEditorLite=Backbone.View.extend({attrs:{},layouts:["margin","padding"],positions:["top","right","bottom","left"],$field:!1,simplify:!1,$simplify:!1,initialize:function(){_.bindAll(this,"setSimplify")},render:function(a){return this.attrs={},this.$simplify=this.$el.find(".vc_simplify"),_.isString(a)&&this.parse(a),this},parse:function(a){var b=a.split(/\s*(\.[^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/g);b[2]&&this.parseAtts(b[2].replace(/\s+!important/g,""))},changeSimplify:function(){var a=_.debounce(this.setSimplify,100);a&&a()},setSimplify:function(){this.simplifiedMode(this.$simplify[0].checked)},simplifiedMode:function(b){b?(this.simplify=!0,this.$el.addClass("vc_simplified")):(this.simplify=!1,this.$el.removeClass("vc_simplified"),_.each(this.layouts,function(b){"border-width"===b&&(b="border");var c=a("[data-attribute="+b+"].vc_top");this.$el.find("[data-attribute="+b+"]:not(.vc_top)").val(c.val())},this))},parseAtts:function(a){var b,c,d;b=/(\d+\S*)\s+(\w+)\s+([\d\w#\(,]+)/,c=/^([^\s]+)\s+url\(([^\)]+)\)([\d\w]+\s+[\d\w]+)?$/,d=!1,_.map(a.split(";"),function(a){var e,f,g,h=a.split(/:\s/),i=h[1]||"",j=h[0]||"";i&&(i=i.trim()),j.match(new RegExp("^("+this.layouts.join("|").replace("-","\\-")+")$"))&&i?(e=i.split(/\s+/g),1===e.length?e=[e[0],e[0],e[0],e[0]]:2===e.length?(e[2]=e[0],e[3]=e[1]):3===e.length&&(e[3]=e[1]),_.each(this.positions,function(a,b){this.$el.find("[data-name="+j+"-"+a+"]").val(e[b])},this)):"background-size"===j?(d=i,this.$el.find("[name=background_style]").val(i)):"background-repeat"!==j||d?"background-image"===j?this.setCurrentBgImage(i.replace(/url\(([^\)]+)\)/,"$1")):"background"===j&&i?(g=i.split(c),g[1]&&this.$el.find("[name="+j+"_color]").val(g[1]),g[2]&&this.setCurrentBgImage(g[2])):"border"===j&&i&&i.match(b)?(f=i.split(b),e=[f[1],f[1],f[1],f[1]],_.each(this.positions,function(a,b){this.$el.find("[name="+j+"_"+a+"_width]").val(e[b])},this),this.$el.find("[name=border_style]").val(f[2]),this.$el.find("[name=border_color]").val(f[3]).trigger("change")):-1!=j.indexOf("border")&&i?-1!=j.indexOf("style")?this.$el.find("[name=border_style]").val(i):-1!=j.indexOf("color")?this.$el.find("[name=border_color]").val(i).trigger("change"):-1!=j.indexOf("radius")?this.$el.find("[name=border_radius]").val(i):j.match(/^[\w\-\d]+$/)&&this.$el.find("[name="+j.replace(/\-+/g,"_")+"]").val(i):j.match(/^[\w\-\d]+$/)&&i&&this.$el.find("[name="+j.replace(/\-+/g,"_")+"]").val(i):this.$el.find("[name=background_style]").val(i)},this)},save:function(){var a="";return this.attrs={},_.each(this.layouts,function(a){this.getFields(a)},this),_.isEmpty(this.attrs)||(a=".vc_custom_"+Date.now()+"{"+_.reduce(this.attrs,function(a,b,c){return b?a+c+": "+b+" !important;":a},"",this)+"}"),a&&vc.frame_window&&vc.frame_window.vc_iframe.setCustomShortcodeCss(a),a},getFields:function(a){var b=[];return this.simplify?this.getSimplifiedField(a):(_.each(this.positions,function(c){var d=this.$el.find("[data-name="+a+"-"+c+"]").val().replace(/\s+/,"");d.match(/^-?\d*(\.\d+){0,1}(%|in|cm|mm|em|rem|ex|pt|pc|px|vw|vh|vmin|vmax)$/)||(d=isNaN(parseFloat(d))?"":""+parseFloat(d)+"px"),d.length&&b.push({name:c,val:d})},this),void _.each(b,function(b){var c="border-width"===a?"border-"+b.name+"-width":a+"-"+b.name;this.attrs[c]=b.val},this))},getSimplifiedField:function(a){var b="top",c=this.$el.find("[data-name="+a+"-"+b+"]").val().replace(/\s+/,"");c.match(/^-?\d*(\.\d+){0,1}(%|in|cm|mm|em|rem|ex|pt|pc|px|vw|vh|vmin|vmax)$/)||(c=isNaN(parseFloat(c))?"":""+parseFloat(c)+"px"),c.length&&(this.attrs[a]=c)}}),vc.atts.css_editor_lite={parse:function(a){var b,d,e;return b=this.content().find('input.wpb_vc_param_value[name="'+a.param_name+'"]'),d=b.data("vcFieldManager"),e=d.save(),e&&vc.edit_form_callbacks.push(c),e},init:function(c,e){a("[data-css-editor-lite=true]",this.content()).each(function(){var e=a(this),f=e.find('input.wpb_vc_param_value[name="'+c.param_name+'"]'),g=f.val();g||(g=b()),f.data("vcFieldManager",new d({el:e}).render(g))})}},c=function(){this.params=_.omit(this.params,"bg_color","padding","margin_bottom","bg_image")}}(window.jQuery);

/*-------------------------------------
 SELECT 2 FOR WPB SELECT
 ---------------------------------------*/
(function ($) {
	'use strict';

	$(document).ready(function (e) {
		$('.vc_colored-dropdown select.wpb-select').each(function () {
			var $this = $(this);

			if ($this.hasClass('select2-ready')) {
				return;
			}

			$this.addClass('select2-ready');

			var $vc_color = $this.select2({
				width                  : '100%',
				closeOnSelect          : true,
				minimumResultsForSearch: 20
			});

			$vc_color.data('select2').$dropdown.addClass("vc_colored");

			/*-------------------------------------
			 TOGGLE SELECT2-DROP
			 ---------------------------------------*/
			// $(document).on('click', function (e) {
			// 	if ($('.vc_ui-panel-window').length !== 0 && $('.select2-container').length !== 0 && $(e.target).closest('.select2-container').length == 0) {
			// 		$this.select2('close');
			// 	}
			// });
		});
	});

})(jQuery);