<?php
use_helper('jQuery');
?>
<script type="text/javascript">
jQuery(function($) {
  $.each(
    ["<?php echo implode('","', $field_names->getRawValue()) ?>"],
    function (i, field) {
      $("form :input[name='<?php echo $form->getName() ?>[" + field + "]']").bind('blur', function(ev) {
        var self = this;
        $.getJSON("<?php echo url_for("@ajax", array('form' => get_class($form))) ?>",
            {field: field, value: $(self).val()}, function(data) {
          $(self).prev(".error_list").remove();
          if (typeof data == 'string') {
            $(self).before("<ul class=\"error_list\"><li>" + data + "</li></ul>")
          }
        });
      });
    }
  );
});
</script>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
    <div class="fg-toolbar ui-widget-header ui-corner-all">
        <h1>Nová registrace</h1>
    </div>

    <div class="sf_admin_flashes ui-widget">

        <div class="error ui-state-error ui-corner-all">
            <span class="ui-icon ui-icon-alert floatleft"></span>&nbsp;
            Položka nebyla uložena kvůli chybám.  </div>
    </div>

    <div id="sf_admin_header">
    </div>

    <div id="sf_admin_content">

        <div class="sf_admin_form">
            <form method="post" action="<?php echo url_for('@post_reg');?>">
                <div class="sf_admin_actions_block ui-widget">
                    <ul class="sf_admin_actions_form">
                        <li class="sf_admin_action_save"><button type="submit" class="fg-button ui-state-default fg-button-icon-left"><span class="ui-icon ui-icon-circle-check"></span>Registrovat</button></li></ul>    </div>

                <div class="ui-helper-clearfix"></div>

                <input type="hidden" name="registration[id]" value="" id="registration_id" /><input type="hidden" name="registration[_csrf_token]" value="ba44190971147a7a939ff0f338855235" id="registration__csrf_token" />




                <div id="sf_admin_form_tab_menu">

                    <div id="sf_fieldset_none" class="ui-corner-all">
                        <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_name ui-state-error ui-corner-all">
                            <div class="label ui-helper-clearfix">
                                <label for="registration_name">Název organizace</label>
                                <div class="help">
                                    <span class="ui-icon ui-icon-help floatleft"></span>
                                    Registrační název organizace nebo uživatele        </div>
                            </div>

                            <input type="text" name="registration[name]" value="ahoj" id="registration_name" />
                            <div class="errors">
                                <span class="ui-icon ui-icon-alert floatleft"></span>
                                <ul class="error_list">
                                    <li>Required.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_domain ui-state-error ui-corner-all">
                            <div class="label ui-helper-clearfix">
                                <label for="registration_domain">název v url adrese</label>
                                <div class="help">
                                    <span class="ui-icon ui-icon-help floatleft"></span>
                                    Tímto názvem bude tvořena Vaše URL adresa        </div>
                            </div>

                            <input type="text" name="registration[domain]" value="sex" id="registration_domain" />
                            <div class="errors">
                                <span class="ui-icon ui-icon-alert floatleft"></span>
                                <ul class="error_list">
                                    <li>Required.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_email">
                            <div class="label ui-helper-clearfix">
                                <label for="registration_email">e-mail</label>
                                <div class="help">
                                    <span class="ui-icon ui-icon-help floatleft"></span>
                                    na tento e-mail Vám zašleme ověřovací e-mail pro pokračování v registraci        </div>
                            </div>

                            <input type="text" name="registration[email]" value="damekjan74@gmail.com" id="registration_email" />
                        </div>
                    </div>
                </div>


                <div class="sf_admin_actions_block ui-widget ui-helper-clearfix">
                    <ul class="sf_admin_actions_form">
                        <li class="sf_admin_action_save"><button type="submit" class="fg-button ui-state-default fg-button-icon-left"><span class="ui-icon ui-icon-circle-check"></span>Registrovat</button></li></ul>    </div>

            </form>
        </div>
    </div>

    <div id="sf_admin_footer">
    </div>

</div>

<?php
