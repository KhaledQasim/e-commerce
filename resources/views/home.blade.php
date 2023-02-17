@extends('layouts.app')


@section('content')



<main>

    <div class="section one ">
        <p class=" t2">EXPRESS YOURSELF</p>
        </p>
        <p class="t2">THE FINEST SUSTAINABLE UNISEX JEWELLERY</p>
        <p class="t5">CRAFTED BY OUR VERY OWN JEWELERS</p>

    </div>

    <div class="section three" id="rings">
        <p class="t1">RINGS</p>
        <p class="t2">ADORN YOUR STYLE</p>
        <p class="t3">Rings effortlessly add style to your favourite ensembles. Create a signature look with classic
            bands for everyday, and intricate designs, perfect for stacking.Find style inspiration, no matter the
            occasion. Each item from Jewelz has been handcrafted to the highest standards, so you can rely on
            impeccable quality with every purchase. Browse our collection and find a ring to suit the recipient's taste
            and style.</p>
        <p class="t4">
            <a href="{{ url('/shop-ring') }}">BROWSE</a>
        </p>
    </div>
    <div id="section3">
        <img src="{{ asset('images/pexels-goran-vrakela-230290.jpg') }}" alt="ring">
    </div>

    <div class="section four" id="necklaces">
        <p class="t1">NECKLACES</p>
        <p class="t2">HANDCRAFTED SILVER AND GOLD</p>
        <p class="t3">Necklaces are the perfect finishing touch for any outfit. With dainty pieces and statement designs
            to enhance your look, you'll find exactly what you need to showcase your personal style.</p>
        <p class="t4"><a href="{{ url('/shop-necklace') }}">BROWSE</a></p>
    </div>
    <div id='section4'>
        <img src="{{ asset('images/pexels-goran-vrakela-230290.jpg') }}" alt="necklace">
    </div>

    <div class="section five" id="bracelets">
        <p class="t1">BRACELETS</p>
        <p class="t2">NEW LAUNCHED COLLECTION</p>
        <p class="t3">Bracelets are the classic jewellery that adds the finishing touch to a Jewellery set. From gold
            and silver bracelets, to minimalist bangles for every occasion. We have pieces for all your styling needs.
        </p>
        <p class="t4"><a href="{{ url('/shop-bracelet') }}">BROWSE</a></p>
    </div>
    <div id='section5'>
        <img src="{{ asset('images/pexels-goran-vrakela-230290.jpg') }}" alt="bracelet">
    </div>

    <div class="section six" id="earrings">
        <p class="t1">EARRINGS</p>
        <p class="t2">STYLE ESSENTIALS</p>
        <p class="t3">Look and feel amazing in a pair of our sensationally sparkling diamond earrings. Handcrafted with
            only the finest conflict-free <br> diamonds, they'll add a touch of luxury to any occasion.</p>
        <p class="t4"><a href="{{ url('/shop-earring') }}">BROWSE</a></p>
    </div>
    <div id='section6'>
        <img src="{{ asset('images/pexels-goran-vrakela-230290.jpg') }}" alt="earring">
    </div>

</main>




@endsection