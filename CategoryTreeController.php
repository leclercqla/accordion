<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\OptionList;

class OptionListController extends Controller
{
    /**
     * @return string 
     * @Route("/options/")
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:OptionList');
        $data = $repository->findAll();
        foreach ($data as $key => $option) {
            $result[$key] = [
                'option_id'          => $option->getOptionId(),
                'option_type'        => $option->getOptionType(),
                'optionValue'        => $option->getOptionValue(), 
                'option_description' => $option->getOptionDescription(),
                'option_display'     => $option->getOptionDisplay(),
            ];
        }
        return new JsonResponse($result);
    }
    /**
     * @param int $option_id
     * @return string 
     * @Route("/options/{option_id}/", requirements={"option_id": "\d+"})
     */
    public function getOptionByIdAction(int $option_id) 
    {
        $query = $this->getDoctrine()->getManager()
        ->createQuery('SELECT ol FROM AppBundle:OptionList ol WHERE ol.optionId = :optionId')
        ->setParameter('optionId', $option_id);
        $options = $query->getResult();
        foreach ($options as $key => $option) {
            $result[$key] = [
                'optionId'          => $option->getOptionId(), 
                'optionType'        => $option->getOptionType(), 
                'optionValue'       => $option->getOptionValue(), 
                'optionDescription' => $option->getOptionDescription(), 
                'optionDisplay'     => $option->getOptionDisplay()
            ];
        }
        return new JsonResponse($result);
    }
    /**
     * @param string $option_type
     * @return string 
     * @Route("/options/get/{optiontype}/", requirements={"optiontype": "[a-z]+"})
     */
    public function getOptionsByTypeAction(string $optiontype) 
    {
        $result = [];
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT ol
                FROM AppBundle:OptionList ol
                WHERE 
                ol.optionType = :optiontype
                AND ol.optionDisplay = 1
                ORDER BY ol.optionValue ASC'
        )->setParameter('optiontype', trim($optiontype));
        $options = $query->getResult();
        foreach ($options as $key => $option) {
            $result[$key] = [
                'optionId'          => $option->getOptionId(), 
                'optionType'        => $option->getOptionType(), 
                'optionValue'       => $option->getOptionValue(), 
                'optionDescription' => $option->getOptionDescription(), 
                'optionDisplay'     => $option->getOptionDisplay()
            ];
        }
        return new JsonResponse($result);
    }
    /**
     * @return string 
     * @Route("/options/getCategoryType/")
     */
    public function getCategoryTypeOptionsByTypeAction() 
    {
        $result = [];
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT ol
                FROM AppBundle:OptionList ol
                WHERE 
                ol.optionType IN ('articleCategoryTags','articleThemeTags','articleChildThemeTags','articleSubChildThemeTags')
                GROUP BY ol.optionType ORDER BY ol.optionId"
        );
        $options = $query->getResult();
        foreach ($options as $key => $option) {
            $result[$key] = [
                'optionId'          => $option->getOptionId(), 
                'optionType'        => $option->getOptionType(), 
                'optionValue'       => $option->getOptionValue(), 
                'optionDescription' => $option->getOptionDescription(), 
                'optionDisplay'     => $option->getOptionDisplay()
            ];
        }
        return new JsonResponse($result);
    }
    /**
     * @return string 
     * @Route("/options/getCategories/")
     */
    public function getCategoriesOptionsByTypeAction() 
    {
        $result = [];
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT ol
                FROM AppBundle:OptionList ol
                WHERE 
                ol.optionType IN ('articleCategoryTags','articleThemeTags','articleChildThemeTags','articleSubChildThemeTags')
                ORDER BY ol.optionId"
        );
        $options = $query->getResult();
        foreach ($options as $key => $option) {
            $result[$key] = [
                'optionId'          => $option->getOptionId(), 
                'optionType'        => $option->getOptionType(), 
                'optionValue'       => $option->getOptionValue(), 
                'optionDescription' => $option->getOptionDescription(), 
                'optionDisplay'     => $option->getOptionDisplay()
            ];
        }
        return new JsonResponse($result);
    }
    /**
     * @param string $option_type
     * @return string 
     * @Route("/options/type/")
     */
    public function getOptionTypeAction() 
    {
        $result = [];
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT DISTINCT ol.optionType FROM AppBundle:OptionList ol');
        $options = $query->getResult();
        foreach ($options as $key => $optionType) {
            $result[$key] = $optionType;
        }
        return new JsonResponse($result);
    }
    /**
     * @param array $_POST
     * @return bool 
     * @Route("/options/add/")
     */
    public function addOptionAction() 
    {
        $option_type    = $_POST['optionType']     ?? null;
        $option_value   = $_POST['optionValue']    ?? null;
        $option_display = $_POST['optionDisplay']  ?? null;
        $option_dusplay = 1 == (int)$option_display ? true : false;
        
        if (is_null($option_type) || is_null($option_value) || is_null($option_display)) {
            return new JsonResponse(['result' => false, 'error' => "Erreur lors de l'ajout de l'option."]); 
        }
        $option = new OptionList();
        $option->setOptionType($option_type);
        $option->setOptionValue($option_value);
        $option->setOptionDisplay($option_display);
        $option->setOptionDescription(null);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($option);
            $em->flush();
            return new JsonResponse(['result' => true]); 
        } catch(Exception $e) {
            return new JsonResponse(['result' => false, 'error' => "Erreur lors de l'ajout de l'option."]); 
        }
    }


    /**
     * @param array $_POST
     * @return bool 
     * @Route("/options/addCategory/")
     */
    public function addCategoryOptionAction() 
    {
        $option_type    = $_POST['optionType']     ?? null;
        $option_value   = $_POST['optionValue']    ?? null;
        $option_display = $_POST['optionDisplay']  ?? null;
        $option_dusplay = 1 == (int)$option_display ? true : false;
        
        if (is_null($option_type) || is_null($option_value) || is_null($option_display)) {
            return new JsonResponse(['result' => false, 'error' => "Erreur lors de l'ajout de l'option."]); 
        }
        $option = new OptionList();
        $option->setOptionType($option_type);
        $option->setOptionValue($option_value);
        $option->setOptionDisplay($option_display);
        $option->setOptionDescription(null);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($option);
            $em->flush();
            return new JsonResponse(['result' => true]); 
        } catch(Exception $e) {
            return new JsonResponse(['result' => false, 'error' => "Erreur lors de l'ajout de l'option."]); 
        }
    }

    /**
     * @param array $_POST
     * @return bool 
     * @Route("/options/update/")
     */
    public function updateOptionAction() 
    {
        $optionId = $_POST['optionId'] ?? null;
        $em        = $this->getDoctrine()->getManager();
        $option   = $em->getRepository('AppBundle:OptionList')->find($optionId);
        if (!$option) {
            throw $this->createNotFoundException("Erreur lors de la modification de l'option.");
        }
        $option_type    = $_POST['optionType']     ?? null;
        $option_value   = $_POST['optionValue']    ?? null;
        $option_display = $_POST['optionDisplay']  ?? null;
        $option_dusplay = 1 == (int)$option_display ? true : false;
        
        if (is_null($option_type) || is_null($option_value) || is_null($option_display)) {
            return new JsonResponse(['result' => false, 'error' => "Erreur lors de la modification de l'option."]); 
        }
        $option->setOptionType($option_type);
        $option->setOptionValue($option_value);
        $option->setOptionDisplay($option_display);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($option);
            $em->flush();
            return new JsonResponse(['result' => true]); 
        } catch(Exception $e) {
            return new JsonResponse(['result' => false, 'error' => "Erreur lors de la modification de l'option."]); 
        }
    }
}
