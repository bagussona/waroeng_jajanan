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
        <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
    </div>
    <form method="post">
        <h3>Drop Us a Message</h3>
       <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" />
                </div>
                <div class="form-group">
                    <input type="text" name="txtEmail" class="form-control" placeholder="Your Email *" value="" />
                </div>
                <div class="form-group">
                    <input type="text" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
