<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alexandra és Gábor</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
</head>

<body>
    <div id="app">

        <div id="header" class="h-header">
            <div class="absolute top-0 w-full -z-10">
                <img src="/img/desktop.png" alt="Levelek" class="hidden sm:block">
                <img src="/img/mobile.png" alt="Levelek" class="sm:hidden">
            </div>

            <div class="h-full flex flex-col justify-center text-center">
                <h1 class="mt-48 sm:mt-title dd-magenta text-4xl md:text-title">Alexandra és Gábor</h1>
                <p class="mb-16 sm:mb-32 tracking-wider text-xl md:text-subtitle">19.07.20</p>
            </div>
        </div>

        <div sticky-container>

            <div id="menu" class="h-12 md:h-20 bg-white-opa dd-shadow mb-12 mt-8 md:mt-0" v-sticky sticky-side="top">
                <div
                    class="w-screen overflow-x-scroll md:overflow-auto h-full flex md:justify-center items-center md:text-xl">
                    <a class="p-3 md:p-5" href="#program" v-scroll-to="'#program'">Program</a>
                    <a class="p-3 md:p-5" href="#rsvp" v-scroll-to="'#rsvp'">Visszajelzés</a>
                    <a class="p-3 md:p-5" href="#hotels" v-scroll-to="'#hotels'">Szállás</a>
                    <a class="p-3 md:p-5" href="#pictures" v-scroll-to="'#pictures'">Képek</a>
                    <a class="p-3 pr-20 md:p-5" href="#music" v-scroll-to="'#music'">Zene</a>
                </div>
            </div>

            <div id="intro" class="dd-block dd-block-left">
                <div class="dd-container dd-editor flex items-center flex-col md:flex-row">
                    <div class="flex-1 mb-8 md:mb-0 md:mr-8">
                        <p class="dd-title">Szia!</p>
                        <p>
                            Nagyon örülünk, hogy velünk ünnepelsz.
                        </p>
                        <p>
                            Itt megtalálod a fontosabb időpontokat és helyszíneket, valamint adunk néhány tippet
                            a szálláshelyekhez.
                        </p>
                        <p>
                            Kérünk jelezz vissza, hogy tudsz-e jönni és azt is írd meg, hogy hányan érkeztek és
                            van-e valakinek ételallergiája.
                        </p>
                        <p>A képeket is itt keresd majd. Ha bármiben tudunk segíteni, hívj bátran!</p>
                    </div>

                    <img class="md:flex-1 md:h-full md:w-1/2 rounded-lg" src="/img/intro.jpg" alt="Alexandra és Gábor">
                </div>
            </div>

            <div id="program" class="dd-block">
                <div class="dd-container flex flex-col md:flex-row">
                    <div class="dd-editor">
                        <h2 class="dd-title">Program</h2>
                        <div class="mt-6">
                            <p class="flex items-center">@svg('stemware') <span
                                    class="flex-shrink-0 pl-2 mr-4 w-16 text-center text-sec-500 border-l-2 border-gray-300">14:30</span>
                                Vendégvárás</p>
                            <p class="flex items-center">@svg('wedding-car') <span
                                    class="flex-shrink-0 pl-2 mr-4 w-16 text-center text-sec-500 border-l-2 border-gray-300">15:00</span>
                                Indulás a templomba</p>
                            <p class="flex items-center">@svg('church') <span
                                    class="flex-shrink-0 pl-2 mr-4 w-16 text-center text-sec-500 border-l-2 border-gray-300">16:00</span>
                                Egyházi szertartás</p>
                            <p class="flex items-center">@svg('wedding-ring') <span
                                    class="flex-shrink-0 pl-2 mr-4 w-16 text-center text-sec-500 border-l-2 border-gray-300">18:00</span>
                                Polgári szertartás</p>
                            <p class="flex items-center">@svg('camera') <span
                                    class="flex-shrink-0 pl-2 mr-4 w-16 text-center text-sec-500 border-l-2 border-gray-300">18:30</span>
                                Fotózás</p>
                            <p class="flex items-center">@svg('wedding-dinner') <span
                                    class="flex-shrink-0 pl-2 mr-4 w-16 text-center text-sec-500 border-l-2 border-gray-300">20:00</span>
                                Vacsora</p>
                        </div>
                    </div>
                    <div class="h-map flex-1 my-8 md:ml-4">
                        <gmap :coords="[
                                {lat: 46.8825259, lng: 19.6845325, icon:'tent', url:'https://goo.gl/maps/GWxZNQhczoPLeVgJ7', title:'Bajor Étterem'},
                                {lat: 46.9199218, lng: 19.6701945, icon:'church', url:'https://goo.gl/maps/HTDqVAQdVWbrVmGn6', title:'Szentcsalád Plébánia'},
                            ]"></gmap>
                    </div>
                </div>
            </div>

            <div id="rsvp" class="dd-block dd-block-right">
                <div class="dd-container dd-editor mb-12">
                    <h2 class="dd-title">Visszajelzés</h2>
                    <p>
                        Ha még nem tetted meg máshogy, itt is visszajelezhetsz, hogy hányan jöttök.
                        Ez nekünk nagyon fontos információ.
                    </p>
                </div>
                @include('includes/form')
            </div>

            <div id="hotels" class="dd-block">
                <div class="dd-container">
                    <div class="dd-editor">
                        <h2 class="dd-title">Szállás</h2>
                        <p>
                            Ez csak néhány javaslat.
                        </p>
                        <p>
                            Hogy ne kelljen választanotok a buli és a vezetés között, saját futárszolgálatot
                            biztosítunk, akik segítenek a hazajutásban.
                        </p>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="mt-8 w-full md:w-1/2">
                            <p class="dd-title">1. Mediterrán vendégház</p>
                            <p><a target="_blank"
                                    href="https://mediterranvendeghaz.webnode.hu/">mediterranvendeghaz.webnode.hu</a>
                            </p>
                            <p><a target="_blank" href="https://goo.gl/maps/bV3PaKywJ3XafwGCA">6000, Kecskemét, Kápolna
                                    u. 10.</a></p>
                            <p><a href="tel:+36203639663">06-20-363-9663</a></p>
                        </div>

                        <div class="mt-8 w-full md:w-1/2">
                            <p class="dd-title">2. Gokart hotel</p>
                            <p><a target="_blank" href="http://gokarthotel.hu/">www.gokarthotel.hu</a></p>
                            <p><a target="_blank" href="https://goo.gl/maps/TsdZunE8S9rh5Z7i8">6000, Kecskemét, Szent
                                    László krt. 64.</a></p>
                            <p><a href="tel:+3676505175">06-76-505-175</a></p>
                        </div>

                        <div class="mt-8 w-full md:w-1/2">
                            <p class="dd-title">3. Barokk antik panzió</p>
                            <p><a target="_blank" href="http://www.barokkantik-panzio.hu/">www.barokkantik-panzio.hu</a>
                            </p>
                            <p><a target="_blank" href="https://goo.gl/maps/i5PbTHY8DEWqHhxr7">6000, Kecskemét, Fráter
                                    György u. 17.</a></p>
                            <p><a href="tel:+36702570906">06-70-257-0906</a></p>
                        </div>

                        <div class="mt-8 w-full md:w-1/2">
                            <p class="dd-title">4. Véndiófa szálláshely</p>
                            <p><a target="_blank" href="https://ven-diofa.hu/">www.ven-diofa.hu</a></p>
                            <p><a target="_blank" href="https://goo.gl/maps/e7kPrTDCeagqzZsL8">6000, Kecskemét, Horog u.
                                    5.</a></p>
                            <p><a href="tel:+3676509556">06-76-509-556</a></p>
                        </div>

                        <div class="mt-8 w-full md:w-1/2">
                            <p class="dd-title">5. Hotel Uno</p>
                            <p><a target="_blank" href="http://hoteluno.hu">www.hoteluno.hu</a></p>
                            <p><a target="_blank" href="https://goo.gl/maps/tVfK6uQR7P3NTrYY7">6000, Kecskemét, Beniczky
                                    Ferenc u. 4.</a></p>
                            <p><a href="tel:+3676476697">06-76-476-697</a></p>
                        </div>

                        <div class="mt-8 w-full md:w-1/2">
                            <p class="dd-title">6. Hotel Central</p>
                            <p><a target="_blank" href="https://hotelcentralpassage.hu/">www.hotelcentralpassage.hu</a>
                            </p>
                            <p><a target="_blank" href="https://goo.gl/maps/JCEmPJTtKV7nEGJU8">6000, Kecskemét Kisfaludy
                                    u. 10.</a></p>
                            <p><a href="tel:+3676222444">06-76-222-444</a></p>
                        </div>
                    </div>
                </div>
                <div class="h-map-big mt-12">
                    <gmap :izoom="13" :coords="[
                            {lat: 46.90977, lng: 19.6861874, icon:'1', url:'https://goo.gl/maps/bV3PaKywJ3XafwGCA', title:'Mediterrán vendégház'},
                            {lat: 46.882664, lng: 19.697355, icon:'2', url:'https://goo.gl/maps/TsdZunE8S9rh5Z7i8', title:'Gokart hotel'},
                            {lat: 46.9107869, lng: 19.6865061, icon:'3', url:'https://goo.gl/maps/i5PbTHY8DEWqHhxr7', title:'Barokk antik panzió'},
                            {lat: 46.9023898, lng: 19.690167, icon:'4', url:'https://goo.gl/maps/e7kPrTDCeagqzZsL8', title:'Véndiófa szálláshely'},
                            {lat: 46.907187, lng: 19.6942433, icon:'5', url:'https://goo.gl/maps/tVfK6uQR7P3NTrYY7', title:'Hotel Uno'},
                            {lat: 46.9045853, lng: 19.6882886, icon:'6', url:'https://goo.gl/maps/JCEmPJTtKV7nEGJU8', title:'Hotel Central'},
                        ]"></gmap>
                </div>
            </div>

            <div id="pictures" class="dd-block dd-block-left">
                <div class="dd-container dd-editor mb-12">
                    <h2 class="dd-title">Képek</h2>
                    <p>
                        Amint megkapjuk, ide fogjuk feltölteni az esküvői fotókat. Legalábbis a vállalhatóakat...
                        Ha biztosra akarsz menni, akkor írd ide az e-mail címed és küldjük is.
                    </p>
                </div>
                @include('includes/form')
            </div>

            <div id="music" class="dd-block">
                <music-form></music-form>
            </div>

        </div>

        <div id="footer" class="mt-20">
            <div class="dd-container dd-editor pb-bottom-image-mobile md:pb-bottom-image">
                <p class="dd-title">Bármilyen kérdés esetén</p>
                <hr class="border-b">
                <p>Alexandra - <a href="tel:+36204445056">06-20-444-5056</a></p>
                <p>Gábor - <a href="tel:+36204882237">06-20-488-2237</a></p>
                <p><a href="mailto:hello@alexandra-gabor.hu">hello@alexandra-gabor.hu</a></p>
            </div>

            <div class="absolute bottom-0 w-full -z-10">
                <img src="/img/desktop.png" alt="Levelek" class="rotate hidden sm:block">
                <img src="/img/mobile.png" alt="Levelek" class="rotate sm:hidden">
            </div>
        </div>

    </div>

    <script src="{{ mix('/js/app.js') }}"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzW4ToV0Ugomm7VIXqXRpT_xRSlm8OWBg&callback=initMap">
    </script>
</body>

</html>
