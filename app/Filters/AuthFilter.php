<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\M_volunteer;
use Config\Services;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return Services::response()->setJSON([
                'status' => 'error',
                'message' => 'Authorization header missing'
            ])->setStatusCode(401);
        }

        $token = str_replace('Bearer ', '', $authHeader);
        $volunteerModel = new M_volunteer();
        $volunteer = $volunteerModel->where('login_token', $token)->first();

        if (!$volunteer) {
            return Services::response()->setJSON([
                'status' => 'error',
                'message' => 'Invalid or expired token. Please login again.'
            ])->setStatusCode(401);
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

}
?>
