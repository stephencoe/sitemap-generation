<?php

namespace Sitemap\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\ServiceManager\ServiceLocatorAwareInterface,
    Zend\ServiceManager\ServiceLocatorInterface;


class SitemapController extends AbstractActionController implements ServiceLocatorAwareInterface
{

    /**
     * @var ServiceLocatorInterface
     * */
    protected $serviceLocator;

    /**
     *
     * @var Sitemap\Service\Sitemap
     * 
     **/

    protected $sitemapService;

    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setVariables( [ 'pages' => ''] );

        return $viewModel;
    }

    public function rebuildAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $this->getSitemapService()->rebuild();
        return $viewModel;
    }

    public function renderxmlAction()
    {
        $this->getResponse()
            ->getHeaders()
            ->addHeaders(array('Content-type' => 'text/xml')); 

        $viewModel = new ViewModel();
        $viewModel->setVariables( [ 'pages' => ''] )
              ->setTerminal(true);

        return $viewModel;//$this->getSitemapService()->getBuiltSitemap() ];
    }
    

    /**
    *
    * Getters & setters
    *
    */

    /**
     * Gets the value of serviceLocator.
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Sets the value of serviceLocator.
     *
     * @param ServiceLocatorInterface $serviceLocator the service locator
     *
     * @return self
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }

    /**
     * Gets the value of sitemapService.
     *
     * @return mixed
     */
    public function getSitemapService()
    {
        if(!$this->sitemapService){
            $this->setSitemapService( $this->getServiceLocator()->get('Sitemap\Service\Sitemap') ); 
        }
        return $this->sitemapService;
    }

    /**
     * Sets the value of sitemapService.
     *
     * @param mixed $sitemapService the sitemap service
     *
     * @return self
     */
    public function setSitemapService($sitemapService)
    {
        $this->sitemapService = $sitemapService;

        return $this;
    }
}