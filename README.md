# johnyburnz
e-Commerce site for a musician to upload music and make it available at an optional price.

The project uses the laravel framework. Its uses PHP and JavaScript only, although Vue was installed via npm there is no Vue code. 
It is there for the next update to the site. Routes are under web.php

The site was originally going to allow multiple users to showcase their music but in the end has been limited to only one user. 
Hence, why is imageGallery.blade.php and mediaGallery.blade.php it only shows the files for user with id == 1.

The site uses the Stripe payment gateway (see Stripe.com) for processing card payments. 
These lines of code can be found in the CartController, checkout.blade.php and javascript/client.js

Both CartController and client.js require Stripe account keys to receive payments. 
For showcasing purposes on github I have only included the development keys which are generic.
