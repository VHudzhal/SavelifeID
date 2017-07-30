/**
 * Created by miloslawsky on 15.06.17.
 */

(function($){
  var __messager = function(){
    this.x = 0;
    this.y = 0;
    this.wrapper = '#messager-system-wrapper';

    this.init = function(){
      $(document).on('messageOk', self.events.messageOk);
      $(document).on('messageError', self.events.messageError);
      $(document).on('messageOpen', self.events.messageOpen);
      $(document).on('mousemove', self.events.mouseMove);
    };

    this.getMessage = function(el){
      var dy = -16;
      var dx = 28;
      var x = self.x + 2*dx;
      var y = self.y + 2*dy;
      if ($(el) && $(el).offset()){
        x = $(el).offset().left + dx;
        y = $(el).offset().top + dy;
      }
/*
      if (x < 250) {
        x = 250;
      }
*/

      var style = '';
      var styler = $(el).parents('.js-messager-style');
      if (styler.length){
        style = $(styler).data('messager-style');
      }

      return $('<div>').addClass('label label-success').attr('style', style).css({
        'top'  : y,
        'left' : x,
        'position': 'absolute'
      });
    };

    this.events = {
      messageOpen: function(e, data){
        if (data && data.el){
          var oldMessage = $(data.el).data('message');
          if (oldMessage){
            $(oldMessage).remove();
          }
          var message = self.getMessage(data.el);
          var text = data.text ? data.text : 'Action is processing...';
          $(message).html(text).data('parent', data.parent).hide().appendTo(self.wrapper).show(300);
          $(data.el).data('message', $(message));
          setTimeout(function(){
            $(message).fadeOut(1000, function(){
              $(message).remove();
            });
          }, 10000);
        }
      },
      messageOk: function(e, data){
        if (data){
          var text = data.text ? data.text : 'The data is saved successfully.';
          var message;
          if (data.el && $(data.el).data('message')){
            message = $(data.el).data('message');
          } else {
            message = self.getMessage(data.el);
          }
          $(message).html(text).appendTo(self.wrapper);
          setTimeout(function(){
            $(message).fadeOut(1000, function(){
              $(message).remove();
            });
          }, 2000);
        }
      },
      messageError: function(e, data){
        if (data){
          var text = data.text ? data.text : 'The data saving <strong>FAILED</strong>';
          var message;
          if (data.el && $(data.el).data('message')){
            message = $(data.el).data('message');
          } else {
            message = self.getMessage(data.el);
          }
          $(message).removeClass('label-success').addClass('label-danger').html(text).appendTo(self.wrapper);
          setTimeout(function(){
            $(message).fadeOut(1000, function(){
              $(message).remove();
            });
          }, 2000);
        }
      },
      mouseMove: function(e){
        self.x = e.pageX;
        self.y = e.pageY;
      }
    };
    var self = this;
    this.init();
  };

  new __messager();
})(jQuery);