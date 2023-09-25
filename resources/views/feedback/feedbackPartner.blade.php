<x-app-layout>
    <style>
        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 10px 4px;
            font-size: 28px;
            color: white;
            text-shadow: 0 0 5px rgba(0, 0, 0, .3);
            transition: all .2s;
        }

        input.star:checked~label.star:before {
            content: '\f005';
            color: red;
            transition: all .25s;
        }

        input.star-5:checked~label.star:before {
            color: #FE7;
            text-shadow: 0 0 5px 10px #952;
        }

        input.star-1:checked~label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: scale(1.2);
        }

        label.star:before {
            content: '\f005';
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: FontAwesome;
        }

        .get-in-touch {
            max-width: 800px;
            margin: 50px auto;
            position: relative;

        }
        
        .pos{
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
            color: #fb2605;
        }

        .get-in-touch .title {
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 3.2em;
            line-height: 48px;
            padding-bottom: 48px;
            color: #5543ca;
            background: #5543ca;
            background: -moz-linear-gradient(left, #f8bb85 0%, #fb2605 100%) !important;
            background: -webkit-linear-gradient(left, #f8bb85 0%, #fb2605 100%) !important;
            background: linear-gradient(to right, #f8bb85 0%, #fb2605 100%) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }

        .contact-form .form-field {
            position: relative;
            margin: 32px 0;
        }

        .contact-form .input-text {
            display: block;
            width: 100%;
            height: 36px;
            border-width: 0 0 2px 0;
            border-color: #fb2605;
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
        }

        .contact-form .input-text:focus {
            outline: none;
        }

        .contact-form .input-text:focus+.label,
        .contact-form .input-text.not-empty+.label {
            -webkit-transform: translateY(-24px);
            transform: translateY(-24px);
        }

        .contact-form .label {
            position: absolute;
            left: 20px;
            bottom: 11px;
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
            color: #fb2605;
            cursor: text;
            transition: -webkit-transform .2s ease-in-out;
            transition: transform .2s ease-in-out;
            transition: transform .2s ease-in-out,
                -webkit-transform .2s ease-in-out;
        }
        .rate{
            left: 20px;
            bottom: 11px;
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
            color: #fb2605;
            cursor: text;
            transition: -webkit-transform .2s ease-in-out;
            transition: transform .2s ease-in-out;
            transition: transform .2s ease-in-out,
                -webkit-transform .2s ease-in-out;
        }
        .contact-form .submit-btn {
            display: inline-block;
            background-color: #000;
            background-image: linear-gradient(125deg, #d75353, #fb2605);
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 16px;
            padding: 8px 16px;
            border: none;
            width: 260px;
            cursor: pointer;
        }
    </style>
    <section class="get-in-touch">
        <h1 class="title">Please rate the client</h1>
        
        <form class="contact-form row" method="post" action="/feedback/add">
            @csrf
            <input type="hidden" value="{{ $demandeId }}" name="demande_id">
            <input type="hidden" value="{{ $id }}" name="user_id">
            
            <div class="w-full mb-4" >
                <label for="role" value="Rate the client sympathie"
                    class="font-semibold text-black text-lg" />
                    <div class="col-12" style="text-align: center;">
                        <label class="pos">
                            <input type="radio" name="feedback" value="0">
                            Positive
                        </label>
                    
                        <label class="pos">
                            <input type="radio" name="feedback" value="1">
                            Negative
                        </label>
                    </div>
                    <h4 class="rate">&nbsp Rate client</h4>

                <div class="w-full flex justify-center">
                    <div class="inline-block">
                        <input class=" star star-5 " id="star-5" type="radio" name="star"
                            value="5" />
                        <label class="icon star star-5" for="star-5"></label>
                        <input class=" star star-4 " id="star-4" type="radio" name="star"
                            value="4" />
                        <label class="icon star star-4" for="star-4"></label>
                        <input class=" star star-3" id="star-3" type="radio" name="star"
                            value="3" />
                        <label class="icon star star-3" for="star-3"></label>
                        <input class=" star star-2" id="star-2" type="radio" name="star"
                            value="2" />
                        <label class="icon star star-2" for="star-2"></label>
                        <input class=" star star-1" id="star-1" type="radio" name="star"
                            value="1" />
                        <label class="icon star star-1" for="star-1"></label>
                    </div>
                </div>
            </div>
            <div class="form-field col-lg-12">
                <input id="message" name="comment" class="input-text js-input" type="text" required>
                <label class="label" name="comment" for="message">Anything to say about the Client</label>
            </div>
    
    
            <div class="form-field col-lg-12">
                <input class="submit-btn" type="submit" value="Send your feedback">
             </div>
        </form>
    </section>
    
</x-app-layout>



