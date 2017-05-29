<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 30.04.2017
 * Time: 21:48
 */

namespace Blogger\BlogBundle\Controller;


use Blogger\BlogBundle\Entity\GroupStudent;
use Blogger\BlogBundle\Entity\Student;
use Blogger\BlogBundle\Form\GroupStudentType;
use Blogger\BlogBundle\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TeacherController extends Controller{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $companies = $em->getRepository('BloggerBlogBundle:Company')->getCompany();

        return $this->render('BloggerBlogBundle:Teacher:index.html.twig', array(
            'companies' => $companies
        ));
    }


    /*=========================== GROUP ==============================*/




    public function addGroupAction(Request $request){
        $message = "";
        if ($request->getSession()->has('message_group')){
            $message = $request->getSession()->get('message_group');
            $request->getSession()->remove('message_group');
        }

        $group = new GroupStudent();
        $form = $this->createForm(GroupStudentType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()
                    ->getManager();
                $em->persist($group);
                $em->flush();

                $message = "Группа добавлена";
            }else{
                $message = "Некорректный ввод";
            }
            $request->getSession()->set("message_group", $message);
            return $this->redirect($this->generateUrl('BloggerBlogBundle_teacher_home'));
        }


        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository('BloggerBlogBundle:GroupStudent')->getGroup();

        return $this->render('BloggerBlogBundle:Teacher/Form:edit_group.html.twig', array(
            'groups' => $groups,
            'group' => $group,
            'form'    => $form->createView(),
            "message_group" => $message
        ));
    }

    public function deleteGroupAction(Request $request){

        $group_id = $request->request->get("_group");
        $message = "Группа удалена";

        if (!is_numeric($group_id)){
            $message = "Некорректный ввод";
        }else{
            $em = $this->getDoctrine()
                ->getManager();

            $rez = $em->getRepository("BloggerBlogBundle:GroupStudent")->deleteGroup($group_id);
            if (!$rez){
                $message = "Ошибка удаления";
            }
        }

        $request->getSession()->set("message_group", $message);

        return $this->redirectToRoute('BloggerBlogBundle_teacher_home');
    }





    /*=========================== STUDENT ==============================*/




    public function addStudentAction(Request $request){
        $message = "";
        if ($request->getSession()->has('message_student')){
            $message = $request->getSession()->get('message_student');
            $request->getSession()->remove('message_student');
        }

        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()
                    ->getManager();
                $em->persist($student);
                $em->flush();

                $message = "Студент добавлен";
            }else{
                $message = "Некорректный ввод";
            }
            $request->getSession()->set("message_student", $message);
            return $this->redirect($this->generateUrl('BloggerBlogBundle_teacher_home'));
        }


        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('BloggerBlogBundle:Student')->getStudent();

        return $this->render('BloggerBlogBundle:Teacher/Form:edit_student.html.twig', array(
            'students' => $students,
            'Student' => $student,
            'form'    => $form->createView(),
            "message_student" => $message
        ));
    }

    public function deleteStudentAction(Request $request){

        $student_id = $request->request->get("_student");
        $message = "Студент удалён";

        if (!is_numeric($student_id)){
            $message = "Некорректный ввод";
        }else{
            $em = $this->getDoctrine()
                ->getManager();

            $rez = $em->getRepository("BloggerBlogBundle:Student")->deleteStudent($student_id);
            if (!$rez){
                $message = "Ошибка удаления";
            }
        }

        $request->getSession()->set("message_student", $message);

        return $this->redirectToRoute('BloggerBlogBundle_teacher_home');
    }




    /*=========================== COMPANY ==============================*/



    public function editCompanyAction(Request $request){
        if ($request->request->has("_company")){
            $company_id = $request->request->get("_company");
            $em = $this->getDoctrine()->getManager();
            $company = $em->getRepository("BloggerBlogBundle:Company")->getCompanyOnId($company_id);

            if (count($company) === 1){
                $company = $company[0];

                $message = "";
                if ($request->getSession()->has('message_company')) {
                    $message = $request->getSession()->get('message_company');
                    $request->getSession()->remove('message_company');
                }

                $companies = $em->getRepository('BloggerBlogBundle:Company')->getCompany();
                $students = $em->getRepository('BloggerBlogBundle:Student')->getStudentForCompany($company);


                if ($request->request->has("_student")){
                    $student_id = $request->request->get("_student");
                    $student = $em->getRepository("BloggerBlogBundle:Student")->getStudentOnId($student_id);
                    if (count($student) === 1){
                        $student = $student[0];
                        return $this->render('BloggerBlogBundle:Teacher/EditCompany:student.html.twig', array(
                            'company' => $company,
                            'Student' => $student,
                            "message_company" => $message
                        ));
                    }
                }

                return $this->render('BloggerBlogBundle:Teacher/EditCompany:index.html.twig', array(
                    'company' => $company,
                    'companies' => $companies,
                    'students' => $students,
                    "message_company" => $message
                ));

            }else{
                $request->getSession()->set("message_teacher", "Выбирите компанию");
            }
        }else{
            $request->getSession()->set("message_teacher", "Выбирите компанию");
        }
        return $this->redirectToRoute('BloggerBlogBundle_teacher_home');
    }


    public function editCompanyStudentAction(Request $request){
        if ($request->request->has("_company")) {
            $company_id = $request->request->get("_company");
            $em = $this->getDoctrine()->getManager();
            $company = $em->getRepository("BloggerBlogBundle:Company")->getCompanyOnId($company_id);

            if (count($company) === 1) {
                $company = $company[0];

                $message = "";
                if ($request->getSession()->has('message_company')) {
                    $message = $request->getSession()->get('message_company');
                    $request->getSession()->remove('message_company');
                }

                if ($request->request->has("_student")) {
                    $student_id = $request->request->get("_student");
                    $student = $em->getRepository("BloggerBlogBundle:Student")->getStudentOnId($student_id);
                    if (count($student) === 1) {
                        $student = $student[0];
                        if ($request->request->has("mark")){
                            $mark = $request->request->get("mark");
                            $student->setMark($mark);
                        }
                        if ($request->request->has("protect")){
                            $student->setProtect(true);
                        }

                        $em = $this->getDoctrine()
                            ->getManager();
                        $em->merge($student);
                        $em->flush();

                        return $this->render('BloggerBlogBundle:Teacher/EditCompany:student.html.twig', array(
                            'company' => $company,
                            'Student' => $student,
                            "message_company" => $message
                        ));
                    } else {
                        $request->getSession()->set("message_company", "Выбирите студента");
                    }
                } else {
                    $request->getSession()->set("message_teacher", "Выбирите компанию");
                }
            }
        }
        return $this->redirectToRoute('BloggerBlogBundle_teacher_home');
    }


}