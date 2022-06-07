<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\models\Contact;
use App\models\Contact1;
use Illuminate\Http\Request;
use Mail;
use PDF;
// require_once("PHPMailer/src/PHPMailer.php");
// require_once("PHPMailer/src/Exception.php");
// require_once("PHPMailer/src/SMTP.php");
use class\PHPMailer;
use class\SMTP;
use PHPMailer\PHPMailer\Exception;


class ContactController extends Controller
{



  public function index()
  {
    $contacts = Contact::all();
    return view('contacts.index')->with('contacts', $contacts);
  }


  public function index1()
  {


    return view('contact-us');
  }



  public function save(Request $request)
  {

    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'resume' => 'required|mimes:pdf|max:10240',
      'subject' => 'required',
      'phone_number' => 'required',
      'message' => 'required'
    ]);

    if ($request->file('resume')) {
      $imgactivityFile = $request->file('resume');
      $imgAfile = $imgactivityFile->getClientOriginalExtension();
      $studentImg = 'N' . time() . '.' . $imgAfile;
      $destinationPath = storage_path('resume');
      $imgactivityFile->move($destinationPath, $studentImg);
    }
    $contact = new Contact1;

    $contact->name = $request->name;
    $contact->email = $request->email;



    $contact->subject = $request->subject;
    $contact->phone_number = $request->phone_number;
    $contact->message = $request->message;




    if ($request->file('resume')) {
      $contact->resume = $studentImg;
    }


    $contact->save();



    $data["email"] = "malakarashoke95@gmail.com";
        $data["title"] = "From ashoke.flamingostech@gmail.com";
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('emails.myTestMail', $data);

        Mail::send('emails.myTestMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });

        dd('Mail sent successfully');

// require 'class/PHPMailer.php';
//     \Mail::send(
//       'contact_email',
//       array(
//         'name' => $request->get('name'),
//         'email' => $request->get('email'),
//         'subject' => $request->get('subject'),
//         'phone_number' => $request->get('phone_number'),
//         $target_file = $_FILES['resume']['name'],
//         $target_path = "http://localhost/practicelaravel/contact-us/storage/resume/",
//         $temp_path = $_FILES['resume']['tmp_name'],
//         $target_paths = $target_path . basename($target_file),
//         move_uploaded_file($temp_path, $target_paths),
//         'resume' => $request->get('target_paths'),
//         'user_message' => $request->get('message'),
//       ),
//       function ($message) use ($request) {
//         $message->from($request->email);
//         $message->to('ashoke.flamingostech@gmail.com');
//       }
//     );


    return redirect('contact')->with('success', 'Thank you for contact us!');
  }


  public function create()
  {
    return view('contacts.create');
  }


  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'address' => 'required',
      'image' => 'file|max:25000|mimes:jpeg,bmp,png,jpg',
      'mobile' => 'required',
      'state' => 'required',
      'district' => 'required'
    ]);


    $contact = new Contact;

    $contact->name = $request->name;
    $contact->address = $request->address;



    $contact->mobile = $request->mobile;
    $contact->state = $request->state;
    $contact->district = $request->district;





    if ($request->file('image')) {
      $imgactivityFile = $request->file('image');
      $imgAfile = $imgactivityFile->getClientOriginalExtension();
      $studentImg = 'N' . time() . '.' . $imgAfile;
      $destinationPath = storage_path('images');
      $imgactivityFile->move($destinationPath, $studentImg);
    }


    if ($request->file('image')) {
      $contact->image = $studentImg;
    }

    $contact->save();

    // $customer_photo = '';
    // $imagepath = storage_path('images');
    // if($request->has('image')){
    //   $file = $request->file('image');
    //   $extention = $file->getClientOriginalExtension();
    //   if($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png'){
    //     $customer_photo = rand(1000,999).'.'.$extention;
    //     $file->move($imagepath, $customer_photo);
    //   }else{
    //     $return['key'] = 'E';
    //     $return['msg'] = 'You can upload only .jpg , .jpeg , .png file';
    //     return $return;
    //   }
    // }
    // $input = $request->all();
    // Contact::create($input);

    return redirect('contact')->with('flash_message', 'Contact Addedd!');
  }




  public function editstudent($id)
  {
    $contact = Contact::find($id);
    return view('contacts.editstudent')->with('editstudent', ['editstudent' => $contact]);
  }









  public function updatestudent(Request $request)
  {

    $updateData = new Contact;

    $updateData = Contact::find($request->id);
    $updateData->name = $request->name;
    $updateData->address = $request->address;
    $updateData->mobile = $request->mobile;
    $updateData->state = $request->state;
    $updateData->district = $request->district;
    $updateData->save();

    return redirect('contact')->with('flash_message', 'Contact updated successfully!');
  }


  public function deletestudent($id)
  {
    $data = Contact::find($id);
    $data->delete();
    return redirect('contact');
  }
}
