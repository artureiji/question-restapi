<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\Choice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/question", name="fetch_questions")
     * @Method({"GET"})
     */
    public function fetchAllQuestions(Request $request)
    {
        $questions = $this->getDoctrine()
            ->getRepository('AppBundle:Question')
            ->findAll();

        $output = [];
        foreach ($questions as $question) {
            $output[] = $question->toArray();
        }

        return new Response(
            json_encode($output),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/question", name="save_question")
     * @Method({"POST"})
     */
    public function saveQuestion(Request $request)
    {
        $data = json_decode($request->getContent());

        $question = new Question();
        $question->setQuestion($data->question)
                 ->setPublishedAt(new \DateTime());

        foreach ($data->choices as $value) {
            $question->addChoice($value);    
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($question);
        $em->flush();

        return new Response(
            json_encode($question->toArray()),
            201,
            array(
                'Content-Type' => 'application/json',
                'Location' => 'question/' . $question->getid()
            )
        );
    }
}
