(function($) {
  $.fn.clockwinder = function(opts) {
    var options = $.extend({}, {
      postfix:'ago',
      interval:30000,
      alwaysRelative:false,
      attr:'datetime'
    }, opts);
  
    var elements = this;
  
    setInterval(function() {
      $.clockwinder.update(elements, options);
    }, options.interval);
  
    $.clockwinder.update(elements, options);

	return this;
  }

  $.clockwinder = {
    update:function(elements, options) {
      elements.each(function() {
        var $this   = $(this);
        var curTime = options.attr ? $this.attr(options.attr) : $this.text();
        var newTime = $.clockwinder.compute(curTime, options);
        
        if (options.displayFunction) {
          options.displayFunction.call(this, newTime, options);
        } else {
          $this.text(newTime, options);
        }
        
        $this.trigger('clockwinder.updated');
      });
    },
  
    compute:function(timeStr, opts) {
       var options = opts || {}
       var then = Date.parse(timeStr);
       var today = new Date();
    
       distance_in_milliseconds = today - then;
       distance_in_minutes = Math.round(Math.abs(distance_in_milliseconds / 60000));

       if (distance_in_minutes < 1440 || options.alwaysRelative){
        return $.clockwinder.time_ago_in_words(then) + (options.postfix ? ' ' + options.postfix : '');
       } else if (distance_in_minutes > 1440 && distance_in_minutes < 2160) {
        return then.strftime("Yesterday at %l:%M %p");
       } else {
        return then.strftime("%m/%d/%Y at %l:%M %p");
       }
    },
  
    time_ago_in_words:function(from) {
     return $.clockwinder.distance_of_time_in_words(new Date().getTime(), from) 
    },

    distance_of_time_in_words:function(to, from) {
      seconds_ago = ((to  - from) / 1000);
      minutes_ago = Math.floor(seconds_ago / 60)

      if(minutes_ago == 0) { return "less than a minute";}
      if(minutes_ago == 1) { return "a minute";}
      if(minutes_ago < 45) { return minutes_ago + " minutes";}
      if(minutes_ago < 90) { return " about 1 hour";}
      hours_ago  = Math.round(minutes_ago / 60);
      if(minutes_ago < 1440) { return "about " + hours_ago + " hours";}
      if(minutes_ago < 2880) { return "1 day";}
      days_ago  = Math.round(minutes_ago / 1440);
      if(minutes_ago < 43200) { return days_ago + " days";}
      if(minutes_ago < 86400) { return "about 1 month";}
      months_ago  = Math.round(minutes_ago / 43200);
      if(minutes_ago < 525960) { return months_ago + " months";}
      if(minutes_ago < 1051920) { return "about 1 year";}
      years_ago  = Math.round(minutes_ago / 525960);
      return "over " + years_ago + " years" 
    }
  }
})(jQuery);