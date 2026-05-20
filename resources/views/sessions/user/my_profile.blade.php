@extends('layout')
@section('main')
    <header>
        @include("components/sidebar")

        @include("components/navbar")
    </header>
    <main style="margin-top: 58px">
        <div class="container-fluid pt-4 px-5">
            @if(session('status'))
                <div class="alert alert-success my-3">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger my-3">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-primary py-2">
                            <h2 class="text-center text-light mb-4">Welcome @if($user->preferred_name == NULL) {{$user->first_name}} @else {{$user->preferred_name}} @endif {{$user->last_name}}</h2>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-3">
                                <div class="col mb-4 mb-lg-0">
                                    <div class="card">
                                        <div class="card-header bg-primary">
                                            <h2 class="text-center text-light mb-4">Account Details</h2>
                                        </div>
                                        <div class="card-body">
                                            <form action="/update_account_details" method="post">
                                                @csrf
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <div class="form-outline">
                                                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{$user->first_name}}" required>
                                                            <label class="form-label" for="first_name">First Name:</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-outline">
                                                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{$user->last_name}}" required>
                                                            <label class="form-label" for="last_name">Last Name:</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <div class="form-outline">
                                                            <input type="text" name="preferred_name" id="preferred_name" class="form-control" value="{{$user->preferred_name}}">
                                                            <label for="preferred_name" class="form-label">Preferred Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col">
                                                        <div class="form-outline">
                                                            <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" required>
                                                            <label for="email" class="form-label">eMail Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-outline">
                                                            <input type="tel" name="phone" id="phone" class="form-control" value="{{$user->phone}}">
                                                            <label for="phone" class="form-label">Phone Number</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col text-center">
                                                        <button type="submit" class="btn btn-primary w-50">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @if(\App\Models\SetupKeys::where('key', '=', 'use_subscriptions')->first()->value == 1)
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                <h2 class="text-center text-light mb-4">Membership Details</h2>
                                            </div>
                                            <div class="card-body text-center">
                                                @if($user->subscribed('acolyte'))
                                                    <h3 class="text-success">Active!</h3>
                                                @else
                                                    <h3 class="text-danger">Inactive!</h3>
                                                @endif
                                                @if(!DB::table('subscriptions')->where('user_id', '=', Auth::id())->get()->isNotEmpty())
                                                    <button class="btn btn-primary mt-4" data-mdb-toggle="modal" data-mdb-target="#membershipProfileModal">Subscribe!</button>
                                                @else
                                                    <button class="btn btn-primary mt-4"><a class="text-light" href="/manage_my_membership">Manage My Subscription</a></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://js.stripe.com/v3/"></script>
    <div class="modal fade" id="membershipProfileModal" tabindex="-1" aria-labelledby="membershipProfileModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header bg-primary py-2">
                            <h2 class="text-center text-light mb-4">Purchase Membership</h2>
                        </div>
                        <div class="row row-cols-1">
                            <div class="col">
                                <div class="card-body">
                                    <div class="align-self-center">
                                        <form id="payment-form" action="/membership" method="post">
                                            @csrf
                                            @foreach($licenses as $license)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="stripe_product_api_id" id="stripe_product_api_id" value="{{$license->stripe_api_id}}" checked/>
                                                    <label class="form-check-label" for="stripe_product_api_id"> {{$license->name}} | ${{$license->price}} per month</label>
                                                </div>
                                            @endforeach
                                            <div class="form-outline mb-3 mt-3">
                                                <input class="form-control" type="text" name="card-holder-name" id="card-holder-name">
                                                <label for="card-holder-name" class="form-label">Card Holder Name</label>
                                            </div>
                                            {{--                                <input type="hidden" name="stripe_product_api_id" value="price_1MKtAMDjmfzU3OGgWBy30pag">--}}
                                            <input type="hidden" name="paymentMethod" id="paymentMethod" value="">
                                            <div id="payment-element">
                                                <!-- Elements will create input elements here -->
                                            </div>

                                            <!-- We'll put the error messages in this element -->
                                            <div id="card-errors" role="alert"></div>

                                            <div class="text-center">
                                                <button id="card-button" class="btn btn-primary w-50 mt-5">Submit Payment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!DB::table('subscriptions')->where('user_id', '=', Auth::id())->get()->isNotEmpty())
        <script>
            const stripe = Stripe("{{config('app.STRIPE_KEY')}}");
            const options = {
                clientSecret: "{{$intent->client_secret}}"
            }
            const elements = stripe.elements(options);
            const cardElement = elements.create('payment');
            cardElement.mount('#payment-element');

            const cardHolderName = document.getElementById('card-holder-name').value;
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            document.getElementById('payment-form').addEventListener('submit', async (e) => {
                e.preventDefault();
                const { setupIntent, error } = await stripe.confirmSetup({
                        elements,
                        confirmParams: {
                            return_url: 'http://localhost:8000/home'
                        },
                        redirect: "if_required",
                    }
                );

                if (error) {
                    let displayError = document.getElementById('card-errors');
                    displayError.textContent = error.message;
                } else {
                    stripeTokenHandler(setupIntent);
                }
            });
            function stripeTokenHandler(setupIntent) {
                document.getElementById('paymentMethod').value = setupIntent.payment_method;
                submitForm(1);
            }
            function submitForm($submit) {
                if($submit === 1) {
                    document.getElementById('payment-form').submit();
                }
            }
        </script>
    @endif
@endsection
