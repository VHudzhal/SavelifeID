
$(document).ready(function(){
  var saveTimeOut;
  var queue = [];
  var queueCounter = 1;

  $('#medicalRecordForm-emergency').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });
  $('.js-custom-title').on('keyup', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      $('.js-add-custom').click();
      saveMedicalRecordForm($(this).parents('.input-group'));
    }
  });
  $('.js-add-custom').on('click', function(e){
    e.preventDefault();

    var template = $('.record-form-templates .custom-emergency-profile li').clone();
    var value    = $('input.js-custom-title').val();
    var errorMessage = '';
    var errorWrapper = $('.js-custom-title').parent().parent();

    $('.has-error.alert-danger', errorWrapper).remove();
    if (value) {
      var item_exist = false;
      $('.list-group-item .item-name').each(function(){
        if ($(this).text() == value){
          item_exist = true;
        }
      });
      if (!item_exist){
        $('.item-name', template).html(value);

        var id = 'record-form-emergency-profile-items-eye-custom-' + value.toLowerCase().replace(/[^a-zA-Z0-9]+/g, "-");

        $('input[type=checkbox]:first', template).val(value).prop('id', id);
        $('label.checkbox-type-eye', template).prop('for', id);
        $('input[type=hidden]:last', template).val(value);
        $('[data-toggle="tooltip"]', template).tooltip();

        var list = $('.list-group:first', '#emergencyCheckboxes');
        $('.list-group', '#emergencyCheckboxes').each(function(){
          if ($('.list-group-item', list).length > $('.list-group-item', this).length){
            list = $(this);
          }
        });
        $(list).append(template);

        $('input.js-custom-title').val('').focus();
        saveMedicalRecordForm($(this).parents('.input-group'));
        return;
      } else { errorMessage = 'Item already exists'; }
    } else { errorMessage = 'Item cannot be empty'; }
    $(errorWrapper).append('<div class="has-error alert alert-danger">'+errorMessage+'</div>');
  });
  setTimeout(function(){
    $(document).on('change.record-form', '.medicalRecordForm select, .medicalRecordForm input' ,function(){
      var el = $(this).siblings('label');
      el = (el.length > 0)?el:$(this).parents('.input-group');
      el = (el.length > 0)?el:$(this);
      saveMedicalRecordForm(el);
    });
  }, 1000);
  $('#recordform-weight', '.medicalRecordForm').on('keyup', function(){
    saveMedicalRecordForm($(this).parents('.input-group'));
  });
  $('.collapsator input').on('change', function(e){
    var wrapper = $(this).parents('.collapsator').data('target');
    if ($(this).is(':checked')) $(wrapper).show();
    else $(wrapper).hide();
  }).change();
  $(document).on('click', '.js-restore-custom', function(e){
    e.preventDefault();
    var template = $('.record-form-templates .custom-emergency-profile li').clone();
    var value    = $(this).data('title');

    var id = 'record-form-emergency-profile-items-eye-custom-' + value.toLowerCase().replace(/[^a-zA-Z0-9]+/g, "-");

    $('.item-name', template).html(value);
    $('input[type=checkbox]:first', template).val(value).prop('id', id);
    $('label.checkbox-type-eye', template).prop('for', id);
    $('input[type=hidden]:last', template).val(value);
    $('[data-toggle="tooltip"]', template).tooltip();
    $(this).parents('li.list-group-item').replaceWith(template);
    var el = $(template);

    saveMedicalRecordForm(el);
  });
  $(document).on('click', '.js-remove-profile-item', function(e){
    e.preventDefault();
    var el = $(this).parents('.list-group-item');

    var title = $(this).parents('.list-group-item').find('.item-name').html();
    var template = $('.record-form-templates .removed-profile-item').clone();
    $('.item-title', template).html(title);
    $('.js-restore-custom', template).data('title',title);

    $(this).parents('.list-group-item').html(template);
    saveMedicalRecordForm(el);
  });
  $(document).on('click', '.js-remove-physicians-item', function(e){
    e.preventDefault();
    var el = this;
    $.get('/subscriber-home/del-physician?id='+$(this).data('id'), function(data){
      if (data.result) {
        $(el).parents('.list-group-item').remove();
      }
    });
  });
  $(document).on('click', '.js-remove-emergency-contact-item', function(e){
    e.preventDefault();
    var el = this;
    $.get('/subscriber-home/del-emergency-contact?id='+$(this).data('id'), function(data){
      if (data.result) {
        $(el).parents('.list-group-item').remove();
        if ($('#medicalRecordForm-emergency-contacts .list-group:first li').length > 0){
          $('#medicalRecordForm-emergency-contacts .js-null-mesage').addClass('hidden');
        } else {
          $('#medicalRecordForm-emergency-contacts .js-null-mesage').removeClass('hidden');
        }
      }
    });
  });
  $('.buttons-wrapper.enable-wrapper input').on('change', function(){
    var eye_wrapper = $(this).parents('.list-group-item').find('.eye-wrapper');

    if ($(this).is(':checked')){
      $(eye_wrapper).removeClass('hidden');
    } else {
      $(eye_wrapper).addClass('hidden');
    }
  });
  $(document).on('change, click', '.collapser', function(){
    var target = $(this).data('collapse-target');

    if ($(this).is(':checkbox')){
      if ($(this).is(':checked')){
        $(target).not('.state').removeClass('hidden');
      } else {
        $(target).not('.state').addClass('hidden');
      }
    } else {
      $(target).not('.state').toggleClass('hidden');
    }
    $(target).filter('.state').toggleClass('hidden');
  });
  $('form.addPhysicianForm').on({
    'beforeSubmit': function(e){
      e.preventDefault();
      saveMedicalRecordForm($(this).find('input:first'), true);
    },
    'after-submit': function(e, data){
      if (data.result){
        var left = $('#medicalRecordForm-physicians .list-group:first');
        var right = $('#medicalRecordForm-physicians .list-group:last');
        var ul = ($('li', left).length > $('li', right).length)?right:left;

        $(ul).append(data.content);
        $('#addPhysicianForm').trigger("reset");
      } else {
        console.log(data);
      }
    }
  });
  $('form.addEmergencyContactForm').on({
    'beforeSubmit': function(e){
      e.preventDefault();
      saveMedicalRecordForm($(this).find('button:first'), true);
      return false;
    },
    'after-submit': function(e, data){
      if (data.result){
        $('#medicalRecordForm-emergency-contacts .list-group:first').append(data.content);
        $('#addEmergencyContactForm').trigger("reset");
        if ($('#medicalRecordForm-emergency-contacts .list-group:first li').length > 0){
          $('#medicalRecordForm-emergency-contacts .js-null-mesage').addClass('hidden');
        } else {
          $('#medicalRecordForm-emergency-contacts .js-null-mesage').removeClass('hidden');
        }
      } else {
        console.log(data);
      }
    }
  });

  function saveMedicalRecordForm(el, immediately){
    console.log(el);
    if ($(el).hasClass('js-no-autosave')) return;
    var timeout = immediately?1:getTimeout();
    queueCounter++;
    var form = $(el).parents('form');
    if (form) {
      var data = form.blur().serializeArray();
      if (!queue[form.attr('action')]){
        queue[form.attr('action')] = [];
      }
      queue[form.attr('action')].push({
        data    : data,
        url     : form.attr('action'),
        parent  : '#'+$(form).attr('id'),
        el      : el
      });
    }
    $(document).trigger('messageOpen', { el: el, parent: '#'+$(form).attr('id') });
    clearTimeout(saveTimeOut);
    saveTimeOut = setTimeout(function(){
      var local_queue = jQuery.extend(true, {}, queue);
      for(var href in local_queue){
        $.ajax({
          type: "POST",
          url: href,
          data: { queue : JSON.stringify(local_queue[href]) },
          success: function(returnData){
            for(var oneEl in local_queue[href]){
              $(document).trigger('messageOk', { 'text': 'The data is saved successfully.', el: local_queue[href][oneEl].el });
            }
            delete local_queue[href];
            $(form).trigger('after-submit', returnData);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            for(var oneEl in local_queue[href]){
              $(document).trigger('messageError', { 'text': 'The data saving <strong>FAILED</strong>', el: local_queue[href][oneEl].el });
            }
            delete local_queue[href];
          }
        });
        queueCounter = 1;
      }
      queue = [];
    }, timeout);
  }

  function getTimeout(){
    var timeout = 750;
    if (queueCounter > 1) timeout = 1000 + 200*queueCounter;
    if (queueCounter > 5) timeout = 2000;
    return timeout;
  }

});

// /subscriber-home/record
// /subscriber-home/add-emergency-contact