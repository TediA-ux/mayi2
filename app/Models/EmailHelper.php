<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailHelper extends Model
{
    public static function getEmailHeader()
    {
        ob_start();
        ?>
        <div style="min-width:100%;background-color:#f6f7f9;margin:0;width:100%;color:#283951;font-family:'Helvetica','Arial',sans-serif;padding: 60px 0;">
        <div style="background: #FFF;max-width: 600px; width: 100%; margin: 0 auto; overflow: hidden; color: #000; font:400 16px/26px 'Open Sans', Arial, Helvetica, sans-serif;">
            <div id="tg-banner" class="tg-banner" style="width: 100%; float: left; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <img style="width: 100%; height: auto; display: block;" src="http://code316.prophetelvis.com/assets/images/ebanner.jpg" alt="CODE316">
		    </div>
		<div style="width: 100%; float: left; padding: 30px 30px 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
			<div style="width: 100%; float: left; padding: 0 0 60px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <div style="width: 100%; float: left;">
        <?php
        return ob_get_clean();
    }

    /**
     * Get email footer
     *
     * @access public
     *
     * @return mixed
     */
    public static function getEmailFooter()
    {
        ob_start();
        $copyright = 'Copyright Silver Fleet All Rights Reserved';
        ?>
        </div>
        </div>
        </div>
            <div style="width:100%;float:left;background: #222222;padding: 30px 15px;text-align:center;box-sizing:border-box;border-radius: 0  0 5px 5px;">
                <p style="font-size: 13px; line-height: 13px; color: #fff; margin: 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <?php echo $copyright; ?> <a href="<?php url('/'); ?>" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; color: #fff; margin: 0; padding: 0;">Code 3:16</a></p>
            </div>
        </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Get site title
     *
     * @access public
     *
     * @return mixed
     */
    public static function getSiteTitle()
    {
        $title = 'CODE 3:16';
        return $title;
    }

    /**
     * Get email from name
     *
     * @access public
     *
     * @return mixed
     */
    public static function getEmailFrom()
    {
        $email = 'no-reply@prophetelvis.com';
        return $email;
    }

    /**
     * Get email id
     *
     * @access public
     *
     * @return mixed
     */
    public static function getEmailID()
    {
        $email_id = 'CODE 3:16';
        return $email_id;
    }

    /**
     * Get site logo
     *
     * @access public
     *
     * @return mixed
     */
    public static function getSiteLogo()
    {
        return url('http://code316.prophetelvis.com/assets/images/logo-sm.png');
    }

    /**
     * Get email signature
     *
     * @access public
     *
     * @return mixed
     */
    public static function getSignature()
    {
        ob_start();
        ?>
        <div style="width: 100%; float: left; padding: 15px 0 0; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <div style="float: left; border-radius: 5px; overflow: hidden; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <img style="display: block;" src="<?php echo Self::getSiteLogo(); ?>" alt="<?php echo Self::getSiteTitle(); ?>">
            </div>
            <div style="overflow: hidden; padding: 0 0 0 20px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                <p style="margin: 0 0 7px; font-size: 14px; line-height: 14px; color: #000; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Regards</p>
                <h2 style="font-size: 18px; line-height: 18px; margin: 0 0 5px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; color: #333; font-weight: normal;font-family: 'Work Sans', Arial, Helvetica, sans-serif;">Code 3:16</h2>
                <p style="margin: 0 0 7px; font-size: 14px; line-height: 14px; color: #000; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Yours Admin</p>
                <p style="margin: 0; font-size: 14px; line-height: 14px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a style=" color: #55acee; text-decoration: none;" href="http://code316.prophetelvis.com">http://code316.prophetelvis.com</a></p>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

}
