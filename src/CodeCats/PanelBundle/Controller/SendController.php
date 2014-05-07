<?php

namespace CodeCats\PanelBundle\Controller;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SendController extends Controller
{
    public function emailAction(Request $request)
    {
        $emailConfig    = $this->get('security.context')->getToken()->getUser()->getCompanyEmail();
        $post           = $request->request;

        $receiverBag = array('ssstrz@gmail.com' => 'ja');
        for ($i = 0; $i < 3; $i++) {
            $email = $post->get('receiver' . ($i + 1));
            if ( ! empty($email)) {
                $receiverBag[] = $email;
            }
        }
     
        $transport = Swift_SmtpTransport::newInstance($emailConfig->getTransferProtocol(), (int)$emailConfig->getPort(), 'ssl')
            ->setUsername($emailConfig->getSendFrom())
            ->setPassword($emailConfig->getPassword())
        ;
        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance($post->get('subject'))
            ->setFrom(array($emailConfig->getSendFrom() => $emailConfig->getUsername()))
            ->setTo($receiverBag)
            ->setBody($post->get('body'))
            ->setContentType('text/html')
        ;

        return new JsonResponse(array('success' => true, 'send' => $mailer->send($message)));
    }

}
