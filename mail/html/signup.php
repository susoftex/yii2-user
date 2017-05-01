<?php
/**
 * @author Yuriy Basov <basowy@gmail.com>
 * @since 1.0.0
 */


use yii\helpers\Html;
?>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="free-text">
                <b><?= Yii::$app->name; ?> Sign up Request</b>
            </td>
          </tr>
          <tr>
            <td class="mini-block-container">
              <table cellspacing="0" cellpadding="0" width="100%"  style="border-collapse:separate !important;">
                <tr>
                  <td class="mini-block">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td>
                          <table cellspacing="0" cellpadding="0" width="100%">

                            <tr>
                              <td class="user-msg">
                                    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
                                        <?= Yii::t('app', 'Hello') ?>,
                                    </p>
                                    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
                                        <?= Yii::t('app', 'Thank you for signing up on {0}', Yii::$app->name) ?>.
                                        <?= Yii::t('app', 'In order to complete your registration, please click the link below') ?>.
                                    </p>
                                    <p>                            

                                          <div><!--[if mso]>
                                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:155px;" arcsize="15%" strokecolor="#ffffff" fillcolor="#ff6f6f">
                                              <w:anchorlock/>
                                              <center style="color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;">Sign Up</center>
                                            </v:roundrect>
                                          <![endif]--><a href="<?= $url?>" style="background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Sign Up</a></div>

                                    </p>                                   
                                    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
                                        <?= Yii::t('app', 'If you cannot click the link, please copy and paste the text into your browser') ?>.
                                    </p>


                                    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
                                        <?= Html::a($url, $url)."<BR>"; ?>
                                    </p>                                  

                                    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
                                        <?= Yii::t('app', 'If you did not make this request you can ignore this email') ?>.
                                    </p>
                              </td>
                            </tr>
                          </table>
                        </td>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>