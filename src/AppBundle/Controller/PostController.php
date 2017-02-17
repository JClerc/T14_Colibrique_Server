<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PostVisibility;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class PostController
 * @package AppBundle\Controller
 */
class PostController extends AbstractController
{
    /**
     * @ApiDoc(
     *     section="Posts",
     *     description="Get list of posts",
     * )
     *
     * @QueryParam(name="page", requirements="\d+", default="1", description="For pagination.")
     * @QueryParam(name="count", requirements="\d+", default="20", description="How many needed.")
     * @param int $page
     * @param int $count
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPostsAction($page, $count)
    {
        $this->validate($page >= 1 && $page < 10000, 'Page is out of bounds.');
        $this->validate($count >= 1 && $count < 100, 'Count is out of bounds.');

        $user = $this->getUser();
        $type = $user->getUserType();

        $postVisibilityRepository = $this->getDoctrine()->getRepository('AppBundle:PostVisibility');

        $postVisibilities = $postVisibilityRepository->findBy(
            ['visibleBy' => $type],
            null,
            $count,
            ($page - 1) * $count
        );

        $posts = array_map(
            function (PostVisibility $postVisibility) {
                return $postVisibility->getPost();
            },
            $postVisibilities
        );

        return $this->respond(
            [
                'posts' => $posts,
            ]
        );
    }

    /**
     * @ApiDoc(
     *     section="Posts",
     *     description="Get list of post's categories",
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCategoriesAction()
    {
        return $this->respond(
            [
                'categories' => $this->getDoctrine()->getRepository('AppBundle:Category')->findAll(),
            ]
        );
    }

    /**
     * @ApiDoc(
     *     section="Posts",
     *     description="Get list of post's visibilities",
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getVisibilitiesAction()
    {
        return $this->respond(
            [
                'visibilities' => $this->getDoctrine()->getRepository('AppBundle:PostVisibility')->findAll(),
            ]
        );
    }
}
