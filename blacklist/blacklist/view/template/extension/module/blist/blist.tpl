<?= $header; ?>
<?= $column_left; ?>  
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-blist" data-toggle="tooltip" title="<?= $button_save; ?>" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
        <a href="<?= $cancel; ?>" data-toggle="tooltip" title="<?= $button_cancel; ?>" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></a></div>
        <ul class="breadcrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <li><a href="<?= $breadcrumb['href']; ?>"><?= $breadcrumb['text']; ?></a></li>
          <?php } ?>
        </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php foreach (['error_warning', 'error_connected'] as $name) { ?>
      <?php if (!empty($$name)) { ?>
      <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i> <?= $$name; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php } ?>
    <?php } ?>    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?= $text_settings; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="form-blist" class="form-horizontal">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?= $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="blist_status" id="input-status" class="form-control">
                    <option value="1"<?= $blist_status  ? ' selected="selected"' : ''; ?>><?= $text_enabled;  ?></option>
                    <option value="0"<?= !$blist_status ? ' selected="selected"' : ''; ?>><?= $text_disabled; ?></option>
                  </select>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-base-type"><?= $entry_base_type; ?></label>
                <div class="col-sm-10">
                  <select name="blist_database" id="input-base-type" class="form-control">
                    <option value="store"<?= $blist_database    == 'store'    ? ' selected="selected"' : ''; ?>><?= $text_db_store;    ?></option>
                    <option value="external"<?= $blist_database == 'external' ? ' selected="selected"' : ''; ?>><?= $text_db_external; ?></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-base-type"><?= $entry_external_server; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="blist_database_settings[hostname]" value="<?= isset($blist_database_settings['hostname']) ? 
                    $blist_database_settings['hostname'] : ''; ?>" class="form-control">
                  <?php if (!empty($error_hostname)) { ?>
                    <div class="text-danger"><?= $error_hostname; ?></div>
                  <?php } ?>                
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-base-type"><?= $entry_external_database; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="blist_database_settings[database]" value="<?= isset($blist_database_settings['database']) ? 
                    $blist_database_settings['database'] : ''; ?>" class="form-control">            
                  <?php if (!empty($error_database)) { ?>
                    <div class="text-danger"><?= $error_database; ?></div>
                  <?php } ?>                 
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-base-type"><?= $entry_external_port; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="blist_database_settings[port]" value="<?= isset($blist_database_settings['port']) ? 
                    $blist_database_settings['port'] : ''; ?>" class="form-control">                  
                </div>
              </div>                                            
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-base-type"><?= $entry_external_user; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="blist_database_settings[username]" value="<?= isset($blist_database_settings['username']) ? 
                  $blist_database_settings['username'] : ''; ?>" class="form-control">   
                  <?php if (!empty($error_username)) { ?>
                    <div class="text-danger"><?= $error_username; ?></div>
                  <?php } ?>                                  
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-base-type"><?= $entry_external_pwd; ?></label>
                <div class="col-sm-10">
                  <input type="password" name="blist_database_settings[password]" value="<?= isset($blist_database_settings['password']) ? 
                  $blist_database_settings['password'] : ''; ?>" class="form-control">          
                  <?php if (!empty($error_password)) { ?>
                    <div class="text-danger"><?= $error_password; ?></div>
                  <?php } ?>               
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <label class="control-label"><?= $text_email_ignore; ?></label><br><br>
              <textarea class="form-control" name="blist_email_ignore"><?= $blist_email_ignore; ?></textarea>
            </div>
          </div>
          <div class="modal fade" id="form-customer" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label"><?= $text_store; ?></label>
                    <input type="text" class="form-control" name="customer[store]">
                  </div>
                  <div class="form-group">
                    <label class="control-label"><?= $text_order; ?></label>
                    <input type="text" class="form-control" name="customer[order]">
                  </div>                  
                  <div class="form-group">
                    <label class="control-label"><?= $text_firstname; ?></label>
                    <input type="text" class="form-control" name="customer[firstname]">
                  </div>
                  <div class="form-group">
                    <label class="control-label"><?= $text_lastname; ?></label>
                    <input type="text" class="form-control" name="customer[lastname]">
                  </div>
                  <div class="form-group">
                    <label class="control-label"><?= $text_email; ?></label>
                    <input type="text" class="form-control" name="customer[email]">
                  </div>
                  <div class="form-group">
                    <label class="control-label"><?= $text_phone; ?></label>
                    <input type="text" class="form-control" name="customer[telephone]">
                  </div>                                                                                          
                  <div class="form-group">
                    <label class="control-label"><?= $text_comment; ?></label>
                    <textarea class="form-control" name="customer[comment]"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><?= $text_close; ?></button>
                  <button type="button" class="btn btn-primary save-modal-form"><?= $text_save; ?></button>
                </div>
              </div>
            </div>
          </div>          
        </form>
      </div>
    </div>
    <div class="alert alert-info">
      <?= $text_alert_info; ?>
    </div>
    <div id="list"></div>
  </div>
</div>
<?= $footer; ?>
<script type="text/javascript">
function editCustomer(self) 
{
  let id = $(self).data('id');

  $('#form-customer .alert').remove();
  $('#form-customer input[name="customer[blist_id]"]').remove();

  $.get('<?= $get_custmer; ?>&blist_id=' + id, (json) => {
    if (json.info) {
      let store     = $('#form-customer input[name="customer[store]"]'),
          order     = $('#form-customer input[name="customer[order]"]'),
          firstname = $('#form-customer input[name="customer[firstname]"]'),
          lastname  = $('#form-customer input[name="customer[lastname]"]'),
          email     = $('#form-customer input[name="customer[email]"]'),
          telephone = $('#form-customer input[name="customer[telephone]"]'),
          comment   = $('#form-customer textarea[name="customer[comment]"]');

      store.val(json.info.store); firstname.val(json.info.firstname); lastname.val(json.info.lastname);
      email.val(json.info.email); telephone.val(json.info.telephone); comment.val(json.info.comment); 
      order.val(json.info.order);
      
      $('<input type="hidden" name="customer[blist_id]" value="'+ id +'">').appendTo($('#form-customer'));
      
      $('#form-customer').modal('show');

      $('.save-modal-form').on('click', () => {
        let form = $('#form-blist').serialize();

         $('#form-customer .alert').remove();

        $.post('<?= $edit_customer; ?>&blist_id=' + id, form, (json2) => {
          if (json2.success) {
            let t_val = telephone.val();
            t_val = t_val.replace(/[^0-9]/g, '');

            let o_val = order.val();
            o_val = o_val.replace(/[^0-9]/g, '');            

            let f_val = firstname.val();
            f_val = f_val.replace(/[^а-яА-ЯЁёa-zA-Z\-\s]/g, '');

            let l_val = lastname.val();
            l_val = l_val.replace(/[^а-яА-ЯЁёa-zA-Z\-\s]/g, '');

            $('#bl-' + id + ' .store').text(store.val());
            $('#bl-' + id + ' .order').text(o_val);
            $('#bl-' + id + ' .firstname').text(f_val);
            $('#bl-' + id + ' .lastname').text(l_val);
            $('#bl-' + id + ' .email').text(email.val());
            $('#bl-' + id + ' .telephone').text(t_val);
            $('#bl-' + id + ' .comment').text(comment.val());

            //store.val(''); lastname.val(''); firstname.val(''); email.val(''); telephone.val(''); comment.val('');

            $('#form-customer').modal('hide');
            $('.save-modal-form').off();
            $('input[name="customer[blist_id]"]').remove(); 
          }

          if (json2.error) {
            for (let i in json2.error) {
              $('<div class="alert alert-danger">'+ json2.error[i] +'</div>').appendTo($('#form-customer .modal-body'));
            }
          }
        }, 'json');
      });
    }
  }, 'json');
}

function addCustomer() 
{
  $('#form-customer').modal('show');
  $('#form-customer .alert').remove();

  $('.save-modal-form').on('click', () => {
    let form = $('#form-blist').serialize();
    
    $.post('<?= $add_customer; ?>', form, (json) => {
      if (json.success) {
        $('#form-customer').modal('hide');
        $.get('<?= $list_action; ?>', (html) => {
          $('#list').html(html);
        }, 'html');
      }

      if (json.error) {
        for (let i in json.error) {
          $('<div class="alert alert-danger">'+ json.error[i] +'</div>').appendTo($('#form-customer .modal-body'));
        }
      }
    }, 'json');
  });
}

function deleteCustomer(self) 
{
  $.get('<?= $delate_customer; ?>&blist_id=' + $(self).data('id'), (json) => {
    if (json.success) {
      // $(self).closest('tr').remove();
      $.get('<?= $list_action; ?>', (html) => {
        $('#list').html(html);
      }, 'html').done(() => {
        $('html, body').animate({scrollTop: $('#list').offset().top}, 1000);
      });      
    }

    if (json.error) {
      let html = '';

      for (i in json.error) {
        html += `<div class="alert alert-danger">`+ json.error[i] +`</div>`;
      }

      $(self).closest('table').before(html);
    }
  }, 'json');
}

$('#form-customer').on('hide.bs.modal', () => {
  $('.save-modal-form').off();
  $('input[name="customer[blist_id]"]').remove();
  $('#form-customer .alert').remove();
  $('#form-customer input[name="customer[store]"]').val('');
  $('#form-customer input[name="customer[order]"]').val('');
  $('#form-customer input[name="customer[firstname]"]').val('');
  $('#form-customer input[name="customer[lastname]"]').val('');
  $('#form-customer input[name="customer[email]"]').val('');
  $('#form-customer input[name="customer[telephone]"]').val('');
  $('#form-customer textarea[name="customer[comment]"]').val('');
});

$(() => {
  let check = () => 
  {
    let type = $('select[name="blist_database"] option:checked').val();
  
    if (type != 'external') {
      $('input[name*=blist_database]').val('');
      $('.form-group').removeClass('has-error');
      $('.form-group .text-danger').remove(); 
    }

    $('input[name*=blist_database_settings]').prop('disabled', type != 'external')
  }
  
  $('select[name="blist_database"]').on('change', function() {
    check();
  });

  check();

  $.get('<?= $list_action; ?>', (html) => {
    $(html).appendTo($('#list'));
  }, 'html');

  $('body').on('click', '.pagination a', function (e) {
    e.preventDefault();
    $.get($(this).attr('href'), (html) => {
      $('#list').html(html);
    }, 'html').done(() => {
      $('html, body').animate({scrollTop: $('#list').offset().top}, 1000);
    });
  });
});
</script>
<style type="text/css">
.modal-body .form-group {
    margin: 0 !important;
}
</style>