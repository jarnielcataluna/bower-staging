<?php

namespace Nestle\CoreBundle\AuthenticationHandler;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

use Nestle\CoreBundle\Model\NestleUsers;
use Nestle\CoreBundle\Model\NestleUsersQuery;

class LoginHandler implements AuthenticationSuccessHandlerInterface
{
	protected $router;
    protected $security;
    
    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
    	$response = new RedirectResponse($this->router->generate('error403'));

    	if (isset($token)) {
    		if (($request->request->get('_username') === 'superadmin' && $request->request->get('_password') === '123nestleBOW@@')) {
    			$refererUrl = $request->getSession()->get('_security.secured_area.target_path');
                
                if ($refererUrl == null) {
                    $refererUrl = $this->router->generate('nestle_web_homepage');
                }
                
                $response = new RedirectResponse($refererUrl);
    		} else {
            	$refererUrl = $request->getSession()->get('_security.secured_area.target_path');

            	if ($token->getUser() instanceof NestleUsers) {
            		$refererUrl = $this->router->generate('nestle_web_homepage');
            	}

            	$response = new RedirectResponse($refererUrl);
            }
    	}

        return $response;
    }
}

?>