<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/saml")
 */
class SamlController extends Controller
{
    /**
     * @Route("/sso", name="app_saml_sso")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function singleSignOnAction(Request $httpRequest)
    {
        $idpProcessor = $this->get("adactive_sas_saml2_bridge.processor.hosted_idp");

        return $idpProcessor->processSingleSignOn($httpRequest);
    }

    /**
     * @Route("/sls", name="app_saml_sls")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function singleLogoutAction(Request $httpRequest)
    {
        $idpProcessor = $this->get("adactive_sas_saml2_bridge.processor.hosted_idp");

        return $idpProcessor->processSingleLogoutService($httpRequest);
    }

    /**
     * @Route("/metadata", name="app_saml_metadata", defaults={"_format"="xml"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function metadataAction()
    {
        $idpProcessor = $this->get("adactive_sas_saml2_bridge.processor.hosted_idp");

        return $idpProcessor->getMetadataXmlResponse();
    }
}