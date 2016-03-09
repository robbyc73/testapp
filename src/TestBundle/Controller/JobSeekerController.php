<?php

namespace TestBundle\Controller;

use TestBundle\Entity\JobSeeker;
use TestBundle\Form\JobSeekerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class JobSeekerController extends Controller
{
    /**
     * @Route("/showJobSeeker")
     */
    public function showJobSeekerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $js = $em->getRepository('TestBundle:JobSeeker')
            ->createQueryBuilder('j')
            ->orderBy('j.dOB', 'ASC')
            ->getQuery()
            ->getResult();

        // add form to controller
        $newJobSeeker = new JobSeeker();

 $form = $this->createForm(new JobSeekerType(), $newJobSeeker, ['em' => $em]);

 $form->handleRequest($request);


 if ($form->isValid()) {
 	$jobSeeker = $form->getData();
 	//$jobSeeker->setUser($this->getUser());
 	$em->persist($jobSeeker);
 	$em->flush();
 	return $this->redirect($this->generateUrl('showJobSeeker'));
 }


        return $this->render('TestBundle:JobSeeker:show_jobseeker.html.twig', array( 'jobseekers' => $js, 'form' => $form->createView()));
    }

}
