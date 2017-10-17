<!DOCTYPE html>
<html class="" lang="en">
    <head>


        <script src="jquery.min.js"></script> 
        <script src="layout.js"></script> 

    </head>
    <body id="HomePage" class="skyscrapers_on language-en">
        <div id="Page">
            <header class="Header-wrap site-header" itemscope="" itemtype="http://schema.org/Organization">
                <div class="Header-header">
                    <div>
                        <div class="Header-logo">
                            <a href="https://www.myvouchercodes.co.uk/" itemprop="url">
                                <span class="Header-logo-wally"></span>

                                <?php
                                    if (!empty($configurations['logo_bar']) && file_exists(FCPATH.$configurations['logo_bar'])) {
                                ?>
                                <img class="Header-logo-logo" src="<?php echo base_url().$configurations['logo_bar']?>"
                                     alt="<?php echo $configurations['logo_bar_alt']?>" title="<?php echo $configurations['logo_bar_title']?>">
                                <?php
                                }
                                if (ENVIRONMENT != 'production') {
                                    if (empty($configurations['log.o_bar']) || !file_exists(FCPATH.$configurations['logo_bar'])) {
                                        echo "<span class='Header-logo-logo' >WARNING: Logo not found in config table or missing logo file</span>";
                                    }
                                }
                                ?>
                                <meta itemprop="name" content="MyVoucherCodes">
                                <meta itemprop="logo" content="https://mvp.tribesgds.com/dyn/jO/Ow/jOOwNAMQTj0/_/PSFarfKg.oA/owmQ/site_images/myvouchercodes.png">
                            </a>
                        </div>
                        <div class="Search-bar" style="right: 383px;">
                            <form action="https://www.myvouchercodes.co.uk/action/FrontendSearchPageResultAction" method="post"> <input class="Search-input ui-autocomplete-input" name="keywords" placeholder="Type in a Store or Product Name..." autocorrect="off" autocapitalize="none" autocomplete="off" spellcheck="false" data-search-page="https://www.myvouchercodes.co.uk/s?q=xx_replace_search_term_xx" data-view-results="View All Results" data-home-count="fJO5zKBdh1o" data-other-count="1T3YznMQNas" type="search"> <input value="Search" type="submit"> </form>
                        </div>
                        <nav class="HeaderKeyLinks ">
                            <span class="Header-title">Key Links</span> 
                            <ul>
                                <li class="HeaderKeyLinkSite HeaderKeyLink"><a href="https://www.myvouchercodes.co.uk/top50-discounts"><i class="icon-star"></i> Top 50</a> </li>
                                <li class="HeaderKeyLinkSite HeaderKeyLink"><a href="https://www.myvouchercodes.co.uk/restaurants-takeaways-bars"><i class="icon-star"></i> Restaurants</a> </li>
                                <li class="HeaderKeyLinkCategories HeaderKeyLink"><a href="https://www.myvouchercodes.co.uk/categories"><span>Categories</span></a> </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <nav id="HeaderCategories" class="">
                    <span class="Header-title">Categories</span> 
                    <div id="HeaderCategories-container">
                        <ul class="HeaderCategoriesList">
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/fashion"><span class="icon-cat-d"></span>Fashion</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/fashion"><span></span>View all Fashion</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/fashion/children-teen-fashion"><span class="icon-cat-d"></span>Children &amp; Teen Fashion</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/fashion/designer-clothes"><span class="icon-cat-d"></span>Designerwear</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/fashion/footwear"><span class="icon-cat-d"></span>Footwear</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/fashion/jewellery"><span class="icon-cat-4"></span>Jewellery</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/fashion/lingerie-swimwear"><span class="icon-cat-5"></span>Lingerie &amp; Swimwear</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/fashion/mens-fashion"><span class="icon-cat-d"></span>Men's Fashion</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/fashion/plus-size"><span class="icon-cat-d"></span>Plus Size</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/fashion/womens-fashion"><span class="icon-cat-6"></span>Women's Fashion</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/fashion/fashion-accessories"><span class="icon-cat-d"></span>Fashion Accessories</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/food-drink"><span class="icon-cat-f"></span>Food &amp; Drink</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/food-drink"><span></span>View all Food &amp; Drink</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/food-drink/beers-wines-spirits"><span class="icon-cat-f"></span>Beers, Wines &amp; Spirits</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/food-drink/seasonal-food-drinks"><span class="icon-cat-f"></span>Seasonal Food &amp; Drink</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/food-drink/speciality-fine-food"><span class="icon-cat-f"></span>Speciality &amp; Fine Food</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/food-drink/supermarkets-and-groceries"><span class="icon-cat-f"></span>Supermarkets &amp; Groceries</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/restaurants-takeaways-bars"><span class="icon-cat-r"></span>Restaurants, Takeaways &amp; Bars</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/restaurants-takeaways-bars"><span></span>View all Restaurants, Takeaways &amp; Bars</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/restaurants-takeaways-bars/bars"><span class="icon-cat-r"></span>Bars</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/restaurants-takeaways-bars/restaurants"><span class="icon-cat-r"></span>Restaurants</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/restaurants-takeaways-bars/takeaways"><span class="icon-cat-r"></span>Takeaways</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/kids-babies-toys"><span class="icon-cat-j"></span>Kids, Babies &amp; Toys</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/kids-babies-toys"><span></span>View all Kids, Babies &amp; Toys</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/kids-babies-toys/baby-items-furniture"><span class="icon-cat-j"></span>Baby Items &amp; Furniture</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/kids-babies-toys/kids-baby-clothes"><span class="icon-cat-j"></span>Kids &amp; Baby Clothes</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/kids-babies-toys/maternity"><span class="icon-cat-j"></span>Maternity</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/kids-babies-toys/toys-games"><span class="icon-cat-j"></span>Toys &amp; Games</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/gifts-occasions"><span class="icon-cat-g"></span>Gifts &amp; Occasions</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/gifts-occasions"><span></span>View all Gifts &amp; Occasions</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/gifts-occasions/celebrations-events"><span class="icon-cat-g"></span>Celebrations &amp; Events</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/gifts-occasions/experience-days"><span class="icon-cat-g"></span>Experience Days</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/gifts-occasions/flowers"><span class="icon-cat-g"></span>Flowers</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/gifts-occasions/gifts-collectables"><span class="icon-cat-g"></span>Gifts &amp; Collectables</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/gifts-occasions/jewellery-watches"><span class="icon-cat-3"></span>Jewellery &amp; Watches</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/gifts-occasions/parties-fancy-dress"><span class="icon-cat-g"></span>Parties &amp; Fancy Dress</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/gifts-occasions/sweets-chocolates"><span class="icon-cat-g"></span>Sweets &amp; Chocolates</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/gifts-occasions/weddings"><span class="icon-cat-0"></span>Weddings</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/music-books-games-movies"><span class="icon-cat-o"></span>Music, Books, Games &amp; Movies</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/music-books-games-movies"><span></span>View all Music, Books, Games &amp; Movies</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/music-books-games-movies/books-magazines"><span class="icon-cat-o"></span>Books &amp; Magazines</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/music-books-games-movies/dvd-blu-ray-movies"><span class="icon-cat-o"></span>DVD, Blu-ray &amp; Movies</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/music-books-games-movies/games"><span class="icon-cat-o"></span>Games</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/music-books-games-movies/music"><span class="icon-cat-o"></span>Music</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/travel"><span class="icon-cat-u"></span>Travel</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/travel"><span></span>View all Travel</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/travel/flights"><span class="icon-cat-u"></span>Flights</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/travel/holiday-travel-extras"><span class="icon-cat-u"></span>Holiday &amp; Travel Essentials</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/travel/holidays"><span class="icon-cat-u"></span>Holidays</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/travel/hotels-accommodation"><span class="icon-cat-u"></span>Hotels &amp; Accommodation</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/travel/luggage"><span class="icon-cat-u"></span>Luggage</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/travel/parking-transfers-rentals"><span class="icon-cat-u"></span>Parking, Transfers &amp; Rentals</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/travel/trains-buses-ferries"><span class="icon-cat-u"></span>Trains, Buses &amp; Ferries</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/days-out-attractions"><span class="icon-cat-c"></span>Days Out &amp; Attractions</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/days-out-attractions"><span></span>View all Days Out &amp; Attractions</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/days-out-attractions/days-out-tours"><span class="icon-cat-c"></span>Days Out &amp; Tours</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/days-out-attractions/exhibitions-events"><span class="icon-cat-c"></span>Exhibitions &amp; Events</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/days-out-attractions/experience-days"><span class="icon-cat-c"></span>Experience Days</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/days-out-attractions/theatre-shows-concerts"><span class="icon-cat-c"></span>Theatre, Shows &amp; Concerts</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/days-out-attractions/theme-parks-attractions"><span class="icon-cat-w"></span>Theme Parks &amp; Attractions</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/technology-electrical"><span class="icon-cat-t"></span>Technology &amp; Electrical</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/technology-electrical"><span></span>View all Technology &amp; Electrical</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/technology-electrical/accessories-peripherals"><span class="icon-cat-t"></span>Accessories &amp; Peripherals</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/technology-electrical/computing"><span class="icon-cat-t"></span>Computing</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/technology-electrical/gadgets"><span class="icon-cat-t"></span>Gadgets</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/technology-electrical/home-appliances"><span class="icon-cat-t"></span>Home Appliances</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/technology-electrical/home-entertainment"><span class="icon-cat-t"></span>Home Entertainment</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/technology-electrical/photography-video"><span class="icon-cat-x"></span>Photography &amp; Video</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/home-garden"><span class="icon-cat-i"></span>Home &amp; Garden</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/home-garden"><span></span>View all Home &amp; Garden</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/home-garden/bed-bath"><span class="icon-cat-i"></span>Bed &amp; Bath</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/home-garden/diy-tools"><span class="icon-cat-i"></span>DIY &amp; Tools</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/home-garden/fittings-furnishings"><span class="icon-cat-i"></span>Flooring &amp; Furnishings</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/home-garden/garden-buildings-outdoor-living"><span class="icon-cat-i"></span>Garden Buildings &amp; Outdoor Living</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/home-garden/garden-plants-seeds"><span class="icon-cat-i"></span>Garden Plants &amp; Seeds</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/home-garden/hobbycraft"><span class="icon-cat-i"></span>Hobby Craft</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/home-garden/home-furniture"><span class="icon-cat-i"></span>Home Furniture</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/home-garden/kitchens-kitchenware-appliances"><span class="icon-cat-i"></span>Kitchens. Kitchenware &amp; Appliances</a> </li>
                                </ul>
                            </li>
                            <li>
                                <p><a href="https://www.myvouchercodes.co.uk/health-beauty"><span class="icon-cat-h"></span>Health &amp; Beauty</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li class="view-all">
                                        <p><a href="https://www.myvouchercodes.co.uk/health-beauty"><span></span>View all Health &amp; Beauty</a> </p>
                                    </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/health-beauty/contact-lenses-eyecare"><span class="icon-cat-h"></span>Contact Lenses &amp; Eyecare</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/health-beauty/diet-vitamins-supplements"><span class="icon-cat-h"></span>Diet, Vitamins &amp; Supplements</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/health-beauty/general-healthcare-medical"><span class="icon-cat-h"></span>General Healthcare &amp; Medical</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/health-beauty/hair-skincare-beauty"><span class="icon-cat-h"></span>Hair, Skincare &amp; Beauty</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/health-beauty/mens-grooming"><span class="icon-cat-h"></span>Men's Grooming</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/health-beauty/perfume-cologne"><span class="icon-cat-h"></span>Perfume &amp; Cologne</a> </li>
                                </ul>
                            </li>
                            <li class="cat-more">
                                <p><a href="https://www.myvouchercodes.co.uk/categories"><span class="icon-cat-m"></span>More Categories</a> </p>
                                <ul class="HeaderCategoriesList">
                                    <li><a href="https://www.myvouchercodes.co.uk/sports-fitness-outdoors"><span class="icon-cat-s"></span>Sports, Fitness &amp; Outdoors</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/mobile-tv-broadband"><span class="icon-cat-l"></span>Mobile, TV &amp; Broadband</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/finance-insurance"><span class="icon-cat-e"></span>Finance &amp; Insurance</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/pets-and-accessories"><span class="icon-cat-q"></span>Pets &amp; Accessories</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/utilities-home-services"><span class="icon-cat-v"></span>Utilities &amp; Home Services</a> </li>
                                    <li><a href="https://www.myvouchercodes.co.uk/motoring"><span class="icon-cat-n"></span>Motoring</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
    </body>
</html>

