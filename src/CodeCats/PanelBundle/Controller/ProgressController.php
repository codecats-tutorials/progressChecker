<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\CodeCatsPanelBundle;
use CodeCats\PanelBundle\Entity\Progress;
use CodeCats\PanelBundle\Form\ProgressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use DateTime;

class ProgressController extends Controller
{

    public function formAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

      ///  $progress = $em->getRepository('CodeCatsPanelBundle:Progress')->find(5);
        $progress = new Progress();
        $form = $this->createForm(new ProgressType(), $progress);

        $store = array(
            'title' => 'aa',
            'ended' => new DateTime()
        );
        $form->submit($store);

        if ($form->isValid()) {
            //$progress->setStarted(new DateTime());
        //    $em->flush();

            return new JsonResponse(array('success' => true));
        }
        var_export($this->getErrorMessages($form));

        return new JsonResponse(($this->getErrorMessages($form)));

    }
    public function getAction()
    {
        $em = $this->getDoctrine()->getManager();
        $progress = $em->getRepository('CodeCatsPanelBundle:Progress');
        $all = $progress->findAll();

        return new JsonResponse(array('success' => true, 'data' => $all));
    }

    public function updateAction(Request $request, $id)
    {
        $fb = $this->get('fire_php');


        $em = $this->getDoctrine()->getManager();

        $progress = $em->getRepository('CodeCatsPanelBundle:Progress')->find($id);
        $form = $this->createForm(new ProgressType(), $progress);
//        $form->setData(json_decode($request->getContent(), true));

        $fb->log($request->getContent());
        //from firebug:
        //PUT http://pc.t/app_dev.php/panel/progress/5?_dc=1397662229471
        //{"id":5,"title":"aaa","description":"lllll","started":"2014-03-18"}
      //  $form->handleRequest($request);
        $fb->log($form->isValid());
        //false :(

       // var_dump($request);
       // $form->handleRequest($request);
        $factory = Forms::createFormFactory();


        $form = $factory->createNamed(null, new ProgressType(), $progress, array('method'=>'PUT'));

//        $form->handleRequest(null, $request);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isValid()) {
            //false too
            //$em->flush();
            $fb->log($progress);

            return new JsonResponse(array('success' => true));
        }



        return new JsonResponse(array('success' => false, 'errors' => $this->getErrorMessages($form)));
    }

    /*
curl --data "progress[title]=abc&progress[description]=oo&progress[started]=2009-01-13&_method=PUT" http://pc.t/app_dev.php/panel/progress/test/test>out.htm
     */
    public function testTestAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $progress = $em->getRepository('CodeCatsPanelBundle:Progress')->find(5);
        //$form = $this->createForm(new ProgressType(), $progress, array('method' => 'PUT'))->add('submit', 'submit');
       // $form = $this->createForm(new ProgressType(), $progress)->add('submit', 'submit');
        $factory = Forms::createFormFactory();

        $form = $factory->createNamed(null, new ProgressType())->add('submit', 'submit');
        $form->handleRequest(null, $request);
       // return new JsonResponse(array('success' => true));
        return $this->render('CodeCatsPanelBundle:Progress:test.html.twig', [
            'form' => $form->createView(),
            'valid' => $form->isValid(),
            'progress' => $progress,
            'request' => $request
        ]);
    }

    public function createAction(Request $request)
    {
        $fb = $this->get('fire_php');

        $progress = new Progress();
        $em = $this->getDoctrine()->getManager();
        $progress = $em->getRepository('CodeCatsPanelBundle:Progress')->find(5);
        $factory = Forms::createFormFactory();
        $form = $factory->createNamed(null, new ProgressType(), $progress);

        $form->handleRequest(null, $request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
//            $em->persist($progress);
  //          $em->flush();

            return new JsonResponse(array('success' => true));
        }
        $fb->log($this->getErrorMessages($form));
        $fb->log($form->getErrors());

        return new JsonResponse(array('success' => false, 'errors' => $this->getErrorMessages($form)));
    }

    public function deleteAction()
    {
        return new JsonResponse(array('success' => true, 'data' => [['id' => 666, 'title' => 'a']]));
    }
    private function getErrorMessages(\Symfony\Component\Form\Form $form) {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }
}
