/**
 * Created by miloslawsky on 06.04.17.
 */

(function($){

  window.__stateful_title = function(el){

    this.el = $(el);
    this.control = this.el.find('input[type=checkbox]');
    this.position = 'left';

    this.init = function(){
      $(self.el).removeClass('stateful-title');
      self.initEvents();
      self.position = $(self.el).data('placement')?$(self.el).data('placement'):self.position;
      $(self.el).data('placement', self.position);

      $(self.control).trigger('change.stateful');
    };
    this.initEvents = function(){
      $(self.control).on('change.stateful', self.handlers.change);
    };

    this.handlers = {
      'change': function(e){
        if ($(this).is(':checked')){
          $(self.el).attr('title', $(self.el).data('title-checked'));
        } else {
          $(self.el).attr('title', $(self.el).data('title-unchecked'));
        }
        $(self.el).tooltip('destroy');
        $(self.el).data('data-original-title', '');
        setTimeout(function(){
            $(self.el).tooltip();
        }, 500);
      }
    };

    var self = this;
    this.init();
  };

  $(document).ready(function(){
    $('.stateful-title').each(function(){
      new window.__stateful_title(this);
    });
  });

})(jQuery);