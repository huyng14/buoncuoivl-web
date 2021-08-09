// jQuery Plugins: jEmotion 2.3
// Copyright @ www.phpbasic.com
// View http://jquery.phpbasic.com/jemotion for new version

(function($) {
	$.fn.emotions = function(settings,more_emotions) {
		var _cfg = {
			handle: 'a',
			dir: 'emotions/',
			label: 'Click here to show emotion icons',
			style: null,
			cls: null,
			r_alert: 1,
			emotions: [
				 {syntax: ':)',title: 'Devil',icon: '1.png'},
				 {syntax: ':x',title: 'Crying',icon: '2.png'},
				 {syntax: ':P',title: 'batting eyelashes',icon: '3.png'},
				 {syntax: ':o',title: 'big hug',icon: '4.png'},
				 {syntax: ':ss',title: 'cowboy',icon: '5.png'},
				 {syntax: ':c',title: 'big grin',icon: '6.png'},
				 {syntax: ':B',title: 'confused',icon: '7.png'},
				 {syntax: ':v',title: 'love struck',icon: '8.png'},
				 {syntax: ':(',title: 'phbbbbt',icon: '9.png'}
				
			]
		};
		if(settings) $.extend(_cfg, settings);
		var obj = this;
		var default_label = $(_cfg.handle).html();
		var default_style = $(_cfg.handle).attr('style');
		var default_css = $(_cfg.handle).attr('class');
		var funct = {
			__regexp: function(str){
				return str.replace(/(\.|\\|\+|\*|\?|\[|\^|\]|\$|\(|\)|\{|\}|\=|\!|\<|\>|\||\:|\-)/ig,"\\$1");
			},
			__load: function(){ // apply emotion
				if(more_emotions){
					$.each(more_emotions,function(id,val){
						if(_cfg.r_alert && _cfg.emotions[id]){
							if(confirm('Emotion '+id+'.'+_cfg.emotion_ext+' <=> '+_cfg.emotions[id]+' does exists. Do you want to replace it by '+val+' ?')) _cfg.emotions[id] = val;
						}else{
							_cfg.emotions[id] = val;
						}
					});
				}
				obj.each(function(){
					var str = $(this).html();
					$.each(_cfg.emotions,function(iEM,bbcode){
						str = str.replace(new RegExp(funct.__regexp(bbcode.syntax),'ig'),'<span class="emotion_show '+iEM+'"><img  src="'+_cfg.dir+bbcode.icon+'" title="'+bbcode.title+'" /></span>');
					});
					$(this).html(str);
					$(_cfg.handle).html(default_label).attr({'style':default_style}).addClass(default_css);
				})
			},
			__remove: function(){ // remove emotion
				$(obj).find('span.emotion_show').each(function(){
					var iE = Number(this.className.split('emotion_show ')[1]);
					$(this).attr({'class':''}).addClass('emotion_hide '+iE).html(_cfg.emotions[iE].syntax);		
				});
				$(_cfg.handle).html(_cfg.label).attr({'style':_cfg.style}).addClass(_cfg.cls);
			},
			__again: function(){
				$(obj).find('span.emotion_hide').each(function(){
					var iE = Number(this.className.split('emotion_hide ')[1]);
					$(this).attr({'class':''}).addClass('emotion_show '+iE).html('<img  src="'+_cfg.dir+_cfg.emotions[iE].icon+'" title="'+_cfg.emotions[iE].title+'" />');
				});
				$(_cfg.handle).html(default_label).attr({'style':default_style}).addClass(default_css);
			}
		};
		
		$(_cfg.handle).toggle(funct.__remove,funct.__again);
		funct.__load();
		return false;
	};
})(jQuery)