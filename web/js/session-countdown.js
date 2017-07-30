(function($){

  var __countdowner = function(){
    this.el = null;
    this.intervalHandler = null;
    this.url = '/ajax/countdown?nsp=1';

    this.init = function(){
      self.el = $('.session-countdowner');
      if ($(self.el).length > 0){
        self.intervalHandler = setTimeout(self.checkSession, 500);
      }
      $( document ).ajaxComplete(function(e, jqXHR, ajaxOptions){
        if(ajaxOptions.url !== self.url){
          if ($('body').hasClass('patient-registred')){
            self.checkSession();
          }
        }
      });
    };

    this.checkSession = function(){
      if (self.intervalHandler){
        clearTimeout(self.intervalHandler);
      }

      $.get(self.url, function(data){
        var interval = 30000;
        if (data.result){
          self.redraw(data);
          if (data.until < 120) {
            interval = 15000;
          }
          if (data.until < 60) {
            interval = 5000;
          }
          if (data.until == 0) {
            document.location.href = document.location.href;
          }
        }
        self.intervalHandler = setTimeout(self.checkSession, interval);
      });
    };

    this.redraw = function(data){
      $('time.relative', self.el).html(data.text);
      $('.progress-bar', self.el).css('width', data.percent+'%').attr('aria-valuenow', data.percent);
    };


    var self = this;
    this.init();
  };

  var countdowner = new __countdowner();

})(jQuery);