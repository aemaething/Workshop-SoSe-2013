<?php

namespace Workshop\LessonOneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="workshop_lessonOne_default_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
