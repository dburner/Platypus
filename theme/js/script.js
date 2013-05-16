$.fn.scrollTo = function( target, options, callback ){
  if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
  var settings = $.extend({
    scrollTarget  : target,
    offsetTop     : 50,
    duration      : 500,
    easing        : 'swing'
  }, options);
  return this.each(function(){
    var scrollPane = $(this);
    var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
    var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
    scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
      if (typeof callback == 'function') { callback.call(this); }
    });
  });
}

$('document').ready(function(){

	// Login Screen
	var blackScreen 		= $('#blackScreen');
	var registerButton		= $('.options > .register');
	var loginButton 		= $('.options > .login');
	var forgotButton 		= $('.loginContainer .forgot');
	var loginContainer 		= $('#loginCenter > .loginContainer');
	var registerContainer 	= $('#loginCenter > .registerContainer');
	var forgotContainer 	= $('#loginCenter > .forgotContainer');
	var containers 			= $('#loginCenter > .container');

	$('.loginLink').click(function(){
		if (!blackScreen.hasClass('active'))
			blackScreen.addClass('active');
		else
			blackScreen.removeClass('active');
	});

	blackScreen.click(function(e){
		if (this == e.target)
			blackScreen.removeClass('active');
	});

	registerButton.click(function(){
		containers.removeClass('active');
		registerContainer.addClass('active');
		loginButton.removeClass('active');
		$(this).addClass('active');
	});

	loginButton.click(function(){
		containers.removeClass('active');
		loginContainer.addClass('active');
		registerButton.removeClass('active');
		$(this).addClass('active');
	});

	forgotButton.click(function(){
		containers.removeClass('active');
		forgotContainer.addClass('active');
		loginButton.removeClass('active');
		registerButton.removeClass('active');
	});

	var back = $('.backToTop');
	back.css('opacity','0');
	
	back.click(function(){
		$('body').scrollTo(0);
	});
	
	// Back to top
	if (back.length == 1)
	{
		$(window).bind('scroll resize',function(){
			var s = parseFloat($(document).scrollTop());
			var d = parseFloat($(document).height());
			var w = parseFloat($(window).height());

			if (parseFloat($(window).width()) > 1180)
			{
				if (s <= 360) 
					back.css({'opacity':'0'});
				else 
					back.css({'opacity':'1'});

				back.css(
					{
					"display":"block",
					"position":"fixed",
					"bottom":"10px"
					});
			}
			else
				back.css(
					{
					"display":"none",
					"position":"relative",
					"bottom":"initial"
					});
		});
	}

	// tabSwitcher
	var tabNavs 		= $('.tabNav > .tabs');
	var tabContainers 	= $('.tabContainer > .containers');
	var sageata 		= $('.sageata');
	tabNavs.click(function(){
		tabNavs.add(tabContainers).removeClass('active');
		var order = $(this).attr('order');
		$(this).add(tabContainers.eq(order)).addClass('active');
		sageata.removeClass().addClass('sageata pos'+order);
	});

	// welcomeScreen
	var welcomeScreen 	= $('.welcomeScreen');
	var loginWelcome 	= $('.loginWelcome');

	loginWelcome.click(function(){
		if (welcomeScreen.hasClass('active'))
			welcomeScreen.removeClass('active');		
		else
			welcomeScreen.addClass('active');
	});
	$('body').click(function(e){
		if ((e.target.className != 'target') && (welcomeScreen.hasClass('active')))
				welcomeScreen.removeClass('active');
	});

	// $( "#accountTabsContainer" ).tabs();
	$('.tab').click(function () {
		// Remove the 'active' class from the active tab.
		$('#accountTabsContainer .tabs .active')
		  .removeClass('active');
		  
		// Add the 'active' class to the clicked tab.
		$(this).addClass('active');

		// Remove the 'tabContentActive' class from the visible tab contents.
		$('#accountTabsContainer .tabContentActive')
		  .removeClass('tabContentActive');

		eq = parseInt($(this).attr('nr'));
		// Add the 'tabContentActive' class to the associated tab contents.
		$('#accountTabsContainer .tabContent').eq(eq-1).addClass('tabContentActive');
    });



	$('input').iCheck({
		checkboxClass: 'icheckbox_flat-grey',
		radioClass: 'iradio_flat-grey'
	});

	$('#tagInput').tagit({
		fieldName: "tags[]",
		availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
	});

	$('select').multiselect({
		header: false,
		multiple: false,
		minWidth: 264,
		height:120,
		noneSelectedText: 'Select Category',
		selectedList: 1
	});



	// graphs
	var ctx = $("#Chart1").get(0).getContext("2d");
	//This will get the first returned node in the jQuery collection.

	var data = {
		labels : ["January","February","March","April","May","June","July"],
		datasets : [
			{
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,1)",
				pointColor : "rgba(220,220,220,1)",
				pointStrokeColor : "#fff",
				data : [65,59,90,81,56,55,40]
			},
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,1)",
				pointColor : "rgba(151,187,205,1)",
				pointStrokeColor : "#fff",
				data : [28,48,40,19,96,27,100]
			}
		]
	}
	new Chart(ctx).Line(data);

	var ctx2 = $("#Chart2").get(0).getContext("2d");
	var data2 = {
		labels : ["Eating","Drinking","Sleeping","Designing","Coding","Partying","Running"],
		datasets : [
			{
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,1)",
				pointColor : "rgba(220,220,220,1)",
				pointStrokeColor : "#fff",
				data : [65,59,90,81,56,55,40]
			},
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,1)",
				pointColor : "rgba(151,187,205,1)",
				pointStrokeColor : "#fff",
				data : [28,48,40,19,96,27,100]
			}
		]
	};
	new Chart(ctx2).Radar(data2);
});