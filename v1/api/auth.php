<?PHP
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use \Firebase\JWT\JWT;

class Auth
{
    public string $key = "PrivateNayzacKey@2021";
    private string $issuer = "https://nayzac.online";
    private string $audiance = "https://nayzac.online";
    private $issueTimestamp;
    private array $payload;
    private $tokenExpiration;
    private array $userdata;
    private $JWToken;
    private $RefreshToken;
    private PDO $conn;
    public function __construct()
    {
        require $_SERVER['DOCUMENT_ROOT'] . '/database/db.php';
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function login(array $userdata)
    {
        if ($this->validateUser($userdata)) {
            $tokens = $this->issueToken();
            header('content-type:application/json');
            setcookie('refresh_token', $tokens['refresh'], time() + 60 * 60);
            http_response_code(202);
            array_push($tokens, "http://localhost/decode.php?token=" . $tokens['jwt']);
            $response = $this->generateResponse(202, "User authenticated successfuly", $tokens);
            echo json_encode($response);
        } else {
            header('content-type:application/json');
            setcookie('refresh_token', '', time() - 99999);
            http_response_code(404);
            $response = $this->generateResponse(404, "Couldn't authenticate user", null);
            echo json_encode($response);
        }
    }

    public function decodeToken($token): void
    {
        $decodedData = JWT::decode($token, $this->key, array('HS256'));
        $response = $this->generateResponse("200", "Here's the data", $decodedData);
        header('content-type:application/json');
        echo json_encode($response);
        return;
    }

    private function generateResponse($code, $msg, $data): array
    {
        return array(
            "code" => $code,
            "msg" => $msg,
            "data" => $data
        );
    }

    private function validateUser(array $userdata): bool
    {
        $validated = false;
        $sql = "SELECT * FROM `users` WHERE `email`=:email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $userdata['email']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $validated = hash_equals($user['password'], $userdata['password']);
            if ($validated) :
                $this->userdata = $user;
            endif;
        }
        return $validated;
    }

    private function issueToken(): array
    {
        $this->issueTimestamp = time();
        $this->tokenExpiration = $this->issueTimestamp + 60 * 60;
        $this->payload = array(
            "iss" => $this->issuer,
            "aud" => $this->audiance,
            "iat" => $this->issueTimestamp,
            "exp" => $this->tokenExpiration,
            "userdata" => $this->userdata,
        );
        $this->JWToken = JWT::encode($this->payload, $this->key, 'HS256');
        $this->RefreshToken = JWT::encode($this->JWToken, $this->key, 'HS256');
        $tokens = array(
            "jwt" => $this->JWToken,
            "refresh" => $this->RefreshToken,
        );
        return $tokens;
    }
}
