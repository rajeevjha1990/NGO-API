<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseAuthController extends Controller
{
    protected $request;
    protected $volunteerId;
    protected $volunteerData;
    protected $encrypter;
    //These methods no need authkey
    public $public_methods = ["login", "volunteer_register", "forgot_password", "reset_password", "user_login"];

      public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->encrypter = \Config\Services::encrypter();
        $this->request = $request;
        $currentMethod = $this->request->getUri()->getSegment(3); // correct

        if (in_array($currentMethod, $this->public_methods)) {
            return;
        }

        // -------- Auth check start --------
        $authKey = $this->request->getHeaderLine('VeronAuthkey');
        if (!$authKey) {
            $this->unauthorized("Authorization header missing.");
        }

        try {
            $binaryKey = hex2bin($authKey);
            $decrypted = $this->encrypter->decrypt($binaryKey);
            $data = json_decode($decrypted, true);

            if (!isset($data['id'])) {
                throw new \Exception("Invalid token structure.");
            }

            $this->volunteerId = $data['id'];
            $volunteerModel = new \App\Models\M_volunteer();
            $this->volunteerData = $volunteerModel->get_volunteer($this->volunteerId);
            if (!$this->volunteerData) {
                $this->unauthorized("Volunteer not found.");
            }

        } catch (\Throwable $e) {
            $this->unauthorized("Invalid token: " . $e->getMessage());
        }
        // -------- Auth check end ----------
    }
    protected function unauthorized($message = "Unauthorized")
    {
        echo json_encode(['err' => $message]);
        http_response_code(401);
        exit;
    }
}
