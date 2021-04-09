<?php


namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleController extends AbstractController
{
    /**
     * @Route("/admin/articles/insert", name="admin_insert_article")
     */
    public function insertArticle(EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger)
    {
        $article = new Article();

        $articleForm = $this->createForm(ArticleFormType::class, $article);

        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid() ) {
            $article = $articleForm->getData();
            $entityManager->persist($article);
            $entityManager->flush();

            // Ajout d'un message qui apparaîtra lorsque le formulaire est envoyé et validé
            $this->addFlash('success', "L'article a bien été ajouté en base de données'");
            return $this->redirectToRoute('homepage');

        }

        //
        return $this->render('/admin/insert_article.html.twig', [
            'articleFormView' => $articleForm->createView(),
        ]);
    }


}