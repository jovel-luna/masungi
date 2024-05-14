@extends('web.master')




@section('content')
    {{-- @include('vendor/praxxys/ecommerce/paypal/includes/js') --}}
    <section class="page-innerFrame bg-white contact-fr1 frame1">
        <div class="page-container">
            <div class="width--90 margin-a">
                <div class="page-innerFrame__title align-c">
                    <h1>Payment</h1>
                </div>
                <div class="page-general width--80 margin-a align-c">
                    <p>Please wait.</p>
                    <p>We will redirect you to paypal.</p>
                    <p id='total' style="display:none">{{ $total }}</p>

                    <p>Still not showing? Click the button below</p>
                    <button type="button" class="btn btn-primary button type-1" data-toggle="modal" data-backdrop="false"
                        data-target="#paypalpayment">
                        <span>
                            Proceed to Paypal
                        </span>

                    </button>

                </div>
            </div>

            <div class="my-5" style="position: relative; height: 100px;">

                {{-- Override praxxys Payment Functionality due to link issues --}}

                {{-- <payment reference_code="{{ $reference_code }}" :total="{{ $total }}"></payment> --}}

                <div id="payment-loader" style="display: grid; visibility: hidden;">
                    <svg viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" width="64" height="64" stroke="#000"
                        style="justify-self: center;">
                        <g fill="none" fill-rule="evenodd">
                            <g transform="translate(1 1)" stroke-width="2">
                                <circle stroke-opacity=".25" cx="18" cy="18" r="18"></circle>
                                <path d="M36 18c0-9.94-8.06-18-18-18">
                                    <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18"
                                        dur="0.8s" repeatCount="indefinite"></animateTransform>
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>

                <!-- Button trigger modal -->
                <button id="open-modal" type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="false"
                    data-target="#paypalpayment" style="visibility: hidden;">
                </button>

                <button id="open-modal-confirm-success" type="button" class="btn btn-primary" data-toggle="modal"
                    data-backdrop="false" data-target="#confirmation-success" style="visibility: hidden;">
                </button>

                <button id="open-modal-confirm-fail" type="button" class="btn btn-primary" data-toggle="modal"
                    data-backdrop="false" data-target="#confirmation-fail" style="visibility: hidden;">
                </button>

                <!-- Modal -->
                <div class="modal fade" id="paypalpayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Choose Payment Options</h5>
                                <button id='paypalpayment-close' type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                

                                <div id="paypal-button-container"></div>
                                <p id="result-message"></p>
                            </div>
                            {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div> --}}
                        </div>
                    </div>
                </div>


                {{-- Confirmation Success --}}
                <div class="modal fade" id="confirmation-success" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Paypal Payment Notification</h5>
                                <button type="button" id="success-close" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Settlement of Conservation Fee Confirmed
                            </div>
                            {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> --}}
                        </div>
                    </div>
                </div>

                {{-- Confirmation Fail --}}
                <div class="modal fade" id="confirmation-fail" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Paypal Payment Notification</h5>
                                <button type="button" id="failed-close" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Settlement of Conservation Fee Failed. Pls check your Account Status or Try again using a
                                different card
                            </div>
                            <div class="modal-footer">
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('payment-loader').style.visibility = 'visible'
                setTimeout(function() {
                    document.getElementById('open-modal').click()
                    document.getElementById('payment-loader').style.visibility = 'hidden'
                }, 5000);



            });
        </script>

    </section>
@endsection
