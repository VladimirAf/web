<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } else if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-about"><?php echo $tab_about; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
       <div id="tab-general">
       <h2>Данные отправителя</h2>
        <table class="form">
          <tr>
            <td><?php echo $entry_name; ?></td>
            <td>
              <input type="text" name="rpb_from_name" value="<?php echo $rpb_from_name; ?>" size="60" /><br><?php echo $text_from_name; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_address_1; ?></td>
            <td>
              <input type="text" name="rpb_from_address_1" value="<?php echo $rpb_from_address_1; ?>" size="60" /><br><?php echo $text_from_address_1; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_address_2; ?></td>
            <td>
              <input type="text" name="rpb_from_address_2" value="<?php echo $rpb_from_address_2; ?>" size="60" /><br><?php echo $text_from_address_2; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_postindex; ?></td>
            <td>
              <input type="text" name="rpb_postindex" value="<?php echo $rpb_postindex; ?>" size="10" /><br><?php echo $text_postindex; ?>
            </td>
          </tr>
        </table>
        <h2>Предъявленный документ</h2>
        <table class="form">
          <tr>
            <td><?php echo $entry_doc_type; ?></td>
            <td>
              <input type="text" name="rpb_doc_type" value="<?php echo $rpb_doc_type; ?>" size="30" /><br><?php echo $text_doc_type; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_doc_serial; ?></td>
            <td>
              <input type="text" name="rpb_doc_serial" value="<?php echo $rpb_doc_serial; ?>" size="10" /><br><?php echo $text_doc_serial; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_doc_num; ?></td>
            <td>
              <input type="text" name="rpb_doc_num" value="<?php echo $rpb_doc_num; ?>" size="10" /><br><?php echo $text_doc_num; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_doc_date; ?></td>
            <td>
              <input type="text" name="rpb_doc_date" value="<?php echo $rpb_doc_date; ?>" size="10" /><br><?php echo $text_doc_date; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_doc_received_by; ?></td>
            <td>
              <input type="text" name="rpb_doc_received_by" value="<?php echo $rpb_doc_received_by; ?>" size="50" /><br><?php echo $text_doc_received_by; ?>
            </td>
          </tr>
        </table>
        
        <h2>Наложка в адрес юр лица</h2>
        <table class="form">
          <tr>
            <td><?php echo $entry_inn; ?></td>
            <td>
              <input type="text" name="rpb_inn" value="<?php echo $rpb_inn; ?>" size="30" /><br><?php echo $text_rpb_inn; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_bik; ?></td>
            <td>
              <input type="text" name="rpb_bik" value="<?php echo $rpb_bik; ?>" size="10" /><br><?php echo $text_bik; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_correspondent_account; ?></td>
            <td>
              <input type="text" name="rpb_correspondent_account" value="<?php echo $rpb_correspondent_account; ?>" size="50" /><br><?php echo $text_correspondent_account; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_current_account; ?></td>
            <td>
              <input type="text" name="rpb_current_account" value="<?php echo $rpb_current_account; ?>" size="50" /><br><?php echo $text_current_account; ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_bank_name; ?></td>
            <td>
              <input type="text" name="rpb_bank_name" value="<?php echo $rpb_bank_name; ?>" size="50" /><br><?php echo $text_bank_name; ?>
            </td>
          </tr>
        </table>

        
       </div>
       <div id="tab-about">
        <table class="form">
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="rupost_blanks_status">
                <?php if ($rupost_blanks_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
              <input type="hidden" name="rpb_installed" value="1" />
            </td>
          </tr>
          <tr>
            <td style="min-width:200px;"><?php echo $text_ext_name; ?></td>
            <td style="min-width:400px;"><?php echo $ext_name; ?></td>
            <td rowspan="7" style="width:440px;border-bottom:0px;"><img src="view/image/es/extension_logo.png" /></td>
          </tr>
          <tr>
            <td><?php echo $text_ext_version; ?></td>
            <td><b><?php echo $ext_version; ?></b> [ <?php echo $ext_type; ?> ]</td>
          </tr>
          <tr>
            <td><?php echo $text_ext_compat; ?></td>
            <td><?php echo $ext_compatibility; ?></td>
          </tr>
          <tr>
            <td><?php echo $text_ext_url; ?></td>
            <td><a href="<?php echo $ext_url; ?>" target="_blank"><?php echo $ext_url ?></a></td>
          </tr>
          <tr>
            <td><?php echo $text_ext_support; ?></td>
            <td>
              <a href="mailto:<?php echo $ext_support; ?>?subject=<?php echo $ext_subject; ?>"><?php echo $ext_support; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
              <a href="<?php echo $ext_support_forum; ?>"><?php echo $text_forum; ?></a>
              <a href="view/static/bull5-i_rpb_extension_help.htm" id="help_notice" style="float:right;"><?php echo $text_asking_help; ?></a>
            </td>
          </tr>

          <tr>
            <td style="border-bottom:0px;"></td>
            <td style="border-bottom:0px;"></td>
          </tr>
        </table>
       </div>
      </form>
    </div>
  </div>
</div>
<div id="legal_text" style="display:none"></div>
<div id="help_text" style="display:none"></div>
<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script>
<?php echo $footer; ?>