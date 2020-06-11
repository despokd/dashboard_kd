<?php
/**
 * inherits all necessary html <head> links and meta
 */

/**
 * Get current URL as in Browser
* @author K-Gun at stackoverflow
* @link https://stackoverflow.com/questions/14912943/how-to-print-current-url-path
*/
function get_current_url($strip = true) {
    static $filter, $scheme, $host, $port; 
    if ($filter == null) {
        $filter = function($input) use($strip) {
            $input = trim($input);
            if ($input == '/') {
                return $input;
            }

            // add more chars if needed
            $input = str_ireplace(["\0", '%00', "\x0a", '%0a', "\x1a", '%1a'], '',
                rawurldecode($input));

            // remove markup stuff
            if ($strip) {
                $input = strip_tags($input);
            }

            // or any encoding you use instead of utf-8
            $input = htmlspecialchars($input, ENT_QUOTES, 'utf-8');

            return $input;
        };

        $scheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME']
            : ('http'. (($_SERVER['SERVER_PORT'] == '443') ? 's' : ''));
        $host = $_SERVER['SERVER_NAME'];
        $port = ($_SERVER['SERVER_PORT'] != '80' && $scheme != 'https')
            ? (':'. $_SERVER['SERVER_PORT']) : '';
        }
    }

    return sprintf('%s://%s%s%s', $scheme, $host, $port, $filter($_SERVER['REQUEST_URI']));
}

?>

<!-- Meta -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- OpenGraph -->
<meta property="og:url"                content="<?php get_current_url(); ?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="Dashboard" />
<meta property="og:description"        content="Personal web dashboard with news, shortcuts, current time an weather forecast" />
<meta property="og:image"              content="<?php echo $_SERVER['HTTP_REFERER'] . "img/og_dashboard.png" />

<!-- Favicon -->
<link rel="icon" href="favicon.ico">

<!-- Google Font Ubuntu, Josefin Sans -->
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- Font Awesome 5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Darkmode.js -->
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.5/lib/darkmode-js.min.js"></script>
<script>
    new Darkmode().showWidget();
</script>

<!-- Axios for DVBjs -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Custom CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- Custom JS -->
<script src="js/script.js"></script>