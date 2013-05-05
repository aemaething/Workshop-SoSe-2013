<?php

namespace Workshop\LessonTwoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Workshop\LessonTwoBundle\Entity\BlogPost;


/**
 * Class BlogController
 * @package Workshop\LessonTwoBundle\Controller
 * @Route("/blog")
 */
class BlogController extends Controller {

	const POSTS_PER_PAGE = 6;

	/**
	 * @Route("/", name="workshop_lessonTwo_blog_index")
	 * @Template()
	 * @return array
	 */
	public function indexAction() {
		return array(
			'blogPosts' => $this
				->get('workshop_lesson_two.repository.blog_post')
				->findAll()
		);
	}


	/**
	 * @Route("/paged/{page}", name="workshop_lessonTwo_blog_paged", defaults={"page"=1})
	 * @Template()
	 * @param $page
	 * @return array
	 */
	public function pagedAction($page) {

		$paginator  = $this->get('knp_paginator');
		$query = $this
			->get('workshop_lesson_two.repository.blog_post')
			->createPaginationQuery();

		return array(
			'page' => $page,
			'pagination' => $paginator
				->paginate($query, $page, self::POSTS_PER_PAGE)
		);
	}


	// Die folgende Methode könnte auch den "slug" verwenden.
	// Welche Änderungen stünden dafür an?
	/**
	 * @Route("/detail/{page}-{id}", name="workshop_lessonTwo_blog_detail_id")
	 * @Template()
	 * @param $page
	 * @param $id
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return array
	 */
	public function detailAction($page, $id) {
		$blogPost = $this
			->get('workshop_lesson_two.repository.blog_post')
			->findOneOnlineById($id);

		if (! $blogPost instanceof BlogPost) {
			throw $this->createNotFoundException(
					sprintf('BlogPost [%s] wurde nicht gefunden.', $id));
		}

		return array(
			'blogPost' => $blogPost,
			'page' => $page
		);
	}
}