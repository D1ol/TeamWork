<?php


namespace App\Core;


use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class AjaxResponse
{
    public function generateResponse(FlashBagInterface $flashBag)
    {
        if($flashBag->has('error')){
            $jsonResponse = [
                'httpStatus' => 400,
                'description' => $flashBag->get('error')[0]
            ];
        }

        if($flashBag->has('success')){
            $jsonResponse = [
                'httpStatus' => 200,
                'description' => $flashBag->get('success')[0]
            ];
        }

        return $jsonResponse;
    }
}