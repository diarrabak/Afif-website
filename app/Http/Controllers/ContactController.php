<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    // =============== [ Email ] ===================
    public function email()
    {
        return view("contact.contact");
    }


    // ========== [ Compose Email ] ================
    public function composeEmail(Request $request)
    {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {

            //Form values validation before sending
            $validatedMessage = $request->validate([
                'senderName' => ['required', 'string', 'max:255'],
                'senderEmail' => ['required', 'string', 'email', 'max:255'],
                'emailSubject' => ['required', 'string', 'max:255'],
                'emailBody' => ['required', 'string'],
            ]);



            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'bakary.diarra9@gmail.com';   //  sender email to change
            $mail->Password = 'Email account password';       // sender password 
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom($mail->Username,  $validatedMessage['senderName']);
            $mail->addAddress($mail->Username); //$mail->addAddress($request->emailRecipient);
            // $mail->addCC($request->emailCc);
            // $mail->addBCC($request->emailBcc);

            $mail->addReplyTo($validatedMessage['senderEmail'], $validatedMessage['senderName']);

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $validatedMessage['emailSubject'];   //From the form
            $mail->Body    = $validatedMessage['emailBody'];      //From the form

            // $mail->AltBody = plain text version of email body;
            // dd($mail);
            //$request->session()->pull('emailSender', '');
            $statusType = '';
            if (!$mail->send()) {

                $statusType = 'failed';
                $request->session()->put('emailStatus', $statusType);
                return back()
                    ->with("failed", "Email not sent.")
                    ->withErrors($mail->ErrorInfo);
            } else {
                // return back()
                //  ->with("success", "Email has been sent.");
                $request->session()->put('emailSender', $validatedMessage['senderName']);
                $statusType = 'success';
                $request->session()->put('emailStatus', $statusType);
                return redirect()->route('thanks');
            }
        } catch (Exception $e) {
            $statusType = 'error';
            $request->session()->put('emailStatus', $statusType);
            return back()
                ->with('error', 'Message could not be sent.');
        }
    }
}
