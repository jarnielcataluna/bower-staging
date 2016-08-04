<?php

namespace Nestle\CoreBundle\AuthenticationHandler;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Security\Core\SecurityContext;

use Nestle\CoreBundle\Model\NestleUsers;
use Nestle\CoreBundle\Model\NestleUsersQuery;

class LogoutHandler implements LogoutSuccessHandlerInterface
{
	protected $router;
    private $security;
    
    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function onLogoutSuccess(Request $request)
    {
    	if ($this->security->getToken()->getUser()->getPassword() != '9e54894425aee8a4e5c22a760358807534409594cf99bf4cc988735634cf0decb9f7bb4200d58d16c286ad1b82afd716e64d32578fa93848e8e000a1d126dab8') {
    		if ($this->security->getToken()->getUser() instanceof NestleUsers) {

    		}
    	}

    	// redirect the user to where they were before the login process begun.
        $referer_url = $request->headers->get('referer');
        
        if ($referer_url != null) {
            $response = new RedirectResponse($referer_url);
        } else {
            $response = new RedirectResponse('login');
        }
        
        return $response;
    }
}

?>