<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Marquee;
use App\MarqueeBooking;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Toastr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MarqueeBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookedMarquees = MarqueeBooking::with('marquee', 'menu')->get();
        return view('marqueeBooking.index',compact('bookedMarquees'));
    }


    public function marqueeStatus($id, $status)
    {
        // dd($id.' '. $status);
        $bookedMarquee = MarqueeBooking::find($id);
        if ($status == 'pending') {
            $mar_status = 'approved';
        }else{
            $mar_status = 'pending';
        }
        $bookedMarquee->status = $mar_status;
        $bookedMarquee->save();

        Toastr::success('Booked Marquee Status Updated successfully', 'Success', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('booking.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        

        $currentDatetime = Carbon::now();
        $currentDate = $currentDatetime->toDateString();
        $this->validate($request, [
            'name' => 'bail|required|string',
            'marquee_id' => 'bail|required|integer', 
            'email' => 'bail|required|string',
            'contact_no' => 'bail|required|string',
            'guests' => 'bail|required|integer',
            'reserve_date' => 'bail|required|date|after_or_equal:'.$currentDate,
            'menu_id' => 'bail|required|integer',
            'function_type' => 'bail|required|string',
            'function_time' => 'bail|required|string',
            'message' => 'bail|required|string',
        ]);

        $marquee = Marquee::with('user')->where('id',$request->marquee_id)->first();

        // dd($marquee->toArray());

        

        $already_booked = MarqueeBooking::where('marquee_id', $request->marquee_id)->where('reserve_date', $request->reserve_date)->where('function_time', $request->function_time)->first();

//dd($request->toArray());

        if($already_booked) {

            return redirect()->route('marquee_detail',$request->marquee_id)->with('already_booked', 'Already booked that date&time.
                Please Choose another Date!');

        } else {

            MarqueeBooking::create([
            'name' => $request->name,
            'marquee_id' => $request->marquee_id, 
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'guests' => $request->guests,
            'reserve_date' => $request->reserve_date,
            'menu_id' => $request->menu_id,
            'function_type' => $request->function_type,
            'function_time' => $request->function_time,
            'message' => $request->message,
            'status' => 'pending',
        ]);
            
        $email_data = array(
        'name' => $marquee->user->name,
        'email' => $marquee->user->email,
        'clientname' => $request->name,
        'contact_no' => $request->contact_no,
        'clientemail' => $request->email,
        );


        Mail::send('email', $email_data, function ($message) use ($email_data) {
        $message->to($email_data['email'], $email_data['name'],$email_data['clientname'],$email_data['contact_no'])
            ->subject('Marquee Booking ')
            ->from($email_data['clientemail']);
        });


            // dd(MarqueeBooking()->id);

        return redirect()->route('marquee_detail',$request->marquee_id)->with('book_message', 'We usually reply in less than 24 hours.
                    Thank you for getting in touch with us!'); 


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($status)
    {
        $bookedMarquees = MarqueeBooking::with('marquee', 'menu')->where('status', $status)->get();
        if($status === 'approved') {
            $pageTitle = 'Approved Request';
        } else {
            $pageTitle = 'Pending Request';
        }
        return view('marqueeBooking.filterBookedMarguee',compact('bookedMarquees', 'pageTitle'));
    }

    
    public function destroy($id)
    {
        $bookedMarquee = MarqueeBooking::find($id);
        $bookedMarquee->delete();

        Toastr::success('Data Deleted Successfully', 'Danger', ['positionClass' => 'toast-top-right']);

        return back();
    }

     public function userstore( Request $request){

        // dd($request->toArray());
        $this->validate($request, [
            'name' => 'string|required',
            'email' => 'email|required|unique:users',
            'password' => 'required|string|min:6',
            'contact' => 'required|max:12|string|nullable',
            'user_group_id' => 'integer|required',
        ]);
         $password  = Hash::make($request['password']);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->contact = $request->contact;
        $user->user_group_id = $request->user_group_id;
        $user->slug = Str::slug($request->name,'-');

        $user->save();
        Toastr::success('User added Successfully', 'Success', ['positionClass' => 'toast-bottom-right']);

         auth()->login($user);

            return view('frontEnd.index');
        

    }
}
