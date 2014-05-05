<?php

namespace CodeCats\PanelBundle\Controller;

use CodeCats\PanelBundle\Entity\Avatar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AvatarController extends Controller
{
    public function getByUserSessionAction(Request $request)
    {
        $em     = $this->getDoctrine()->getManager();
        $user   = $em->getRepository('CodeCatsPanelBundle:User')->find($this->get('security.context')->getToken()->getUser()->getId());

        return $this->getFileResponse($user->getAvatar());
    }

    public function getAction(Request $request, $name)
    {
        $em = $this->getDoctrine()->getManager();

        return $this->getFileResponse($em->getRepository('CodeCatsPanelBundle:Avatar')->findOneByPath($name));
    }

    protected function getFileResponse(Avatar $avatar)
    {
        $file = new File('uploads/avatars/'. $avatar->getPath());

        $mime = $file->getMimeType();
        $headers = array(
            'Content-Type'          => $file->getMimeType(),
            'Content-Disposition'   => 'attachment; filename="'.$file->getPath().'"'
        );
        $filename = $avatar->getUploadRootDir() . '/' . $avatar->getPath();

        return new Response(file_get_contents($filename), 200, $headers);
    }
}
