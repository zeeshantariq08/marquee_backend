@extends('layouts.frontEndLayout')

@section('header')
    @include('frontEnd.header')
@endsection

@section('content')

<div class="content" style="margin-top: 30px;">
                    <div class="container heading-style">
                        <i class="fa fa-envelope heading-icon color-night-dark font-17"></i>
                        <h4 class="heading-title">Get in touch!</h4>
                        <p class="heading-subtitle">
                            Register Your Marquee. Fill the form and submit it. <br>
                            We will contact you soon.
                        </p>
                    </div>
                    <div class="container no-bottom">
                        <div class="contact-form no-bottom">
                            
        @if (Session::has('marquee_message'))
            <div class="notification-large notification-has-icon notification-green">
                <div class="notification-icon"><i class="fa fa-check notification-icon"></i></div>
                <h1 class="uppercase ultrabold" style="text-align:left;">Message Sent</h1>

                <p> {{ Session::get('marquee_message')}} </p>

                <a href="#" class="close-notification"><i class="fa fa-times"></i></a>
            </div>
        @endif
                            <form action="{{ route('marq-request') }}" method="post" class="contactForm">
                                @csrf
                                <fieldset>
                                    <div class="formValidationError bg-red-dark" id="contactNameFieldError">
                                        <p class="center-text uppercase small-text color-white">Name is required!</p>
                                    </div>
                                    <div class="formValidationError bg-red-dark" id="contactEmailFieldError">
                                        <p class="center-text uppercase small-text color-white">Mail address required!</p>
                                    </div>
                                    <div class="formValidationError bg-red-dark" id="contactEmailFieldError2">
                                        <p class="center-text uppercase small-text color-white">Mail address must be valid!</p>
                                    </div>
                                    <div class="formValidationError bg-red-dark" id="contactMessageTextareaError">
                                        <p class="center-text uppercase small-text color-white">Message field is empty!</p>
                                    </div>
                                    <div class="formFieldWrap">
                                        <label class="field-title contactNameField" for="contactNameField">Name:<span>(required)</span>
                                        </label>
                                        <input type="text" name="name" value="" class="contactField requiredField" required id="contactNameField" />
                                    </div>
                                    
                                    <div class="formFieldWrap">
                                        <label class="field-title contactEmailField" for="contactEmailField">Email: <span>(required)</span>
                                        </label>
                                        <input type="text" name="email" required value="" class="contactField requiredField requiredEmailField" id="contactEmailField" />
                                    </div>
                                    <div class="formFieldWrap">
                                        <label class="field-title contactNameField" for="contactNameField">Phone No:<span>(required)</span>
                                        </label>
                                        <input type="number" name="phone" required class="contactField requiredField" id="contactNameField" />
                                    </div>
                                    <div class="formTextareaWrap">
                                        <label class="field-title contactMessageTextarea" for="contactMessageTextarea">Message: <span>(required)</span>
                                        </label>
                                        <textarea name="desc"  required class="contactTextarea requiredField" id="contactMessageTextarea"></textarea>
                                    </div>
                                    <div class="contactFormButton">
                                        {{-- <input type="submit" class="buttonWrap button bg-blue-dark button-sm button-rounded uppercase ultrabold contactSubmitButton" id="contactSubmitButton" value="Send Message" data-formId="contactForm" /> --}}
                                       <button type="submit" class="button button-rounded btn-sm" style="text-align: center;background: #88211a;">Submit</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="decoration"></div>
                    
                </div>

@endsection

@section('footer')
    @include('frontEnd.footer')
@endsection