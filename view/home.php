<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Home | PHP Motors</title>

    <link rel="stylesheet" type="text/css" href="../phpmotors/css/small.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../phpmotors/css/medium.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../phpmotors/css/large.css" media="screen" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="/phpmotors/js/nav-bar.js"></script>

</head>
<body>
    <main>
    <header>
        <!--img src="images/site/logo.png" alt="PHP motors logo">
        <button>My Account</button-->
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';?>


    </header>
    <nav >
    <button onclick="toggleMenu()">&#9776;</button>
        <!--ul>
            <li>Home</li>
            <li>Classic</li>
            <li>Sports</li>
            <li>SUV</li>
            <li>Truck</li>
            <li>Used</li>
        </ul-->
        <!--?//php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php';?-->
        <?php echo $navList; ?>
    </nav>
    <h1>Welcome to PHP Motors</h1>
    <article class="delorean-sale">



        <img src="../phpmotors/images/delorean.jpg" alt="Delorean car image">

        <div class="delorean-info">
        <h2>DMC delorean</h2>
        <p>3 cup holders <br>
        Superman Doors <br>
        Fuzzy Dice!</p>
        <button><img src="../phpmotors/images/site/own_today.png" alt="Own today Button"></button>
        </div>

    </article>
    <article class="reviews-and-upgrades">

        <section class="reviews">
            <h2>DMC Delorean Reviews</h2>
            <ul>
                <li>"So fast it's almost like travelling in time" (4/5)</li>
                <li>"Coolest ride on the road" (4/5)</li>
                <li>"I'm feeling Marty Mcfly! (5/5)</li>
                <li>"The most futuristic ride of our day (4/5)</li>
                <li>"80's living and I love it" (5/5)</li>
            </ul>
        </section>


        <section class="upgrades">

            <h2>Delorean Upgrades</h2>

            <figure>
                <div>
                <img src="images/upgrades/flux-cap.png" alt="Picture of a flux capacitor">
                </div>
                <figcaption>
                    <a href="https://www.oreillyauto.com/flux-500.html">Flux Capacitor</a>
                </figcaption>
            </figure>

            <figure>
                <div>
                <img src="images/upgrades/flame.jpg" alt="Flame Decal">
                </div>
                <figcaption>
                    <a href="https://www.amazon.com/flame-decals/s?k=flame+decals&page=2">Flame Decal</a>
                </figcaption>
            </figure>

            <figure>
                <div>    
                    <img src="images/upgrades/hub-cap.jpg" alt="Hub Cap">
                </div>
                <figcaption>
                    <a href="https://en.wikipedia.org/wiki/Hubcap">Hub Cab</a>
                </figcaption>
            </figure>

            <figure>
                <div>
                    <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker">
                </div>
                <figcaption>
                    <a href="https://www.makestickers.com/products/car-stickers/bumper-stickers">Flux Capacitor</a>
                </figcaption>
            </figure>

        </section>

    </article>
    <footer>
    <!--p>&copy; PHP Motors, All rights reserved. All Images used are believed
         to be in "Fair Use". Please notify the author if any are not and 
         they will be removed.</p-->
         <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </footer>
    </main>
    

</body>
</html>