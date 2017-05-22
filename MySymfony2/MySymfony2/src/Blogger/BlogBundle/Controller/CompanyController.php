<?php
namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Blog controller.
 */
class CompanyController extends Controller
{
    /**
     * Show a company entry
     */
    public function showAction($id, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository('BloggerBlogBundle:Company')->find($id);

        if (!$company) {
            throw $this->createNotFoundException('Unable to find Company post.');
        }

        $students_info = $em->getRepository("BloggerBlogBundle:Student")->getStudentForCompany($company->getId());

        $groups = array();
        foreach ($students_info as $key => $value){
            $value->getGroup()->getTitle();
            if (!isset($groups[$value->getGroup()->getTitle()])){
                $groups[$value->getGroup()->getTitle()] = array("title" => $value->getGroup()->getTitle(), "students" => array());
            }
            array_push($groups[$value->getGroup()->getTitle()]["students"], $value);
        }

        return $this->render('BloggerBlogBundle:Company:show.html.twig', array(
            'company'      => $company,
            'groups'     => $groups
        ));
    }

    public function indexAction(){
        $em = $this->getDoctrine()
            ->getManager();

        $companies = $em->createQueryBuilder()
            ->select('b')
            ->from('BloggerBlogBundle:Company',  'b')
            ->getQuery()
            ->getResult();

        return $this->render('BloggerBlogBundle:Company:companies.html.twig', array(
            'companies' => $companies
        ));
    }

}