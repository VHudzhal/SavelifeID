$(document).ready(function(){

		$(document).on('click', 'button.js-send-popup-form', function(e){
			e.stopPropagation();
      $('#reactivateModal h5:first').removeClass('alert alert-danger');
			if ($('.js-validate-cc').val() && $('.js-validate-cvv').val()){
        $(this).hide();
				var btn = $(this).clone(false);
				$(btn).removeClass('js-send-popup-form').addClass('js-tmp').appendTo('#reactivate-modal .modal-footer').show().attr('type', 'submit').click();
				$(document).one('after-apply-response', function(){
					$('#reactivateModal .js-tmp').remove();
					$('#reactivateModal .js-send-popup-form').show();
				});
			} else {
        $('#reactivateModal h5:first').addClass('alert alert-danger');
			}
		});

	  $(document).on('click', 'a.emodal-ajax', function(e){
	  	e.preventDefault();
	  	var link = $(this);
	  	var atext = $(this).html();
      $(link).html('<span class="fa fa-circle-o-notch fa-spin text-primary"></span> '+$(':visible', this).text());
	  	$.get($(this).attr('href'), function(data){
        $('.modal').modal('hide');
        $(link).html(atext);
	  		var id = $(data).filter('.modal').attr('id');
	  		$('#'+id).remove();
	  		$('body').append(data);
        $('#'+id).modal('toggle');
        $('form.kvk-ajax-form').each(function(){
          new window.__ajax_form(this);
        });
			});
		});
	  $(document).on('click', 'a.js-ajaxify', function(e){
	  	e.preventDefault();
	  	var link = $(this);
	  	var atext = $(this).html();
	  	var target = $(this).data('target');
      $(link).html('<span class="fa fa-circle-o-notch fa-spin text-primary"></span> '+$(this).text());

      $.ajax({
        type: "GET",
        url: $(this).attr('href'),
        success: function(data){
					$(link).html(atext);
					if (target){
						$(target).html(data);
					} else {
						$(link).replaceWith(data);
					}
					$('form.kvk-ajax-form').each(function(){
						new window.__ajax_form(this);
					});
				},
        error: function(xhr, error, data){
          $(link).html(atext);
          if (target){
            $(target).html(data);
          } else {
            $(link).replaceWith(data);
          }
          $('form.kvk-ajax-form').each(function(){
            new window.__ajax_form(this);
          });
        }
      });
		});
    $('[data-toggle="tooltip"]').tooltip();
		$(".checkbox-eye").on('click', function() {
			if (boxClass = $(this).find(".glyphicon").attr('class') ) {
				if (boxClass.indexOf("close")>0) {
					$(this)
						.find(".glyphicon")
						.removeClass("glyphicon-eye-close")
						.addClass("glyphicon-eye-open")
						.attr('checked',true);
				}
				else {
					$(this)
						.find(".glyphicon")
						.removeClass("glyphicon-eye-open")
						.addClass("glyphicon-eye-close")
						.attr('checked',false);
				}
			}
			else {
				boxClass = $(this).attr('class');
				if (boxClass.indexOf("close")>0) {
					$(this)
						.removeClass("glyphicon-eye-close")
						.addClass("glyphicon-eye-open")
						.attr('checked',true);
				}
				else {
					$(this)
						.removeClass("glyphicon-eye-open")
						.addClass("glyphicon-eye-close")
						.attr('checked',false);
				}
			}
		});
		$(document).on('click', '.btn-forgot', function(){
			$(this).parents('form').append('<input type="hidden" name="LoginForm[forgot]" value="1">').submit();
		});


    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.js-subscription-status').on('click', function(){
      $('ul.nav a[href="#subscription-status"]').tab('show');
		});

    $('.nav-pills a').click(function (e) {
      $(this).tab('show');
      var scrollmem = $('body').scrollTop() || $('html').scrollTop();
      window.location.hash = this.hash;
      $('html,body').scrollTop(scrollmem);
    });

  $('#signIN').on('shown.bs.modal', function () {
    $('#signIN #loginform-email').focus();
  })
});

function forgotPass() {
  $('#signinTitle').text('Thank you');
  $('#signinButton').hide();
  $('#closeButton').show();
  $('#signInForm').hide();
  $('.forgotPassMessage').show();
}

function signINclear() {
  $('#signinTitle').text('Sign In');
  $('#signinButton').show();
  $('#closeButton').hide();
  $('#signInForm').show();
  $('.forgotPassMessage').hide();
}

function signIN() {
  $('#signInForm').submit();
  // window.location.href = '/subscriber-home/';
}
