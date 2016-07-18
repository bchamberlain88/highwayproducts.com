<div class='sidebar-signup'>
            <h1 class="newsSign">Newsletter Signup</h1>
            <p>Receive special promotional offers, discount opportunities, and news updates!</p>
            <form class='newsletter-form sidebar-news aweber-form' data-submit='<?php echo $newsFormID; ?>'>
                <input required spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $newsEmailID; ?>' name='news_email' placeholder='Enter your email address' type='text' />
                <button class='button large secondary animate submit' type='submit'>Subscribe To Newsletter</button>
            </form>
            <div class="aweber AW-Form-<?php echo $newsFormID; ?>"></div>
            <!-- newsletter script -->
            <script type="text/javascript">(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//forms.aweber.com/form/99/<?php echo $newsFormID; ?>.js";
                fjs.parentNode.insertBefore(js, fjs);
                }(document, "script", "aweber-wjs-6bhepjf7u"));
            </script>
            <div id="hideSep" class='side-sep'></div>
            <h1 class="interProd">Interested in this product?</h1>
            <p>Click the button below to fill out a form and get a free quote from one of our sales representatves!</p>
            <button class='button large gold sidebar-quote animate submit get-quote-plox' type='submit'>
                <span class='fa fa-paper-plane'></span>
                Get a free quote
            </button>
        </div>