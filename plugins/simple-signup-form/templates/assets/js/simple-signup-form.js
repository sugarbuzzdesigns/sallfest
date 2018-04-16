/************************************************************
* Filename: ssf.min.js						*
* Title: Simple Signup Form - jQuery File			*
* Description: Custom Javascript / jQuery file				*
* Author: Pantherius										*
* Author Page: http://codecanyon.net/user/pantherius		*
* Website: http://pantherius.com								*
************************************************************/
jQuery(document).ready(function() {
if ( typeof passed !== 'undefined')
{
	jQuery('body').ssform({
		animtime:					passed[0],
		autoopen:					passed[1],
		bgcolor:					passed[3],
		buttonbgcolor:				passed[4],
		buttoncolor:				passed[5],	
		closecolor:					passed[6],	
		closefontsize:				passed[7],
		color:						passed[8],
		contentcolor:				passed[9],
		fontfamily:					passed[10],
		contentfontfamily:			passed[11],
		contentfontsize:			passed[12],
		contentweight:				passed[13],
		title:			    		passed[14],
		text:						passed[15],
		timer:						passed[18],
		invalid_address:			passed[20],
		signup_success:				passed[21],
		borderradius:				passed[22],
		openbottom:					passed[23],
		fontsize:					passed[24],
		fontweight:					passed[25],
		once_per_user:				passed[31],
		cookie_days:				passed[32],
		subscribe_text:				passed[36],
		placeholder_text:			passed[37],
		lock:						passed[38],
		hideclose:					passed[39],
		path:						passed[100],
		formid:						passed[101],
		filled_cookie_days:			passed[41],
		googleplus_clientid:		passed[44],
		googleplus_apikey:			passed[45],
		openwithlink:				passed[47],
		once_per_filled:			passed[48],
		closewithlayer:				passed[49],
		customfields:				passed[50],
		lockbgcolor:				passed[51],
		preset:						passed[52]
	});
}
});
(function( $ ){
    var methods = {
    init : function(options) {
	var defaults = { 
		animtime:					0.4,
		animation:					'slide',
		autoopen:					true,
		mode:						'mail',
		googleplus_clientid:		'',
		googleplus_apikey:			'',
		bgcolor:					'#000',
		lockbgcolor:				'#fff',
		buttonbgcolor:				'#c7122f',
		buttoncolor:				'#ffffff',	
		closecolor:					'#d71b1b',	
		closefontsize:				'18px',
		color:						'#d71b1b',	
		contentcolor:				'#ccc',	
		fontfamily:					'Amaranth',
		contentfontfamily:			'Amaranth',
		openwithlink:				true,
		contentfontsize:			'13px',
		contentweight:				'normal',
		title:			    		'Subscribe to our Updates',
		text:						'We will only send notification when we releasing FREE and Premium Plugins, Themes or Updates for any of our existing products.',
		vspace:						"60px",
		hspace:						"10px",
		timer:						1000,
		position:					'centercenter',
		invalid_address:			'INVALID ADDRESS',
		signup_success:				'SIGNUP SUCCESS!',
		borderradius:				"3px",
		inputborderradius:			"3px",
		openbottom:					false,
		fontsize:					'20px',
		fontweight:					'bold',
		once_per_user:				false,
		cookie_days:				999,
		once_per_filled:			true,
		filled_cookie_days:			999,		
		subscribe_text:				'Get Updates',
		placeholder_text:			'Enter your email address',
		path:						'php/handler.php',
		lock:						false,
		closewithlayer:				false,
		hideclose:					true,
		preset:						'default'
	  };
	var presets = new Array();
	presets['default'] = { 
		customfieldsmargin:"7px", bgcolor:"rgb(254, 254, 254)",lockbgcolor:"rgb(0, 0, 0)",buttonbgcolor:"rgb(199, 28, 9)",buttoncolor:"rgb(247, 247, 247)",closecolor:"rgb(0, 0, 0)",closefontsize:"16px",color:"rgb(0, 0, 0)",contentcolor:"rgb(93, 93, 93)",fontfamily:"Trade Winds",contentfontfamily:"Quattrocento Sans",contentfontsize:"12px",	borderradius:"12px",inputborderradius:"0px",fontsize:"20px"
	  };
	if (typeof presets[options.preset] !== 'undefined') defaults = $.extend({}, defaults, presets[options.preset]); 
	var options = $.extend({}, defaults, options); 
	var opened = false;
	var once_opened = false;
	var lastScrollTop = 0;
	var blocker = 0;
	var fontstoappend = '';
	var socialemail = '';
	var protocol = '';
	var preloader = '<img width="30" height="10" title="" alt="" src="data:image/gif;base64,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" />';
	protocol = ('https:' == window.location.protocol ? 'https://' : 'http://');
	if (options.lock==true) {var locker = '<div id="ssp_locker"></div>';}
	else {var locker = "";}
	if (options.hideclose==true) {var closebutton = '';}
	else {var closebutton = '<i id="mc_embed_close" class="mc_embed_close fa fa-times"></i>';}

	if (options.googleplus_clientid!=''&&options.googleplus_apikey!='') 
	{
		(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = protocol + 'apis.google.com/js/client:plusone.js?onload=renderPlusone';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
			   window.renderPlusone = function() {
				   if (typeof gapi != "undefined")
				   {
					gapi.client.setApiKey(options.googleplus_apikey);
					gapi.client.load('plus', 'v1',function(){});
					gapi.signin.render('googleplusbtn', {
					  'clientid': options.googleplus_clientid,
					  'cookiepolicy': 'single_host_origin',
					  'requestvisibleactions': 'http://schema.org/AddAction',
					  'scope': 'profile email'
					});
					var authorizeButton = document.getElementById('googleplusbtn');
					authorizeButton.onclick = handleAuthClick;
				  }
			  }
			 window.handleAuthResult = function(authResult)
			 {
				var authorizeButton = document.getElementById('googleplusbtn');
				if (authResult && !authResult.error) {
				  makeApiCall();
				} else {
				  handleAuthClick();
				}
			 }
		       function handleAuthClick(event) {
				$("#ssp_gplogin").html(preloader);
				gapi.auth.authorize({client_id: options.googleplus_clientid, scope: 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read', cookiepolicy: 'single_host_origin', immediate: true}, handleAuthResult);
				return false;
			  }
			 function makeApiCall() {
				gapi.client.load('plus', 'v1', function() {
				  var request = gapi.client.plus.people.get({
					'userId': 'me'
				  });
					request.execute(function (resp)
					{
					  var email = '';
						if(resp['emails'])
						{
							for(i = 0; i < resp['emails'].length; i++)
							{
								if(resp['emails'][i]['type'] == 'account')
								{
									email = resp['emails'][i]['value'];
								}
							}
						}
					   if (typeof email != "undefined")
						{
							socialemail = email;
							$("#ssp_email").val(socialemail);
							$("#mc_embed_signup #subscribe").trigger("click");
						}
					});
				});
			}
	}
	if (options.fontfamily!=''&&options.fontfamily!="undefined") fontstoappend = options.fontfamily+":400,700";
	if (options.contentfontfamily!=''&&options.contentfontfamily!="undefined")
	{
		if (fontstoappend != "") fontstoappend += "|"+options.contentfontfamily+":400,700";
		else fontstoappend = options.contentfontfamily;
	}
	if (fontstoappend!="")
	{
			if (!$("link[href='" + protocol + "fonts.googleapis.com/css?family="+fontstoappend+"']").length) $('head').append('<link rel="stylesheet" href="' + protocol + 'fonts.googleapis.com/css?family='+fontstoappend+'" type="text/css" />');
	}
	if (!$("link[href='" + protocol + "netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css']").length) $('head').append('<link rel="stylesheet" href="' + protocol + 'netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" type="text/css" />');
	
	var sspdiv = '<div id="mc_embed_signup"><div id="mc_embed_signup_inner"><form onsubmit="return false;" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate><h2>'+options.title.replace(/(<([^>]+)>)/ig,"")+'</h2><p>'+options.text.replace(/(<([^>]+)>)/ig,"")+'</p><div class="mc-field-group"><div class="signup">';
	var bt = '<p id="ssp-bottom"></p>';
	var sociallogin = '<div id="ssp_social_login">';
	if (options.googleplus_clientid!=''&&options.googleplus_apikey!='') sociallogin += '<div id="ssp_gplogin"><div id="gSignInWrapper"><div id="googleplusbtn" class="customGPlusSignIn"><span class="icon"></span><span class="buttonText"></span></div></div></div>';
	sociallogin += '</div>';
	sspdiv += '<input type="email" value="" name="ssp_email" id="ssp_email" class="ssp_email" placeholder="'+options.placeholder_text+'" id="mce-EMAIL"><input type="submit" value="'+options.subscribe_text+'" name="subscribe" id="subscribe" class="button"></div>'+sociallogin+bt+'</div><div id="mce-responses" class="clear"><div class="response" id="mce-error-response" style="display:none"></div><div class="response" id="mce-success-response" style="display:none"></div></div><div style="position: absolute; left: -5000px;"><input type="text" name="b_59e5bbfbcc749fdb8fe68637a_b9c0fde42d" value=""></div></form></div>'+closebutton+'</div>'+locker;
	$(this).append(sspdiv);
	if (options.googleplus_clientid!=''&&options.googleplus_apikey!='') renderPlusone();
	$("#mc_embed_signup #mc_embed_signup_inner").css({"background":options.bgcolor,"border-radius":options.borderradius});
	$("#mc_embed_signup form h2").css({"color":options.color,"fontSize":options.fontsize,"font-weight":options.fontweight});
	$("#mc_embed_signup form>p").css({"fontSize":options.contentfontsize,"color":options.contentcolor,"font-weight":options.contentweight});
	$("#ssp-bottom").css({"color":options.contentcolor});
	$("#mc_embed_signup .ssp_email").css({"border-top-left-radius":options.inputborderradius,"border-bottom-left-radius":options.inputborderradius});
	$("#mc_embed_signup #subscribe").css({"border-top-right-radius":options.inputborderradius,"border-bottom-right-radius":options.inputborderradius,"background":options.buttonbgcolor,"color":options.buttoncolor});
	$("#ssp_locker").css("background",options.lockbgcolor);
	$("#mc_embed_signup #mc_embed_close").css({"color":options.closecolor,"fontSize":options.closefontsize});
	//initialize font families
	if (options.fontfamily!=''&&options.fontfamily!="undefined")
	{
			if ($("#mc_embed_signup form h2").length!=0) $("#mc_embed_signup form h2").css("fontFamily","'"+options.fontfamily+"', serif");
	}
	if (options.contentfontfamily!=''&&options.contentfontfamily!="undefined")
	{
			if ($("#mc_embed_signup form").length!=0) $("#mc_embed_signup form p,#mc_embed_signup input").css("fontFamily","'"+options.contentfontfamily+"', serif");
	}
	var leftstart, topstart, leftend, topend, side;
	if (options.position=="centercenter") {side="left";leftstart = parseInt(($(window).width()-$("#mc_embed_signup").width())/2)+"px";leftend = parseInt(($(window).width()-$("#mc_embed_signup").width())/2)+"px";topstart="-100%";topend=parseInt(($(window).height()-$("#mc_embed_signup").height())/2)+"px"}
	if (options.animation=='slide') 
	{
		if (side=="left") $("#mc_embed_signup").css({"left":leftstart,"top":topstart});
		else $("#mc_embed_signup").css({"right":leftstart,"top":topstart});
	}
	set_anim_time(options.animtime);
	$("#mc_embed_signup").css({"-webkit-transition": "all "+options.animtime+"s ease-in","-moz-transition": "all "+options.animtime+"s ease-in", "-o-transition": "all "+options.animtime+"s ease-in","-ms-transition": "all "+options.animtime+"s ease-in","transition": "all "+options.animtime+"s ease-in",'-webkit-animation-duration': options.animtime+"s",'-moz-animation-duration': options.animtime+"s",'-ms-animation-duration': options.animtime+"s",'-o-animation-duration': options.animtime+"s",	'animation-duration': options.animtime+"s"});
	if ($(window).width()<800) {
		$("#mc_embed_signup").css({"width":"100%"});
		$(".signup input").css({"width":"100%"});
		leftend="0px";topend=parseInt($(window).height()-$("#mc_embed_signup").height())+"px";
		}
	if (options.autoopen==true) {window.setTimeout(function(){
	if ((options.once_per_user==false)||(options.once_per_user==true&&getCookie("ssp")!='1'))
	{
		if (((options.once_per_filled==false)||(options.once_per_filled==true&&getCookie("ssp_filled")!='1'))&&once_opened==false) open_popup();
	}
	}, options.timer);
	}
	function set_anim_time(time)
	{
	$("#mc_embed_signup").css({"-webkit-transition": "all "+time+"s ease-in","-moz-transition": "all "+time+"s ease-in", "-o-transition": "all "+time+"s ease-in","-ms-transition": "all "+time+"s ease-in","transition": "all "+time+"s ease-in",'-webkit-animation-duration': time+"s",'-moz-animation-duration': time+"s",'-ms-animation-duration': time+"s",'-o-animation-duration': time+"s",	'animation-duration': time+"s"});	
	}
	function open_popup()
	{
	$("#mc_embed_signup").css("z-index","99999");
		if (options.lock==true) $("#ssp_locker").css("display","block");
		if (options.animation=='slide')
		{
		if (side=="left") $("#mc_embed_signup").css({"left":leftend,"top":topend,"opacity":"1"});
		else $("#mc_embed_signup").css({"right":leftend,"top":topend,"opacity":"1"});
		}
		else
		{
		set_anim_time(0);
		if (side=="left") $("#mc_embed_signup").css({"left":leftend,"top":topend,"opacity":"0"});
		else $("#mc_embed_signup").css({"right":leftend,"top":topend,"opacity":"0"});	
			 $("#mc_embed_signup").bind('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function (e) {
					$("#mc_embed_signup").removeClass(options.animation).css({"opacity":"1","z-index":"99999"});
				})
		set_anim_time(options.animtime);
			$("#mc_embed_signup").addClass(options.animation);
		}
		opened=true;once_opened = true;
		if (options.once_per_user==true) setCookie('ssp','1',options.cookie_days,'days');
	}
	
	function close_popup()
	{
		if (options.animation=='slide')
		{
			if (side=="left") $("#mc_embed_signup").css({"left":leftstart,"top":topstart,"opacity":"0"});
			else $("#mc_embed_signup").css({"right":leftstart,"top":topstart,"opacity":"0"});
		}
		else
		{
			 $("#mc_embed_signup").bind('animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd', function (e) {
					set_anim_time(0);
					$("#mc_embed_signup").removeClass(options.animation+'-out').css({"opacity":"0","z-index":"-1"});
				})			
			$("#mc_embed_signup").addClass(options.animation+'-out');
		}
		if (options.lock==true) $("#ssp_locker").css("display","none");
	}
	if (options.openwithlink==true)
	{
		$( ".openssform" ).click(function() {
			open_popup();
		})
	}
	if (options.openbottom!=false)
	{
			$(window).scroll(function() 
		{
		var st = $(document).scrollTop();
		if (options.openbottom==true) var openpos = 10;
		else var openpos = parseInt(100-options.openbottom);
		if($(window).scrollTop() + $(window).height() > $(document).height() - (($(document).height()/100)*openpos)&&st > lastScrollTop&&opened==false)
		{
			if (once_opened!=true) 
			{
				if ((options.once_per_user==false)||(options.once_per_user==true&&getCookie("ssp")!='1'))
				{
					opened=true;
					open_popup();
				}
			}
		}
		lastScrollTop = st;
		})
	}
		$("#ssp_email").focus();
		if (options.hideclose==false)
		{
			if(options.closewithlayer==true)
			{
				$( "#mc_embed_close,#ssp_locker" ).click(function() {
							close_popup();
							opened=false;
					})
			}
			else
			{
				$( "#mc_embed_close" ).click(function() {
							close_popup();
							opened=false;
					})			
			}
		}
/*						Email Validation Function			*/
	function isValidEmailAddress(emailAddress) 
	{
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		return pattern.test(emailAddress);
	};
		
/*						Send Subscription with Ajax			*/
		$( "#subscribe" ).click(function() {
		if (blocker==0)
		{
		$("#subscribe").css({"opacity":"0.2","cursor":"normal"});
		blocker = 1;
		var error = 0;
			if (isValidEmailAddress($("#ssp_email").val()))
			{
				var data = {
				action: 'ajax_ssp',
				sspcmd: 'subscription_signup',
				email: $("#ssp_email").val(),
                mode: options.mode,
				double_optin: options.double_optin,
				update_existing: options.update_existing,
				replace_interests: options.replace_interests,
				mailchimp_listid: options.mailchimp_listid,
				send_welcome: options.send_welcome,
				signup_form_id: options.formid
				};
				if (error==0)
				{
					$.post(options.path, data, function(response) 
					{
						if (response=="success") 
						{
							$(".signup").html(options.signup_success);
							window.setTimeout(function(){
							close_popup();
							opened=false;},2000);
							blocker = 0;
							$("#subscribe").css({"opacity":"1","cursor":"pointer"});
							if (options.once_per_filled==true) setCookie('ssp_filled','1',options.filled_cookie_days,'days');
							$("#ssp_social_login").remove();
						}
						else
						{
						var cmail = $(".ssp_email").val();
						$(".ssp_email").css("color","#FC0303");
						$(".ssp_email").val(response);
						setTimeout(function(){$(".ssp_email").css("color","");$(".ssp_email").val(cmail);},2000);
							blocker = 0;
							$("#subscribe").css({"opacity":"1","cursor":"pointer"});
						}
					});
				}
			}
			else
			{
			var cmail = $("#ssp_email").val();
			$("#ssp_email").css("color","#FC0303");
			$("#ssp_email").val(options.invalid_address);
			setTimeout(function(){$(".ssp_email").css("color","");$("#ssp_email").val(cmail);$("#subscribe").css({"opacity":"1","cursor":"pointer"});blocker = 0;},2000);
			}
		}
		});
		function setCookie(c_name,value,dduntil,mode)
		{
			if (mode=='days')
			{
				var exdate=new Date();
				exdate.setDate(exdate.getDate() + parseInt(dduntil));
				var c_value=escape(value) + ((dduntil==null) ? "" : "; expires="+exdate.toUTCString()) + "; path=/";
				document.cookie=c_name + "=" + c_value;		
			}
			if (mode=='minutes')
			{
				var now=new Date();
				var time = now.getTime();
				time += parseInt(dduntil);
				now.setTime(time);
				var c_value=escape(value) + ((dduntil==null) ? "" : "; expires="+now.toUTCString()) + "; path=/";
				document.cookie=c_name + "=" + c_value;
			}
		}

		function getCookie(c_name)
		{
			var c_value = document.cookie;
			var c_start = c_value.indexOf(" " + c_name + "=");
			if (c_start == -1)
			  {
			  c_start = c_value.indexOf(c_name + "=");
			  }
			if (c_start == -1)
			  {
			  c_value = null;
			  }
			else
			  {
			  c_start = c_value.indexOf("=", c_start) + 1;
			  var c_end = c_value.indexOf(";", c_start);
			  if (c_end == -1)
			  {
			c_end = c_value.length;
			}
			c_value = unescape(c_value.substring(c_start,c_end));
			}
			return c_value;
		}
	},
    destroy : function() {
		$("#mc_embed_signup").remove();
		return 1;
	}
    };
$.fn.ssform = function(methodOrOptions) {
        if ( methods[methodOrOptions] ) {
            return methods[ methodOrOptions ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  methodOrOptions + ' does not exist on $.ssform' );
        }    
    };
})( jQuery );