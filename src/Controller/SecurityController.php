<?php

namespace App\Controller;



use App\Entity\User;
use App\Form\MdpOubliType;
use App\Form\RegistrationType;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{

    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager,
    UserPasswordEncoderInterface $encoder){

        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

           
                // $photo récupère le fichier uploadé
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $photo */

                $photo = $form->get('USE_profile_pic')->getData();

            if($photo != null)
                {
                    $photoName = $this->generateUniqueFileName().'.'.$photo->guessExtension();

                    // déplace le fichier là où doit êtrs stocké
                    $photo->move(
                        $this->getParameter('profile_directory'),
                        $photoName
                    );

                    // updates the 'photo' property to store the photo file name
                    // instead of its contents

                    $user->setUseProfilePic($photoName);
                }

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute("security_login");
        }
    
        return $this->render('security/registration.html.twig', [

            'form' => $form->createView()
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){

        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){
        $_SESSION = array();
    }

    /**
     * @Route("/oubli-mdp", name="password_oublié")
     */
        public function password(UserPasswordEncoderInterface $encoder, ObjectManager $manager){

            $message = "";
            $repo = $this->getDoctrine()
            ->getRepository(User::class);
            
            if (isset($_POST['submitMdp']))
            {
                if(isset($_POST['username']) && isset($_POST['email'])){
                    $submittedUser = $_POST['username'];
                    $submittedEmail = $_POST['email'];
                    $user = $repo -> findByUsername($submittedUser);
                    $username = $user[0] -> getUsername();
                    $email = $user[0] -> getUSEEmail();
                      
                    if($submittedEmail == $email && $email != null){
                        $newPassword = $this->generpass(10);
                        $hash = $encoder->encodePassword($user[0], $newPassword);
                        $user[0]->setPassword($hash);
                        $manager->persist($user[0]);
                        $manager->flush();
                                  
                                        
                        $mail = new PHPMailer(true);  
                        $mail->CharSet = 'UTF-8';                            // Passing `true` enables exceptions
                        try {
                            //Server settings
                            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;     // Enable SMTP authentication
                            $mail->Mailer = "smtp";                               
                            $mail->Username = 'youpload.master@gmail.com';                 // SMTP username
                            $mail->Password = 'azerty987123';                           // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 25;                                    // TCP port to connect to
                        
                            //Recipients
                            $mail->setFrom('youpload.master@gmail.com', 'Youpload');
                            $mail->addAddress($email);     // Add a recipient
                        
                            //Content
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = 'Votre mot de passe ChampiSpot';
    
    
                            
                            $mail->Body    =
                            'Bonjour' . $username . '<br />
                            Voici votre nouveau mot de passe sur ChampiSpot : '. $newPassword;
                                                                                            
                            $mail->AltBody = "Change ton navigateur please.";
                        
                            $mail->send();
                        } 
                
                        catch (Exception $e) {
                            echo "Une erreur est survenue lors de l'envoi du mail : " .  $mail->ErrorInfo;
                        }
    
                        /* return $this->redirectToRoute("security_login"); */
                        /* $message = "Nous avons envoyé votre nouveau mot de passe sur votre adresse mail"; */
                    }
                    else{
                        return $message = "Le pseudonyme et l'adresse e-mail ne correspondent pas ou n'existent pas";
                    }                    
                    
                }
                else{
                    return $message = 'Veuillez remplir les champs correctement';
                }
            }              
                
            
            

            return $this->render('security/password.html.twig', [    
                "message" => $message,
            ]);
        }

        public function generpass($chrs = 8) {
	
            $chaine = ""; 
            $list = "123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ";
        
            mt_srand((double)microtime()*1000000);
        
            $newstring="";
        
            while( strlen( $newstring )< $chrs ) {
                    $newstring .= $list[mt_rand(0, strlen($list)-1)];
                }
        
            return $newstring;
         }


}
