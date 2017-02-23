<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\PostVisibility;
use AppBundle\Form\PostType;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

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

        $posts = [];
        $user = $this->getUser();
        $type = $user->getUserType();

        // Get post by visibilities
        $postVisibilityRepository = $this->getDoctrine()->getRepository('AppBundle:PostVisibility');
        $postVisibilities = $postVisibilityRepository->findBy(['visibleBy' => $type]);
        foreach ($postVisibilities as $postVisibility) {
            $post = $postVisibility->getPost();
            $posts[$post->getId()] = $post;
        }

        // Get post which user are its author
        $authorPosts = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(['author' => $user]);
        foreach ($authorPosts as $post) {
            $posts[$post->getId()] = $post;
        }

        // Sort in DESC order
        usort($posts, function (Post $post1, Post $post2) {
            return $post2->getPostedAt() <=> $post1->getPostedAt();
        });

        // Return only those needed
        $posts = array_splice($posts, ($page - 1) * $count, $count);

        return $this->respond(
            [
                'posts' => $posts,
            ]
        );
    }


    /**
     * @ApiDoc(
     *     section="Posts",
     *     description="Add a post",
     * )
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postPostsAction(Request $request)
    {
        $dataModifier = function ($data) {
            $user = $this->getUser();
            $data['author'] = $user->getId();
            $data['promotion'] = $user->getPromotion()->getId();

            return $data;
        };

        $onSuccess = function (Post $post) {
            $postVisibility = new PostVisibility();
            $postVisibility->setPost($post);
            $postVisibility->setVisibleBy($this->getUser()->getUserType());
            $em = $this->getDoctrine()->getManager();
            $em->persist($postVisibility);
            $em->flush();
        };

        return $this->processForm(new Post(), PostType::class, $request, $dataModifier, $onSuccess);
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
