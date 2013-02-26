<?php

function wp2cloud_validate_cdn_url($wp2cloud_cdn)
{
    if (!$wp2cloud_cdn)
        return true;

    $wp2cloud_cdn_url = (strpos($wp2cloud_cdn, "://") === false ? "wp2cloud://" : "").$wp2cloud_cdn;

    return filter_var($wp2cloud_cdn_url, FILTER_VALIDATE_URL);
}

//--------
// Plugin settings page.
function wp2cloud_settings()
{
    if(!empty($_POST['submit']))
    {
        //--------
        // Update settings.
        $wp2cloud_cdn = $_POST['wp2cloud_cdn'];
        $wp2cloud_cdn_html = htmlspecialchars($wp2cloud_cdn);

        if (!wp2cloud_validate_cdn_url($wp2cloud_cdn))
        {
            echo '<div id="error" class="error"><p>Invalid Distribution URL: '.$wp2cloud_cdn_html.'</p></div>';
        }
        else
        {
            $options = array('cdn' => $wp2cloud_cdn);
            update_option('wp2cloud', $options);
            echo '<div id="message" class="updated"><p>Settings updated.</p></div>';
        }
    }
    else
    {
        //--------
        // Get settings.
        $options = get_option('wp2cloud');
        $wp2cloud_cdn = $options['cdn'];
        $wp2cloud_cdn_html = htmlspecialchars($wp2cloud_cdn);
    }

    //--------
    // Display settings page.
    $icon_html = screen_icon('options-general');

    print <<<EOT
    <div class="wrap">
        $icon_html <h2>WordPress to Cloud Settings</h2>
        <form method="POST">
            <h3>Content Distribution Network (CDN)</h3>

            <p>
            You can setup a CDN (e.g. <a href="http://aws.amazon.com/cloudfront/">Amazon CloudFront</a>)
            for media files to make content delivery even faster.  To do so, please specify the distribution
            URL that would be used instead of the <em>host/bucket</em> part of the cloud storage location.
            For example, if your cloud storage location looks like <em>s3.amazonaws.com/oblaksoft-yapixx/db0</em>
            and the distribution URL looks like <em>d111111abcdef8.cloudfront.net</em>, the media files
            would have URLs like <em>http://d111111abcdef8.cloudfront.net/db0/path/to/foo.jpg</em>.  You
            need to confugre the CDN to point it to the cloud storage origin location.
            </p>

            <table class="form-table">
            <tbody><tr valign="top">
                <th scope="row"><label for="wp2cloud_cdn">Distribution URL</label></th>
                <td><input name="wp2cloud_cdn" type="text" id="wp2cloud_cdn" value="$wp2cloud_cdn_html" class="regular-text code">
                <p class="description">E.g. <code>d111111abcdef8.cloudfront.net</code></p>
                </td>
            </tr>
            </tbody></table>

            <p class="submit">
                <input type="submit" name="submit" class="button-primary" value="Save Changes">
            </p>
        </form>
    </div>
EOT;
}

?>
