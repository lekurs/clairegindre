<?php

namespace App\UI\Action\Security;

use App\Domain\Repository\Interfaces\GalleryRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

/**
 * Class UserAuthenticationGuard.
 *
 * @author GINDRE Maxime <gindre.maxime@gmail.com>
 */
class UserAuthenticationGuard extends AbstractFormLoginAuthenticator
{
    const ALLOWED_URL = ['login', 'galleriesCustomers'];
    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfToken;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var GalleryRepositoryInterface
     */
    private $galleryRepository;

    /**
     * UserAuthenticationGuard constructor.
     * @param CsrfTokenManagerInterface $csrfToken
     * @param UrlGeneratorInterface $urlGenerator
     * @param GalleryRepositoryInterface $galleryRepository
     */
    public function __construct(
        CsrfTokenManagerInterface $csrfToken,
        UrlGeneratorInterface $urlGenerator,
        GalleryRepositoryInterface $galleryRepository
    ) {
        $this->csrfToken = $csrfToken;
        $this->urlGenerator = $urlGenerator;
        $this->galleryRepository = $galleryRepository;
    }


    /**
     * @param Request $request
     * @return bool|void
     */
    public function supports(Request $request)
    {
        if (in_array($request->attributes->get('_route'), static::ALLOWED_URL) && 'POST' === $request->getMethod()) {

            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function getCredentials(Request $request)
    {
        return [
           'username' => $request->request->get('login')['username'],
            'password' => $request->request->get('login')['password'],
        ];
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return null|UserInterface|void
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (!$credentials['username'] || !$credentials['password']) {
            return;
        }

        return $userProvider->loadUserByUsername($credentials['username']);
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     * @return bool|void
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
//        dump($user->getPassword(), $credentials['password']);
//        die();
//        if ($user->getEmail() != $credentials['username'] || $user->getPassword() != $credentials['password']) {
//            return false;
//        }
        return true;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => 'Erreur d\'authentification',
        );

        return new Response($data['message'], Response::HTTP_FORBIDDEN);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return null|\Symfony\Component\HttpFoundation\Response|void
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if (in_array('ROLE_ADMIN', $token->getUser()->getRoles() )) {
            return new RedirectResponse($this->urlGenerator->generate('admin'));
        }
        elseif (in_array('ROLE_USER', $token->getUser()->getRoles())) {
            $galleries = $this->galleryRepository->getAllByUser($token->getUser()->getId());

            if (count($galleries) > 1) {
                foreach ($galleries as $gallery) {
                    
                    return new RedirectResponse($this->urlGenerator->generate('galleriesForCustomer', ['user' => strtolower($token->getUser()->getUsername()), 'slugGallery' => $gallery->getSlug()]));
                }
            } else {
                foreach ($galleries as $gallery) {

                    return new RedirectResponse($this->urlGenerator->generate('galleryCustomer', ['slugUser' => $token->getUser()->getSlug(), 'slugGallery' => $gallery->getSlug()]));
                }
            }
        }
        $token->getUser();
    }

    /**
     * @return bool
     */
    public function supportsRememberMe()
    {
        return false;
    }

    /**
     * @return string|void
     */
    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('login');
    }

    /**
     * @param Request $request
     * @param AuthenticationException|null $authException
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return parent::start($request, $authException); // TODO: Change the autogenerated stub
    }
}
