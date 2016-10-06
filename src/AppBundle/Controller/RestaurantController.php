<?php

namespace AppBundle\Controller;

//use AppBundle\Entity\Restaurant;
use AppBundle\Entity\ClientOrder;
use AppBundle\Entity\OrderItem;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RestaurantController extends Controller
{
    /**
     * @Route("/", name="tables_list")
     */
    public function listTablesAction(Request $request)
    {
        $Tables = $this->getDoctrine()->getRepository('AppBundle:DiningTable')->findAll();
        //die("TODOS");
        // replace this example code with whatever you need
        return $this->render('restaurant/list.html.twig',array(
            'diningtables' =>$Tables,
        ));
        
    }
    
    /**
     * @Route("/restaurant/menulist/{tablenumber}", name="categories_list")
     */
    public function listCategoriesAction($tablenumber, Request $request)
    {
        
        //$categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
        $menuitems = $this->getDoctrine()->getRepository('AppBundle:MenuItem')->findAll();
        
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT m.id,m.dateFrom, c.name, c.description
            FROM AppBundle:Menu m 
            INNER JOIN AppBundle:Category c
            WITH c.id = m.categoryId
            '
        );

        $menu_and_categories = $query->getResult();
        //die("TODOS");
        // replace this example code with whatever you need
        return $this->render('restaurant/menulist.html.twig',array(
            'categories' =>$menu_and_categories,
            'tablenumber' => $tablenumber,
            'menuitems' => $menuitems ,     
        ));
        
    }
    
    /**
     * @Route("/restaurant/order/{tablenumber}", name="order_list")
     */
    public function orderAction($tablenumber , Request $request)
    {
        $clientOrderEntity = $this->getDoctrine()
                 ->getRepository('AppBundle:ClientOrder')
                 ->findBy(array('tableNumber' => $tablenumber));
        
         var_dump($clientOrderEntity);
        
         if (empty($clientOrderEntity)){
        $clientOrderEntity = new ClientOrder;
        $customerid = 1;
       
        $orderdate = new \DateTime('now');

        $clientOrderEntity->setTableNumber($tablenumber);

        $clientOrderEntity->setOrderDate($orderdate);
        $clientOrderEntity->setCustomerId($customerid);
        $em = $this->getDoctrine()->getManager();
        $em->persist($clientOrderEntity);
        $em->flush();
        $id = $clientOrderEntity->getId();
         }
         else {
             $id = $clientOrderEntity[0]->getId();
         }
         
        

        $orderItem = new OrderItem;

        $form = $this->createFormBuilder($orderItem)               
            ->add('menuitemid', EntityType::class, array('class' =>'AppBundle:MenuItem', 'choice_label' => 'name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('quantity', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label'=> "add product", 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();
        $form->handleRequest($request);
        
        $order = $this->getDoctrine()->getRepository('AppBundle:ClientOrder')->find($id);
        
        if($form->isSubmitted() && $form->isValid()){
            //get Data
          
            
            $orderItem->setorderid($id);
            $orderItem->setmenuitemid($form['menuitemid']->getData());
            $orderItem->setquantity($form['quantity']->getData());
           
                 
            $em = $this->getDoctrine()->getManager();
            $em->persist($orderItem);
            $em->flush();
            
            $this->addFlash(
                    'notice',
                    'Todo Added');
            return $this->redirectToRoute('order_list');
        }
        
        //die("TODOS");
        // replace this example code with whatever you need
        return $this->render('restaurant/order.html.twig',array(
            'tablenumber' => $tablenumber,
            'order' => $order,
            'form' => $form->createView()
        ));
        
    }
    
    
}