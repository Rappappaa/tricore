<?php

namespace App\Controller;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    private RedisService $redisService;
    private JWTTokenManagerInterface $JWTTokenManager;

    public function __construct(RedisService $redisService, JWTTokenManagerInterface $JWTTokenManager)
    {
        $this->redisService = $redisService;
        $this->JWTTokenManager = $JWTTokenManager;
    }

    public function index()
    {
        $redisKeys = $this->redisService->get('auth_permission_1');

        $redisKeys = $this->redisService->set('deneme', $redisKeys, 10);

        $redisKeys = $this->redisService->get('auth_permission_1');

        foreach (json_decode($redisKeys, true) as $item) {
            print_r($item);
            echo "<br>";
        }

        //$this->redisService->flushAll();

        return new Response();
    }

    public function loginUser()
    {
        // TODO buraya sonra bakılacak ya token üretilmezse yada user convert edilemezse???
        try{
            $user = new User();

            $user->setIdentification("11122233344");
            $user->setName("Kadir");
            $user->setSurname("YILDIRIM");

            $token = $this->JWTTokenManager->create($user);

            $refreshToken = bin2hex(random_bytes(64));

            $today = Date('Y-m-d H:i:s');
            $today = Date('Y-m-d H:i:s',strtotime("+1 months", strtotime($today)));
            $date = new \DateTime($today);
// TODO: çoklu oturumlarda ayrı refresh token tutmanın dışında çoklu oturum açılabiliyorsa burayı ona göre düzelticez
//            $removeRefreshToken = $this->refreshTokenManager->getLastFromUsername($user->getUserIdentifier());
//
//            if($removeRefreshToken !== null)
//                $this->refreshTokenManager->delete($removeRefreshToken);


            $response = [
                'user' => $user,
                'token' => $token,
                'refresh_token' => $refreshToken,
                'has_subscription' => null
            ];

            return new JsonResponse($response, 200);
        }catch (\Exception $exception)
        {
            return new JsonResponse($response, 401);
        }
    }
}