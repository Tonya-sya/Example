function charge(){
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    require_once(get_theme_root().'....init.php');

    \Stripe\Stripe::setApiKey('sk_test_.....');
    $token = $_POST['stripeToken'];
if(!$_REQUEST['guests']){
	$guest = $_REQUEST['guest'];
	} else {
		$guest = $_REQUEST['guests'];
	}
    $charge = \Stripe\Charge::create([
        'amount' => $_REQUEST['price'],
        'currency' => $_REQUEST['currency'],
        'description' => $_REQUEST['postid'],
        'source' => $token,
    ]);
    $intent = \Stripe\PaymentIntent::create([
        'amount' => $_REQUEST['price'],
        'currency' => 'usd',

    ]);
    $cache_key = 'booking_guesty_oauth_token';
    $booking_guesty_oauth_token = get_transient( $cache_key );

    if ( $booking_guesty_oauth_token == false ) {
        $args = array(
            'headers' => [
                'accept' => 'application/json; charset=utf-8',
                'cache-control' => 'no-cache,no-cache',
                'Content-Type' =>  'application/x-www-form-urlencoded',
            ],
            'body'  => array(
                'grant_type' => 'client_credentials',
                'scope' => 'booking_engine:api' ,
                'client_secret' => '.....',
                'client_id' => '.....',
            ),
        );
        $book_url = 'https://booking.guesty.com/oauth2/token';
        $result = wp_remote_post( $book_url , $args );
        $result_json = json_decode($result['body']);
        $booking_guesty_oauth_token = $result_json->access_token;

        $cache_lifetime = strtotime('12 hour', 0);
        set_transient( $cache_key, $booking_guesty_oauth_token, $cache_lifetime );
    }
    $product_id = $_REQUEST['postid'];
    $auth = 'authorization: Bearer ' . $booking_guesty_oauth_token;
    $tok_args = [
        'reservation' => [
            'listingId' => $product_id,
            'checkInDateLocalized' => $_REQUEST['start_date'],
            'checkOutDateLocalized' => $_REQUEST['end_date'],
            'guestsCount' => $guest,
        ],
        'guest' => [
            'firstName' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'phone' => $_REQUEST['phone'],
        ],
        'policy' => [
            'privacy' => [
                'version' => 0,
                'dateOfAcceptance' => '2022-05-03T14:32:25.638Z',
                'isAccepted' => true,
            ],
            'termsAndConditions' => [
                'version' => 0,
                'dateOfAcceptance' => '2022-05-03T14:32:25.638Z',
                'isAccepted' => true,
            ],
            'marketing' => [
                'dateOfAcceptance' => '2022-05-03T14:32:25.638Z',
                'isAccepted' => true,
            ],
        ],
        'payment' => [
            'token' => $token,
        ],
    ];

    $curl = curl_init();

     curl_setopt_array($curl, [
        CURLOPT_URL => "https://booking.guesty.com/api/reservations",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>   json_encode($tok_args),
        CURLOPT_HTTPHEADER => [
            "Accept: application/json; charset=utf-8",
            "Content-Type: application/json",
            $auth
        ],
    ]);

   $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
        echo $response;
        header("Location: ...../success?guests=" . $_REQUEST['guests'] . "&dates=". $_REQUEST['dates'] . "&image_id=". $_REQUEST['image_id'] . "&title=". $_REQUEST['title']);
    }

    die;
}
add_action("wp_ajax_my_charge", "charge");
add_action("wp_ajax_nopriv_charge", "charge");
