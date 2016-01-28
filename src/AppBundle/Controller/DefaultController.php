<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Finder\Finder;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @Route("/get-ajax-data", name="datasource")
     * @Method({"POST"})
     */
    public function dataSourceAction(Request $request)
    {
        $param = $request->request->get('keyword');

        $location = $this->getParameter('search_location');
        $finder = new Finder();
        $finder->files()->in($location);
        $finder->files()->in($location);

        $list_name = array();
        $list_content = array();

        foreach ($finder as $file) {

            if(strpos($file->getFileName(), $param) !== false)
                $list_name[$file->getFileName()] = $param;

            if(strpos($file->getContents(), $param) !== false)
                $list_name[$file->getFileName()] = $param;


        }

        return $this->render('AppBundle:Default:ajax_template.html.twig', array('results'=> $list_name));

    }
}
