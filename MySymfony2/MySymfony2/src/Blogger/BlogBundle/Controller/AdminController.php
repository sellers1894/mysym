<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.04.2017
 * Time: 17:51
 */

namespace Blogger\BlogBundle\Controller;
use Blogger\BlogBundle\Entity\Company;
use Blogger\BlogBundle\Entity\Role;
use Blogger\BlogBundle\Entity\SliderPage;
use Blogger\BlogBundle\Entity\User;
use Blogger\BlogBundle\Form\CompanyType;
use Blogger\BlogBundle\Form\SliderPageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class AdminController extends Controller{
    public function indexAction()
    {
        return $this->render('BloggerBlogBundle:Admin:index.html.twig');
    }


    /*=========================== USER ==============================*/


    public function getEditUserFormAction(Request $request){

        $param = array("last_username" => "", "last_useremail" => "","last_userrole" => "", "last_userpassword" => "");
        $message = "";

        if ($request->getSession()->has('param_edit_user')){
            $param = unserialize($request->getSession()->get('param_edit_user'));
            $request->getSession()->remove('param_edit_user');
        }
        if ($request->getSession()->has('message')){
            $message = $request->getSession()->get('message');
            $request->getSession()->remove('message');
        }

        $em = $this->getDoctrine()->getManager();

        $roles = $em->getRepository('BloggerBlogBundle:Role')->getRole();

        $users = $em->getRepository('BloggerBlogBundle:User')->getAll();

        return $this->render('BloggerBlogBundle:Admin/Form:form_edit_user.html.twig', array(
            "roles" => $roles,
            "param" => $param,
            "message" => $message,
            "users" => $users
        ));
    }


    public function addUserAction(Request $request){

        $message = "Запись добавлена!";

        $param = array(
            "last_username" => $request->request->get("_username"),
            "last_useremail" => $request->request->get("_useremail"),
            "last_userpassword" => $request->request->get("_userpassword"),
            "last_userrole" => $request->request->get("_userrole")
        );



        if (strlen($param['last_username']) < 4){
            $message = "Некорректный ввод(Логин)";
        }elseif (strlen($param['last_useremail']) < 4){
            $message = "Некорректный ввод(Email)";
        }elseif (strlen($param['last_userpassword']) < 4){
            $message = "Некорректный ввод(Пароль)";
        }elseif (!is_numeric($param['last_userrole'])){
            $message = "Некорректный ввод(Роль)";
        }else {

            $em = $this->getDoctrine()
                ->getManager();

            $user = $em->getRepository("BloggerBlogBundle:User")->getUserOnLogin($param['last_username']);

            if ($user){
                $message = "Некорректный ввод(Такой логин уже есть)";
            }else {

                $user = $em->getRepository("BloggerBlogBundle:User")->getUserOnEmail($param['last_useremail']);

                if ($user){
                    $message = "Некорректный ввод(Такой email уже есть)";
                }else {

                    $role_id = $em->getRepository("BloggerBlogBundle:Role")->getRole($param['last_userrole']);
                    if (count($role_id) === 1) {


                        $role = $role_id[0];
                        $user = new User();
                        $user->setEmail($param['last_useremail']);
                        $user->setUsername($param['last_username']);
                        $user->setSalt(md5(time()));
                        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                        $password = $encoder->encodePassword($param['last_userpassword'], $user->getSalt());
                        $user->setPassword($password);

                        $user->getUserRoles()->add($role);


                        $em->persist($user);
                        $em->flush();


                    } else
                        $message = "Некорректный ввод(Роль)";
                }
            }
        }


        $request->getSession()->set("param_edit_user", serialize($param));
        $request->getSession()->set("message", $message);

        return $this->redirectToRoute('admin_home');
    }




    public function deleteUserAction(Request $request){

        $message = "Пользователь удалён!";

        $user_id = $request->request->get("_user");

        if (!is_numeric($user_id)){
            $message = "Некорректный ввод";
        }else{
            $em = $this->getDoctrine()
                ->getManager();


            $user = $em->find('BloggerBlogBundle:User', $user_id);
            $message = "Пользователь ".$user->getUsername()." удалён!";
            $role = $em->find('BloggerBlogBundle:Role', $user->getRoles()[0]->getId());
            $user->removeUserRole($role);
            $em->persist($user);
            $em->flush();
            $rez = $em->getRepository("BloggerBlogBundle:User")->deleteUser($user_id);
            if (!$rez){
                $message = "Ошибка удаления";
            }
        }

        $request->getSession()->set("message", $message);

        return $this->redirectToRoute('admin_home');
    }




    /*=========================== COMPANY ==============================*/




    public function addCompanyAction(Request $request){
        $message = "";
        if ($request->getSession()->has('message_com')){
            $message = $request->getSession()->get('message_com');
            $request->getSession()->remove('message_com');
        }

        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                /** @var UploadedFile $file */
                $file = $company->getImage();
                $filename = "bla" . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('company_img_dir') . "/" . $company->getTitle(),
                    $filename
                );

                $company->setImage($filename);


                $em = $this->getDoctrine()
                    ->getManager();
                $em->persist($company);
                $em->flush();

                $message = "Компания добавлена";
            }else{
                $message = "Некорректный ввод";
            }
            $request->getSession()->set("message_com", $message);
            return $this->redirect($this->generateUrl('admin_home'));
        }


        $em = $this->getDoctrine()->getManager();
        $companies = $em->getRepository('BloggerBlogBundle:Company')->getCompany();

        return $this->render('BloggerBlogBundle:Admin/Form:form_edit_company.html.twig', array(
            'companies' => $companies,
            'company' => $company,
            'form'    => $form->createView(),
            "message_com" => $message
        ));
    }

    public function deleteCompanyAction(Request $request){

        $company_id = $request->request->get("_company");
        $message = "Компания удалена";

        if (!is_numeric($company_id)){
            $message = "Некорректный ввод";
        }else{
            $em = $this->getDoctrine()
                ->getManager();

            $rez = $em->getRepository("BloggerBlogBundle:Company")->deleteCompany($company_id);
            if (!$rez){
                $message = "Ошибка удаления";
            }
        }

        $request->getSession()->set("message_com", $message);

        return $this->redirectToRoute('admin_home');
    }




    /*=========================== SLIDER ==============================*/


    public function addSliderAction(Request $request){
        $message = "";
        if ($request->getSession()->has('message_slider')){
            $message = $request->getSession()->get('message_slider');
            $request->getSession()->remove('message_slider');
        }


        $slider = new SliderPage();
        $form = $this->createForm(SliderPageType::class, $slider);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                /** @var UploadedFile $file */
                $file = $slider->getImage();
                $filename = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('img_dir'),
                    $filename
                );

                $slider->setImage($filename);


                $em = $this->getDoctrine()
                    ->getManager();
                $em->persist($slider);
                $em->flush();

                $message = "Слайдер добавлен";
            }else{
                $message = "Некорректный ввод";
            }
            $request->getSession()->set("message_slider", $message);
            return $this->redirect($this->generateUrl('admin_home'));
        }


        $em = $this->getDoctrine()->getManager();
        $sliders = $em->getRepository('BloggerBlogBundle:SliderPage')->getCompany();

        return $this->render('BloggerBlogBundle:Admin/Form:form_edit_slider.html.twig', array(
            'sliders' => $sliders,
            'slider' => $slider,
            'form'    => $form->createView(),
            "message_slider" => $message
        ));
    }

    public function deleteSliderAction(Request $request){

        $slider_id = $request->request->get("_slider");
        $message = "Компания удалена";

        if (!is_numeric($slider_id)){
            $message = "Некорректный ввод";
        }else{
            $em = $this->getDoctrine()
                ->getManager();

            $rez = $em->getRepository("BloggerBlogBundle:SliderPage")->deleteSlider($slider_id);
            if (!$rez){
                $message = "Ошибка удаления";
            }
        }

        $request->getSession()->set("message_slider", $message);

        return $this->redirectToRoute('admin_home');
    }

}