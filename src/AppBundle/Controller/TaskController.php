<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as FOSRestBundleAnnotations;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use AppBundle\Services\Helpers;

/**
 * Class TaskController
 * @package AppBundle\Controller
 * @FOSRestBundleAnnotations\View()
 */
class TaskController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Get all task
     * @ApiDoc(
     *     section="Task",
     *     description="Get all tasks",
     *     output="AppBundle\Entity\Task",
     *     statusCodes={
     *        200="Returned when successfully",
     *        404="Wrong data"
     *     },
     *     tags={
     *        "stable"="#4A7023",
     *        "v1"="#ff0000"
     *     }
     * )
     * @return mixed
     */
    public function getAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Task')->findAll();

        $helpers = $this->get(Helpers::class);
        $response = $helpers->serializeData($entities);

        return $response;
    }
}
