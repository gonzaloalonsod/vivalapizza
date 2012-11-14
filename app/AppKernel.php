<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            //BUNDLES SISTEMA
            new Sistema\AdminBundle\SistemaAdminBundle(),
            new Sistema\UsuarioBundle\SistemaUsuarioBundle(),
            //BUNDLES TERCEROS
            //FOS USER BUNDLE
            new FOS\UserBundle\FOSUserBundle(),
            //CRUD GENERATOR
            new Lexik\Bundle\FormFilterBundle\LexikFormFilterBundle(),
            new JordiLlonch\Bundle\CrudGeneratorBundle\JordiLlonchCrudGeneratorBundle(),
            //FORMULARIOS COPETES
            new Craue\FormFlowBundle\CraueFormFlowBundle(),
            //RESIZE IMAGEN
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
            new Sistema\FrontendBundle\SistemaFrontendBundle(),
            //FORM VARIOS AUTOCOMPLETE
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            //GENERA LOS PDF
            new Io\TcpdfBundle\IoTcpdfBundle(),
            new Sistema\TcpdfBundle\SistemaTcpdfBundle(),//Bundle Propio - sobreescribo el bundle
            //FIXTURES
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            //VALORAR
            new Sistema\GKValoracionBundle\SistemaGKValoracionBundle(),
//            new Avro\RatingBundle\AvroRatingBundle
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
