@extends('layouts.app') 
@php
$global = Config::get('static_meta.atlantis-the-royal-residences', []);
$meta_title = $global[0] ?? '';
$meta_description = $global[1] ?? '';
@endphp
@section('title', $meta_title ?: 'Atlantis The Royal Residences')
@section('meta')
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="{!! $meta_description ?: '' !!}" />
    <meta name="description" content="{!! $meta_description ?: '' !!}">
@endsection

@section('content')
<section class="banner inr-banner mb-4" style="background-image: url({{ asset('/img/inr-banner.png') }});">
    <div class="container">
        <div class="slider-info">
            <div class="BannerBox">
                <div class="banner-heading text-center">
                    <h1>@yield('title')</h1>
                </div>
            </div>
        </div>
    </div>
</section>
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <h1>
                    Property Description
                </h1>
                <p>
                    Introducing the next evolution of Atlantis: Atlantis, The Royal, where modern guest rooms and suites, sophisticated design, and endless horizons meet a collection of the world's best chefs.
                </p>
                <p>
                    An artistic dream turns real amidst the scenic landscape of Dubai in the form of Atlantis, The Royal Residences. Strategically located at the crescent of the Palm and close to the iconic Atlantic Resort, this next-gen luxury residential property offers a sophisticated lifestyle that many desire to experience. At Atlantis, you can enjoy infinite ocean views, lush green spaces and a spirited contrast between fire and water, all captured in dramatic architecture. Residents can experience the ultimate luxury by having access to the world’s most renowned chef at the Atlantis.
                </p>
                <p>
                    Atlantis, The Royal Residences is more than just a place to call home – it's a culinary destination in its own right. With restaurants and bars led by some of the world's most famous chefs, you'll be spoilt for choice when it comes to dining options at Atlantis. Indulge in gastronomic delights at Dinner by Heston Blumenthal, savour the flavours of the Mediterranean at Milos by Costas Spiliadis, or experience the vibrant Peruvian cuisine of La Mar by Gastón Acurio. Other highlights of these apartments for sale include Jaleo by José Andrés, Hakkasan and&nbsp; Ariana's Kitchen by Ariana Bundy.
                </p>
                <p>
                    Whether you're seeking a permanent residence or a vacation home, Atlantis, The Royal Residences offers a consummate lifestyle that combines the best of luxury living with the excitement and energy of Dubai. Don't miss your chance to live your best life – book your viewing today and discover the ultimate in upscale living with our apartments-for-sale listings.
                </p>
                <h2>
                    The Signature Collection
                </h2>
                <p>
                    The Signature Collection presents the most exclusive Residences at Atlantis, The Royal and will offer the ultimate in luxury lifestyle living. Every home has been designed to showcase the most breathtaking views imaginable. With private terraces that seem to float in the sky, you'll enjoy an unobstructed sense of serenity and space, with vistas that stretch as far as the eye can see. For those seeking the ultimate in indulgence, many of the Signature Residences come complete with their own private pools, perfect for refreshing dips on hot summer days or evening swims under the stars.
                </p>
                <p>
                    Step inside and you'll be greeted by warm and inviting interiors that have been crafted to the highest standards of luxury and comfort. From the finest materials to the most exquisite finishes, every detail has been carefully considered to create the perfect place to call home.
                </p>
                <p>
                    Entertain in style with expansive entertainment areas that seamlessly flow from indoors to out, providing the ideal setting for everything from intimate gatherings to large-scale events. And with grand gardens that surround your home, you'll enjoy a sense of peace and tranquillity that's simply unparallelled.
                </p>
                <h2>
                    The Signature Collection apartments for sale will define a new level of luxury in Dubai.
                </h2>
                <p>
                    The goal of this magnificent cluster is to give you the best possible lifestyle in Dubai. The Signature Collection is the result of a collaborative effort between designers and artisans. The design and architecture feature one-of-a-kind ideas that combine a strong sense of home and community with luxurious details. Private and tranquil, your Sky Court Dwelling is a luxurious oasis in the clouds, complete with stunning outdoor spaces like gardens and pools. The Garden Suites feature architecturally landscaped gardens and spacious recreation areas, while the Penthouses will set a new standard for opulence as the pinnacle of residential design.
                </p>
                <p>
                    All tenants have access to the building's private concierge service. In Atlantis, The Royal team offers service 24/7 to provide exceptional assistance and special perks to their royal guests. If you need assistance with anything, from housekeeping to having butlers prepare a five-course meal for you to booking a private jet, you can rest assured that you will receive the highest degree of service possible.
                </p>
                <h3>
                    The creature comfort amenities
                </h3>
                <p>
                    <strong>Skypool</strong>
                </p>
                <p>
                    Experience elevated expectations with a world-class Sky Pool. The terrace is the spot where a 90-metre-high infinity pool will greet you with the ultimate sanctuary for lounging, socialising, and daytime fun. As the sun sets over Dubai, the Sky Pool transforms into an unrivalled hotspot for sophisticated nightlife.
                </p>
                <p>
                    <strong>Celebrity restaurants</strong>
                </p>
                <p>
                    Discover the ultimate dining destination, where an exceptional group of world-renowned chefs from around the world has come together in a singular location that is truly unique and unparallelled. Go for something traditional at the Persian restaurant of Iranian-American celebrity chef Ariana Bundy or enjoy your staples at the Bread Street Kitchen of Gordon Ramsay with high signatures of British cuisine. You can also find other restaurants at the Atlantis, including Estiatorio Milos by Costa Spiliadis, La Mar by Gaston Acurio and the authentic Japanese restaurant by Nobu Matsuhisa.
                </p>
                <p>
                    <strong>Oceanfront Playground</strong>
                </p>
                <p>
                    Atlantis The Royal is a stunning oceanfront property that embraces the beauty and splendour of the sea. The apartments for sale here come loaded with a variety of amenities designed to allow residents to fully immerse themselves in their oceanfront playground. From exclusive swimming pools to private beaches located right at your doorstep, you can indulge in everything that this paradise has to offer. Additionally, the resort offers a range of water activities, such as snorkeling or scuba diving in The Ambassador Lagoon at Atlantis, The Palm, that are sure to provide a memorable experience.
                </p>
                <p>
                    <strong>Fitness and Spa</strong>
                </p>
                <p>
                    The Spa at Atlantis The Royal is a luxurious retreat that invites you to escape the hustle and bustle of everyday life and experience complete well-being. Immerse yourself in the tranquil atmosphere and indulge in bespoke treatments that are tailored to your individual needs, whether you are looking to relax or re-energise. The residents-only gym is designed with a modern style and features knowledgeable trainers and therapists who are dedicated to providing you with the ultimate pampering experience.
                </p>
                <p>
                    &nbsp;
                </p>
                <h2>
                    Local Community
                </h2>
                <p>
                    Palm Island, rising from the Arabian Sea, is one of the new seven marvels of the world. The Palm offers a posh beachside neighbourhood with a lively dining and entertainment scene. It is only a half-drive hour from Dubai International Airport.
                </p>
                <p>
                    Dubai has always been revolutionary, and the Dubai Plan 2021 supports the vision of Dubai being the ultimate destination to call home. The Plan describes the future for Dubai, starting with its people and creating an environment built for success for every member of its community. A leading living experience includes a safe environment and Dubai is the sixth safest city in the world. In addition, education plays an important role in the life of every citizen and there are over 200 international schools in Dubai. Dubai is also an easy home base for any traveller with the award-winning Dubai International Airport and over two thirds of the world within an eight-hour flying radius.
                </p>
                <p>
                    When you call Atlantis, The Royal home, you are living in the centre of the world. With 80% of countries within a 10-hour flight and Dubai International Airport just 30 minutes away, home to some of the best airlines in the world, travel is easy and effortless
                </p>
            </div>
        </div>
    </div>
@endsection
