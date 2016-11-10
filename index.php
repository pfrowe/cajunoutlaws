<!doctype html>
<?php
require_once "Mail.php";
include "settings.php";
$tryPost = isset($_POST["co_contact_submit"]) && ($_POST["co_contact_submit"] == 1);
$tryPost = $tryPost && (!isset($_POST["contact_trap"]) || ($_POST["contact_trap"] == ""));
$_POST["contact_name"] = htmlspecialchars(preg_replace("/^\s+|\s+$/", "", $_POST["contact_name"])) ?: "";
$_POST["contact_email"] = htmlspecialchars(preg_replace("/^\s+|\s+$/", "", $_POST["contact_email"])) ?: "";
$_POST["contact_comments"] = htmlspecialchars(preg_replace("/^\s+|\s+$/", "", $_POST["contact_comments"])) ?: "";
$_POST["contact_comments"] = "<p>" . preg_replace("/\n+/", "</p><p>", $_POST["contact_comments"]) . "</p>";
$doPost = $tryPost
    && ($_POST["contact_name"] != "") && ($_POST["contact_email"] != "") && ($_POST["contact_comments"] != "");
if ($doPost) {
  $emailBody = <<<__HTML
    <p>The following information was sent to us via the Contact Us form on the Cajun Outlaws website.</p>
    <hr />
    <div style="float: left; font-weight: bold; width: 20%">Name:</div>
    <div style="float: left; width: 75%">{$_POST["contact_name"]}</div>
    <div style="clear: both"></div>
    <div style="float: left; font-weight: bold; width: 20%">Email:</div>
    <div style="float: left; width: 75%">
      <a href="mailto:{$_POST["contact_email"]}">{$_POST["contact_email"]}</a>
    </div>
    <div style="float: left; font-weight: bold; width: 20%">Comments:</div>
    <div style="float: left; width: 75%">{$_POST["contact_comments"]}</div>
__HTML;
  /* Define the values we need for sending out an email. */
  $email = [
    "headers" => [
      "From" => $emailSettings["from"],
      "Reply-To" => $emailSettings["replyTo"],
      "MIME-Version" => "1.0",
      "Content-Type" => "text/html; charset=UTF-8"
    ],
    "message" => $emailBody,
    "subject" => $emailSettings["subject"],
    "to" => $emailSettings["to"]
  ];
  try {
    /* Try creating the Mail object. */
    $smtp = Mail::factory(
      "smtp",
      [
        "auth" => false,
        "host" => $emailSettings["host"],
        "port" => $emailSettings["port"],
        "username" => $emailSettings["username"],
        "password" => $emailSettings["password"]
      ]
    );
    /* Try sending the email out. */
    $mail = $smtp->send($email["to"], $email["headers"], $email["message"]);
  } catch (Exception $e) {
    /* Something failed. Dump the exception for debugging purposes. */
    var_dump($e);
  }
}
?>
<html>
  <head>
    <title>Cajun Outlaws Bayou Grill</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/co.base.css" />
  </head>
  <body>
    <a class="sr-only sr-only-focusable" href="#beginContent">Skip navigation</a>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                  data-target="#navbar-menu-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img alt="Cajun Outlaws Bayou Grill logo" class="logo" src="img/logo-no-text.png" />
          <a class="navbar-brand" href="#">
            <span class="western">Cajun Outlaws</span>
            <span class="silver">Bayou Grill</span>
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#content-home" data-target="#content-home" data-toggle="tab">
              Home <span class="sr-only">(current)</span>
            </a></li>
            <li><a href="#content-menu" data-target="#content-menu" data-toggle="tab">Menu</a></li>
            <li><a href="#content-contact" data-target="#content-contact" data-toggle="tab">Contact Us</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container tab-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="well">
              <div class="hero-unit">
                <div id="hero__carousel" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#hero__carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#hero__carousel" data-slide-to="1"></li>
                    <li data-target="#hero__carousel" data-slide-to="2"></li>
                    <li data-target="#hero__carousel" data-slide-to="3"></li>
                    <li data-target="#hero__carousel" data-slide-to="4"></li>
                    <li data-target="#hero__carousel" data-slide-to="5"></li>
                    <li data-target="#hero__carousel" data-slide-to="6"></li>
                    <li data-target="#hero__carousel" data-slide-to="7"></li>
                    <li data-target="#hero__carousel" data-slide-to="8"></li>
                    <li data-target="#hero__carousel" data-slide-to="9"></li>
                  </ol>
                  <div class="carousel-inner" role="listbox">
                    <div class="carousel-item item active">
                      <img alt="Boudin Balls" class="img-responsive" src="img/boudin-balls.jpg" />
                    </div>
                    <div class="carousel-item item">
                      <img alt="Grilled Buffalo Chicken Sandwich" class="img-responsive"
                           src="img/buff-chk-sandwich.jpg" />
                    </div>
                    <div class="carousel-item item">
                      <img alt="Catfish Platter" class="img-responsive" src="img/catfish-platter.jpg" />
                    </div>
                    <div class="carousel-item item">
                      <img alt="Ceviche" class="img-responsive" src="img/ceviche.jpg" />
                    </div>
                    <div class="carousel-item item">
                      <img alt="2-pound Crawfish Bowl" class="img-responsive" src="img/crawfish-2lb.jpg" />
                    </div>
                    <div class="carousel-item item">
                      <img alt="Crawfish Tots" class="img-responsive" src="img/crawfish-tots.jpg" />
                    </div>
                    <div class="carousel-item item">
                      <img alt="Fish Basket" class="img-responsive" src="img/fish-basket.jpg" />
                    </div>
                    <div class="carousel-item item">
                      <img alt="Fish Tacos" class="img-responsive" src="img/fish-tacos.jpg" />
                    </div>
                    <div class="carousel-item item">
                      <img alt="Shrimp Po-boy" class="img-responsive" src="img/shrimp-poboy.jpg" />
                    </div>
                    <div class="carousel-item item">
                      <img alt="Dining Area, Spacious Seating" class="img-responsive" src="img/dining-area.jpg" />
                    </div>
                  </div>
                  <a class="left carousel-control" href="#hero__carousel" role="button" data-slide="prev">
                    <span class="icon-prev" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#hero__carousel" role="button" data-slide="next">
                    <span class="icon-next" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div> <!-- END carousel -->
              </div> <!-- END hero-unit -->
            </div> <!-- END well -->
          </div> <!-- END .col-xs-12 .col-sm-12 .col-md-12 .col-lg-12 -->
        </div> <!-- END row -->
      </div> <!-- END container-fluid -->
      <div class="container-fluid tab-pane active" id="content-home">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="well">
              <a href="https://www.yelp.com/map/cajun-outlaws-bayou-grill-houston" target="_blank">
                <img src="https://maps.googleapis.com/maps/api/staticmap?scale=2&center=29.944104%2C-95.584349&language=None&zoom=15&markers=scale%3A2%7Cshadow%3Afalse%7Cicon%3Ahttps%3A%2F%2Fyelp-images.s3.amazonaws.com%2Fassets%2Fmap-markers%2Fannotation_64x86.png%7C29.944104%2C-95.584349&client=gme-yelp&sensor=false&size=286x135&signature=7rXVRijUIFuF2iGJxg3f9nt6dRE="
                     alt="Map to Cajun Outlaws Bayou Grill" class="img-responsive pull-right"
                     style="height: 135px; width: 286px" />
              </a>
              <h2>Find Us!</h2>
              <a href="https://www.yelp.com/map/cajun-outlaws-bayou-grill-houston" target="_blank">
                Cajun Outlaws Bayou Grill<br />
                11650 Jones Rd<br />
                Houston, TX 77070<br />
                (Jones Rd. and Woodedge Dr.)
              </a>
            </div> <!-- END well -->
            <div class="well">
              <h2>Hours</h2>
              <table>
                <tbody>
                  <tr>
                    <th class="pull-left" scope="row">Monday</th>
                    <td class="pull-right">Closed</td>
                  </tr>
                  <tr>
                    <th class="pull-left" scope="row">Tuesday</th>
                    <td class="pull-right">11:00 am - 9:00 pm</td>
                  </tr>
                  <tr>
                    <th class="pull-left" scope="row">Wednesday</th>
                    <td class="pull-right">11:00 am - 9:00 pm</td>
                  </tr>
                  <tr>
                    <th class="pull-left" scope="row">Thursday</th>
                    <td class="pull-right">11:00 am - 9:00 pm</td>
                  </tr>
                  <tr>
                    <th class="pull-left" scope="row">Friday</th>
                    <td class="pull-right">11:00 am - 10:00 pm</td>
                  </tr>
                  <tr>
                    <th class="pull-left" scope="row">Saturday</th>
                    <td class="pull-right">12:00 noon - 10:00 pm</td>
                  </tr>
                  <tr>
                    <th class="pull-left" scope="row">Sunday</th>
                    <td class="pull-right">12:00 noon - 7:00 pm</td>
                  </tr>
                </tbody>
              </table>
            </div> <!-- END well -->
          </div> <!-- END .col-xs-12 .col-sm-12 .col-md-12 .col-lg-6 -->
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="well">
              <h2>Connect With Us!</h2>
              <a href="https://www.facebook.com/CajunOutlawsTX/" target="_blank">
                <img alt="Like us on Facebook" class="img-responsive lic-plate" src="img/licplate-facebook.png" />
              </a>
              <a href="https://twitter.com/Cajun_Outlaws?lang=en" target="_blank">
                <img alt="Follow us on Twitter" class="img-responsive lic-plate" src="img/licplate-twitter.png" />
              </a>
              <a href="https://www.yelp.com/biz/cajun-outlaws-bayou-grill-houston" target="_blank">
                <img alt="Review us on Yelp" class="img-responsive lic-plate" src="img/yelp-badge.png" />
              </a>
              <a href="https://www.doordash.com/store/cajun-outlaws-bayou-grill-houston-65211/" target="_blank">
                <img alt="Delightful Delivery by Door Dash" class="img-responsive lic-plate"
                     src="img/licplate-doordash.png" />
              </a>
              <div class="clear"></div>
            </div> <!-- END well -->
          </div> <!-- END .col-xs-12 .col-sm-12 .col-md-12 .col-lg-6 -->
        </div> <!-- END row -->
      </div> <!-- END #content-home -->
      <div class="container-fluid tab-pane" id="content-menu">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="well">
              <h2>Starters</h2>
              <dl>
                <dt>Boudin Link</dt>
                <dd>(1) Creole sausage made of pork, dirty rice, and enhanced with fresh chopped parsley and thinly sliced green scallions. 3.49</dd>
                <dt>Boudin Balls</dt>
                <dd>Creole dirty rice rolled and battered in our homemade Cajun seasoning, then fried to a golden crisp. (3) 2.95</dd>
                <dt>Cajun Eggroles</dt>
                <dd>Jumbalaya rice chicken, shrimp, sausage</dd>
                <dt>Fried Pickles</dt>
                <dd>Now these are worth bragging about! Our select dill pickle slices battered and seasoned to perfection will have you coming back for more! 4.45</dd>
                <dt>Beer Battered Onion Rings</dt>
                <dd>No introduction needed for these bad boys! 3.99</dd>
                <dt>Shrimp Ceviche</dt>
                <dd>Shrimp marinated in lemon-lime juice and pico de gallo garnished with avocado and cilantro, served with crackers. 6.99</dd>
                <dt>Shrimp Cocktail</dt>
                <dd>3.99</dd>
                <dt>Spinach &amp; Artichoke Dip</dt>
                <dd>Served with toasted baguettes. 6.99</dd>
              </dl>
            </div> <!-- END well -->
            <div class="well">
              <h2>Salad</h2>
              <dl>
                <dt>Grilled Chicken Salad</dt>
                <dd>
                  Boneless checken breast seasoned and grilled placed atop a bed of lettuce, spinach, baby
                  carrots, cherry tomatoes, red onion, broccoli, and topped with croutons. 8.95
                </dd>
              </dl>
            </div> <!-- END .well -->
            <div class="well">
              <h2>Comfort Food</h2>
              <dl>
                <dt>New Orlean's Red Beans &amp; Rice</dt>
                <dd>Served with corn bread. 5.95</dd>
                <dt>Momo's Gumbo - (Saturday &amp; Sunday only)</dt>
                <dd>Home-made gumbo served with jasmine rice. 6.49</dd>
                <dt>Etouffee</dt>
                <dd>
                  Made from scratch with shrimp, chicken, and sausage, garnished with green onions. 6.99
                </dd>
                <dt>Jambalaya</dt>
                <dd>
                  Classic Louisiana-style chicken and sausage jumbalaya with just a slight kick of spice.
                  6.49
                </dd>
              </dl>
            </div> <!-- END .well -->
            <div class="well">
              <h2>Burger Baskets</h2>
              <p>Served with Cajun fries. Substitute onion rings for additional 0.99.</p>
              <dl>
                <dt>Build Ur Burger</dt>
                <dd>
                  Hand-crafted patty served with lettuce, tomatoes, pickles, onions, mayo &amp; mustard. 6.99
                </dd>
                <dt>Boudreaux Burger</dt>
                <dd>
                  Hand-crafted patty with pepper jack cheese, bacon, grilled jalape&ntilde;os, onion rings,
                  lettuce, tomatoes &amp; pickles topped w/ spicy mayo. 8.99
                </dd>
                <dt>Mellow Zing Burger</dt>
                <dd>
                  Hand-crafted patty topped with our special "donkey sauce", lettuce, tomatoes, grilled red onions, Swiss cheese, bacon &amp; avocado. 8.99
                </dd>
                <dt>Cowboy Burger</dt>
                <dd>
                  Hand-crafted patty with bacon, fried egg, American cheese, grilled red onions, grilled jalape&ntilde;os, lettuce &amp; tomatoes. 9.95
                </dd>
                <dt>Fat Boy BBQ Burger</dt>
                <dd>
                  Hand-crafted patty with BBQ sauce, avocado, onion rings, bacon, American cheese, lettuce
                  &amp; tomatoes. 9.95
                </dd>
                <dt>Black &amp; Blue Burger</dt>
                <dd>
                  Hand-crafted patty with heavy bleu cheese sauce, grilled red onions, bacon, lettuce &amp;
                  tomatoes. 9.95
                </dd>
              </dl>
            </div> <!-- END .well -->
            <div class="well">
              <h2>Extras</h2>
              <dl>
                <dd>Cajun Fries 1.95</dd>
                <dd>Side Salad 1.99</dd>
                <dd>Dirty Rice 2.99</dd>
                <dd>Garlic Mashed Potatoes 1.99</dd>
                <dd>Saut&eacute;ed Asparagus 1.99</dd>
                <dd>Celery &amp; Carrots 0.50</dd>
                <dd>Bottled Soda 1.95</dd>
                <dd>Fountain Drinks &amp; Tea 1.95</dd>
              </dl>
            </div> <!-- END .well -->
          </div><!-- END .col-xs-12 .col-sm-12 .col-md-6 .col-lg-6 -->
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="well">
              <h2>Sandwich Baskets</h2>
              <p>Served with Cajun fries. Substitute onion rings for additional 0.99.</p>
              <dl>
                <dt>Buffalo Chicken Sandwich</dt>
                <dd>
                  Boneless chicken breast grilled to perfection and tossed in traditional buffalo sauce and
                  garnished with lettuce, tomatoes and onions. 8.95
                </dd>
                <dt>Grilled Chicken Sandwich</dt>
                <dd>
                  Boneless chicken breast seasoned &amp; grilled to perfection garnished with lettuce, tomatoes
                  and onions. 8.95
                </dd>
                <dt>Classic Bacon, Lettuce, Tomato</dt>
                <dd>It is what it is. 5.99</dd>
              </dl>
            </div> <!-- END .well -->
            <div class="well">
              <h2>Po Boys</h2>
              <p>Served with Cajun fries. Substitute onion rings for additional 0.99.</p>
              <dl>
                <dt>Shrimp Po Boy</dt>
                <dd>
                  Lightly battered lemon pepper shrimp on French bread made daily and garnished with
                  r&eacute;moulade sauce, lettuce, tomato and onion. 10.49
                </dd>
                <dt>Catfish Po Boy</dt>
                <dd>
                  Battered lemon pepper catfish on French bread made daily garnished with r&eacute;moulade
                  sauce, lettuce, tomato and onion. 10.49
                </dd>
                <dt>Blackened Catfish Po Boy</dt>
                <dd>
                  Blackened catfish on French bread made daily garnished with r&eacute;moulade sauce, lettuce,
                  tomato and onion. 11.49
                </dd>
                <dt>Grilled Chicken Po Boy</dt>
                <dd>
                  Boneless chicken breast seasoned and grilled on French bread made daily garnished with
                  r&eacute;moulade sauce, lettuce, tomato and onion. 8.99
                </dd>
              </dl>
            </div> <!-- END .well -->
            <div class="well">
              <h2>Wings</h2>
              <dl>
                <dt>Traditional Wings</dt>
                <dd>Served with your choice of ranch or bleu cheese. (6) 5.99 (10) 8.99</dd>
                <ul>
                  <li>Buffalo Style</li>
                  <li>Lemon Pepper</li>
                  <li>Spicy Roasted Garlic</li>
                  <li>BBQ</li>
                  <li>X-Rated</li>
                </ul>
              </dl>
            </div> <!-- END .well -->
            <div class="well">
              <h2>Seafood Baskets</h2>
              <p>Served with Cajun fries. Substitute onion rings for additional 0.99.</p>
              <dl>
                <dt>Fried Shrimp</dt>
                <dd>(8) large Gulf shrimp lightly battered with lemon pepper. 11.95</dd>
                <dt>Fried Catfish</dt>
                <dd>Two fillets Mississippi catfish with a light lemon pepper seasoning. 9.95</dd>
                <dt>Fried Catfish &amp; Shrimp</dt>
                <dd>
                  Can't decide? Try the best of both worlds! Comes with one fillet and three shrimp. 10.49
                </dd>
              </dl>
            </div> <!-- END .well -->
            <div class="well">
              <h2>Seafood</h2>
              <dl>
                <dt>Boiled Jumbo Gulf Shrimp</dt>
                <dd>
                  Wild-caught shrimp straight from the Gulf tossed in our spicy Louisiana Boil. (6) 8.99 or 17.99 per lb.
                </dd>
                <dt>Blackened Catfish</dt>
                <dd>Served with dirty rice. 9.95</dd>
                <dt>Grilled Tilapia</dt>
                <dd>Served with dirty rice. 8.95</dd>
                <dt>Blackened Salmon</dt>
                <dd>
                  Wild Alaskan salmon served with garlic mashed potatoes and saut&eacute;ed asparagus. 12.99
                </dd>
                <dt>Shrimp Tacos</dt>
                <dd>
                  (3) shrimp tacos served on corn tortillas and topped with our special mango relish and sweet
                  chipotle sauce. 5.99
                </dd>
                <dt>Fish Tacos</dt>
                <dd>
                  (3) fish tacos served on corn tortillas and topped with our special mango relish and sweet
                  chipotle sauce. 5.99
                </dd>
              </dl>
            </div> <!-- END .well -->
            <div class="well">
              <h2>Kids</h2>
              <p>Served with fries &amp; juice box</p>
              <dl>
                <dd>Grilled Cheese 3.99</dd>
                <dd>Cheeseburger 3.99</dd>
                <dd>Chicken Nuggets 3.99</dd>
              </dl>
            </div> <!-- END .well -->
          </div> <!-- END .col-xs-12 .col-sm-12 .col-md-6 .col-lg-6 -->
        </div> <!-- END .row -->
      </div> <!-- END #content-menu -->
      <div class="container-fluid tab-pane" id="content-contact">
        <form action="#" method="post">
          <div class="well">
            <div class="form-group">
              <div class="form-text">
                Make sure to provide information for all fields marked required
                (<span class="glyphicon glyphicon-asterisk"></span>).
              </div>
            </div> <!-- END .form-group -->
            <div class="form-group">
              <label for="contact_name">
                <span class="glyphicon glyphicon-asterisk"></span>
                Your Name
              </label>
              <input type="text" class="form-control" id="contact_name" name="contact_name" maxlength="255" />
            </div> <!-- END .form-group -->
            <div class="form-group">
              <label for="contact_email">
                <span class="glyphicon glyphicon-asterisk"></span>
                Your Email Address
              </label>
              <input type="email" class="form-control" id="contact_email" name="contact_email" maxlength="255" />
            </div> <!-- END .form-group -->
            <div class="form-group">
              <label for="contact_comments">
                <span class="glyphicon glyphicon-asterisk"></span>
                Comments
              </label>
              <textarea class="form-control" id="contact_comments" name="contact_comments" maxlength="2048">
              </textarea>
            </div> <!-- END .form-group -->
            <div class="form-group" hidden="hidden">
              <label for="contact_trap">Humans don't submit anything in this control</label>
              <input class="form-control" type="text" id="contact_trap" name="contact_trap" value="" />
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" name="co_contact_submit" value="1">Contact Us</button>
            </div> <!-- END .form-group -->
          </div> <!-- END .well -->
        </form>
      </div> <!-- END #content-contact -->
    </div> <!-- END .container .tab-content -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/co.base.js"></script>
  </body>
</html>
