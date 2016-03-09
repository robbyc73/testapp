<?php

namespace TestBundle\Controller;

use TestBundle\Entity\JobSeeker;
use TestBundle\Form\Type\JobSeekerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class JobSeekerApiController extends Controller
{
    /**
     * @param $id
     * @return JobSeeker|null
     */
    protected function retrieveJobSeeker($id)
    {
        $em = $this->getDoctrine()->getManager();
        $jobseeker = $em->getRepository('TestBundle:JobSeeker')
            ->createQueryBuilder('j')
            ->where('j.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $jobseeker) {
            throw new NotFoundHttpException();
        }

        return $jobseeker;
    }

    /**
     * Load new form and return HTML content
     *
     * @ApiDoc(
     *   parameters={
     *     { "name"="id", "dataType"="integer", "required"=true, "description"="JobSeeker Database ID" }
     *   },
     *   statusCodes={
     *     200="Loaded new form content",
     *     404="did not found object",
     *     500="Unhandled Exception - something went very wrong"
     *   }
     * )
     */
    public function getJobSeekerAction(Request $request, $id)
    {
        $jobSeeker = $this->retrieveJobSeeker($id);
        $form = $this->createForm(new JobSeekerType(), $jobSeeker, ['em' => $this->getDoctrine()->getManager()]);

        return $this->render('TestBundle:JobSeeker:form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Delete given jobSeeker from the database
     *
     * @ApiDoc(
     *   parameters={
     *     { "name"="id", "dataType"="integer", "required"=true, "description"="JobSeeker Database ID" }
     *   },
     *   statusCodes={
     *     200="JobSeeker deleted",
     *     404="did not found object",
     *     500="Unhandled Exception - something went very wrong"
     *   }
     * )
     */
    public function deleteJobSeekerAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $jobSeeker = $this->retrieveJobSeeker($id);
        $em->remove($jobSeeker);
        $em->flush();

        return $this->handleView($this->view(['status' => 'ok'], 200));
    }
}
