@extends('layout')
@section('main')
{{--    {{dd($intent)}}--}}
    <header>
        @include("components/sidebar")

        @include("components/navbar")
        <style>

        </style>
    </header>
    <script src="https://js.stripe.com/v3/"></script>
    <main style="margin-top: 58px">
        @if(\App\Models\SetupKeys::where('key', '=', 'use_subscriptions')->first()->value != 1)
            <script>
                window.location.replace('/home');
            </script>
        @endif
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
                                            <input type="hidden" name="paymentMethod" id="paymentMethod" value="">
                                            <div id="card-element"></div>

                                            <!-- We'll put the error messages in this element -->
                                            <div id="card-errors" role="alert"></div>

                                            <div class="text-center">
                                                <button id="card-button" class="btn btn-primary w-50 mt-5" data-secret="{{$intent->client_secret}}">Submit Payment</button>
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
    </main>
    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        document.getElementById('payment-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            cardButton.disabled = true;

            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret,
                {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value,
                        },
                    },
                },
            );

            if (error) {
                let displayError = document.getElementById('card-errors');
                displayError.textContent = error.message;
                cardButton.disabled = false;
            } else {
                document.getElementById('paymentMethod').value = setupIntent.payment_method;
                document.getElementById('payment-form').submit();
            }
        });
    </script>
@endsection
