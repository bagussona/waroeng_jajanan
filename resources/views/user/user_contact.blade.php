@extends('layouts.ecommerce')
{{-- {{ url('profile/contact.css')}} --}}

@section('title')
    <title>Contact - {{ env('APP_NAME') }}</title>
@endsection

@section('content')
    <div>
        <div class="row">1</div>
    </div>
    <div>
        <div class="row">2</div>
    </div>
    <div>
        <div class="row">3</div>
    </div>
    <div>
        <div class="row">4</div>
    </div>
    <div>
        <div class="row">5</div>
    </div>
    <div>
        <div class="row">6</div>
    </div>
    <div class="container contact-form">
        <div class="contact-image">
            <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact" />
        </div>
        <form method="post" action="#">
            @csrf

            <h3>Drop Us a Message</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name *" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Your Email *" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="nohape" class="form-control" placeholder="Your Phone Number *" />
                    </div>
                    <div class="form-group">
                        <button type="submit" name="btnSubmit" class="btn btn-primary" disabled>Send Message</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea name="message" class="form-control" placeholder="Your Message *"
                            style="width: 100%; height: 150px;"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
