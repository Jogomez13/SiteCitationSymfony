<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\NewsCitation;
use AdminBundle\Form\NewsCitationType;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author jonathan
 */
class AdminController extends Controller {
     /**
     * @Route("/admin/",name="home")
     * @Template("AdminBundle:Default:admin.html.twig")
     */
    public function getAdmin(){
        
    }
    
    /**
     * @Route("/admin/add",name="add")
     * @Template("AdminBundle:Default:admin.html.twig")
     */
    public function addCitation(){
        $citation= $this->createForm(NewsCitationType::class,new NewsCitation());
    
        return array("form" => $citation->createView());
        
        
    }
    
     /**
     * @Route("/admin/valid", name="valid")
     *@param Request $request
     */
    public function validation(Request $request){
        $citation= $this->createForm(NewsCitationType::class,new NewsCitation());
        if ($request->getMethod() == 'POST') {
            $citation->handleRequest($request);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($citation);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        
    }
    
     /**
     * @Route("/admin/liste", name="liste")
     *@Template("AdminBundle:Default:listecitation.html.twig")
     */
    protected function getCitation(){
         $em = $this->getDoctrine()->getEntityManager();
        $rsm = new ResultSetMappingBuilder($em);
        $rsm->addRootEntityFromClassMetadata('AdminBundle:NewsCitation', 'citation');
        $query = $em->createNativeQuery("select * from news_citation", $rsm);
        $niouzes = $query->getResult();
        return array ('citations' => $niouzes);
       
    }
    
     /**
     * @Route("/admin/update/{id}",name="edit")
     * @Template("AdminBundle:Default:admin.html.twig")
     */
    public function edit($id){
        $em = $this->getDoctrine()->getEntityManager();
        $y=$em->find("AdminBundle:NewsCitation", $id);
        $form = $this->createForm(NewsCitationType::class,$y);
        
        return array("form" => $form->createView(),"id"=>$id);
        }

    /**
     * @Route("/admin/update/{id}",name="update")
     */
    public function update(Request $request,$id){
        $em = $this->getDoctrine()->getEntityManager();
        $y=$em->find("AdminBundle:NewsCitation", $id);
        $form = $this->createForm(NewsCitationType::class,$y);
        if ($request->getMethod() == 'POST') {  
            $form->handleRequest($request);            
            $em = $this->getDoctrine()->getEntityManager();
            $em->merge($form);
            $em->flush();
            return $this->redirectToRoute('liste');
        }
        return $this->redirectToRoute('add');
    }
    /**
     * @Route("/news/delete/{id}",name="delete")
     */
    public function supprime($id){
        $em = $this->getDoctrine()->getManager();
        $niouze=$em->find("AdminBundle:NewsCitation", $id);
        $em->remove($niouze);
        $em->flush();
        return $this->redirectToRoute('liste');
    }
}
