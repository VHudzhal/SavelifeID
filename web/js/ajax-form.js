/**
 * Created by miloslawsky on 23.03.17.
 */

(function($){

  window.__ajax_form = function(el){

    this.form = null;
    this.target = null;

    this.init = function(){
      if ($(el).hasClass('akvkaf')) return;
      $(el).addClass('akvkaf');
      self.form = el;
      if ($(self.form).data('target')){
        self.target = $(self.form).data('target');
      }

      var event = $(self.form).hasClass('simple-ajax-form')?'submit':'beforeSubmit';
      $(self.form).removeClass('kvk-ajax-form').on(event, function (e) {
        e.preventDefault();
        var data = $(this).blur().serializeArray();

        var button = $('button[type=submit]:last:visible', $(this));
        if (button){
          var btnText = $(button).html();
          $(button).html('<span class="fa fa-circle-o-notch fa-spin text-primary"></span> '+$(button).text());
        }

        $.ajax({
          type: "POST",
          url: $(this).attr('action'),
          data: data,
          success: function(returnData){
            if (button) {
              $(button).html(btnText);
            }
            if (self.target){
              $(self.target).html(returnData);
              $(self.target).find('form.kvk-ajax-form').each(function(){
                new __ajax_form(this);
              });
              $(self.form).trigger('after-apply-response');
              $(document).trigger('after-apply-response');
            }
          },
          error: function(xhr, error, returnData){
            var target = self.target?self.target:self.form;
            if (target){
              $(target).html($('<div>').addClass('alert alert-danger').html(returnData));
              $(target).find('form.kvk-ajax-form').each(function(){
                new __ajax_form(this);
              });
            }
          }
        });
        return false;
      }).on('submit', function (e) {
        e.preventDefault();
        return false;
      });
    };

    var self = this;
    this.init();
  };

  $(document).ready(function(){
    $('form.kvk-ajax-form').each(function(){
      new window.__ajax_form(this);
    });
  });

})(jQuery);

