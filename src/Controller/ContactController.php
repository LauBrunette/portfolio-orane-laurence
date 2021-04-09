<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

// Toujours étendre la classe afin de pouvoir utiliser des méthodes comme $this->render
class ContactController extends AbstractController
{
    // Création de l'URL voulu
    /**
     * @Route("/contact", name="contact")
     */
    // L'entityManager de Doctrine permet de récupérer en BDD des infos
    public function contactForm(EntityManagerInterface $entityManager, Request $request)
    {
        // On crée une instance de l'entité Contact
        $contact = new Contact();

        // On crée un nouveau formulaire
        $contactForm = $this->createForm(ContactType::class, $contact);
        // On récupère les données de la méthode POST (donc du formulaire rempli)
        $contactForm->handleRequest($request);
        // Si le formulaire est bel et bien envoyé (submit) et qu'il est valide...
        if ($contactForm->isSubmitted() && $contactForm->isValid() ) {
            $contact = $contactForm->getData();
            // On récupère les données fournies par l'utilisateur
            // On enregistre en envoie les données en BDD
            $entityManager->persist($contact);
            $entityManager->flush();
            // On affiche un message de confirmation de l'envoi à l'utilisateur
            // On redirige ensuite vers la page principale grâce au redirectToRoute + le chemin voulu
            $this->addFlash('success', "Le formulaire de contact a bien été envoyé, vous recevrez une réponse d'ici quelques jours!");
            return $this->redirectToRoute('homepage');

        }
        // Le formulaire de prise de contact s'affiche, grâce au fichier twig lié
        // Le formView permet de visualiser le formulaire
        return $this->render('contact.html.twig', [
            'contactFormView' => $contactForm->createView(),
        ]);
    }
}
