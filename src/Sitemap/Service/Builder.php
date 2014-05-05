<?php
namespace Sitemap\Service;

use Doctrine\ORM\EntityManager;
use Heartsentwined\Cron\Service\Cron;

use Zend\ServiceManager\ServiceLocatorAwareInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    ZfcBase\EventManager\EventProvider;

/**
 * takes an array of entities and iterates through them creating a sitemap
 * the output is saved to gzip and the sitemap references the index
 * */
class SitemapBuilder extends EventProvider implements ServiceLocatorAwareInterface
{
    /**
     *  @var AbstractOptions
     */
    protected $options;

    /**
     * Compress the sitemap into gz for compact delivery
     * @param String $data Xml to be compress
     * */
    private function compressGzip($data){
        $gzdata = gzencode($data, 9);
        $fp = fopen('sitemap.xml.gz', 'w');
        fwrite($fp, $gzdata);
        fclose($fp);

        $this->writeStaticXmlFile();
    }

    /**
     * Update the XML file with a new timestamp
     * */
    private function writeStaticXmlFile(){
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
                    <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
                        <sitemap>
                            <loc>/sitemap.gz</loc>
                            <lastmod>' . date('c', time()) . '</lastmod>
                        </sitemap>
                    </sitemapindex>';
        $fp = fopen('sitemap.xml', 'w');
        fwrite($fp, $gzdata);
        fclose($fp);
    }

    /**
     * Build a full index of all modules flagged for indexing.
     * should be called from CLI or CRON
     */
    public function build(){
        
        if($this->getOptions()->getModules()){
            foreach($this->getOptions()->getModules() as $module){
                $indexes = $this->getEntityManager()->getRepository( $module['name'] )->findAll();
                foreach($indexes as $dbindex){
                    // $doc = new Document();

                    // // Store document URL to identify it in the search results
                    // $doc->addField(Field::Text('route', $module['route'] ));
                    
                    // // produces "->getSlug() | ->getUri()" as the getter to allow different field for pages module
                    // $getter = 'get' . ucfirst($module['slug_field']);
                    // $doc->addField(Field::Text('slug', $dbindex->{$getter}() ));

                    // $doc->addField(Field::Text('title', $dbindex->getTitle() ));
                    // $doc->addField(Field::Text('description', $dbindex->getBody() ));

                    // // Index document contents
                    // $doc->addField(Field::UnStored('contents', $dbindex->getBody()));
                    // $index->addDocument($doc);

                }
            }
        }
        $data = 'asd';//$this->view->render();
        // get the rendered view
        $this->compressGzip($data);
    }


    /**
     * Getters and Setters
     * */

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
     * Gets the value of entityManager.
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

    /**
     * Sets the value of entityManager.
     *
     * @param \Doctrine\ORM\EntityManager $entityManager the entity manager
     *
     * @return self
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }


    /**
     * get service options
     *
     * @return 
     */
    public function getOptions()
    {;
        if (!$this->options){
            $this->setOptions($this->getServiceLocator()->get('sitemap_options'));
        }
        return $this->options;
    }

    /**
     * set service options
     *
     * @param  $options
     */
    public function setOptions( $options)
    {
        $this->options = $options;
    }

}