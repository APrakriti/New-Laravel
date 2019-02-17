<!-- Slider -->
<div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">Contact Us </h1>
            </div>
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="#" title="Construction" rel="home" class="trail-begin">Home</a>
                        <span class="sep">/</span>
                        <span class="trail-end">Contact Us </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">

<div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                    <section class="wprt-section">
                        <div class="container">
                            <div class="row">
                              

                                <div class="col-md-4">
                                    <div class="wprt-information">
                                        <h4 class="margin-bottom-15">Contact Details</h4>
                                        
                                        <ul class="style-2">
                                            <li class="address">
                                                <span class="hl">Address:</span>
                                                <span class="text">{{ (Session::has('settings')) ? Session::get('settings')['contact-address'] : "" }}</span>
                                            </li>
                                            <li class="phone">
                                                <span class="hl">Phone:</span> 
                                                <span class="text">{{ (Session::has('settings')) ? Session::get('settings')['contact-number'] : "" }}</span>
                                            </li>
                                            <li class="email">
                                                <span class="hl">E-mail:</span>
                                                <span class="text">{{ (Session::has('settings')) ? Session::get('settings')['web-master-email'] : "" }}</span>
                                            </li>
                                        </ul>
                                    </div><!-- /.wprt-information -->

                                    <div class="wprt-spacer" data-desktop="0" data-mobi="30" data-smobi="30"></div>
                                </div><!-- /.col-md-4 -->

                                <div class="col-md-8">
                                    <h4 class="margin-bottom-15">Write To Us</h4>
                                    <form action="http://rollthemes.com/html5/construction-template/demo/includes/contact/contact-process.php" method="post" class="contact-form wpcf7-form">
                                        <div class="wprt-contact-form-1">
                                            <span class="wpcf7-form-control-wrap name">
                                                <input type="text" tabindex="1" id="name" name="name" value="" class="wpcf7-form-control" placeholder="Name *" required>
                                            </span>
                                            <span class="wpcf7-form-control-wrap email">
                                                <input type="email" tabindex="2" id="email" name="email" value="" class="wpcf7-form-control" placeholder="E-mail *" required>
                                            </span>
                                            <span class="wpcf7-form-control-wrap phone">
                                                <input type="text" tabindex="3" id="phone" name="phone" value="" class="wpcf7-form-control" placeholder="Phone Number">
                                            </span>
                                            <span class="wpcf7-form-control-wrap subject">
                                                <input type="text" tabindex="4" id="subject" name="subject" value="" class="wpcf7-form-control" placeholder="Subject *" required>
                                            </span>
                                            <span class="wpcf7-form-control-wrap message">
                                                <textarea name="message" tabindex="5" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Message" required></textarea>
                                            </span>
                                            <div class="wrap-submit">
                                                <input type="submit" value="SEND MESSAGE" class="submit wpcf7-form-control wpcf7-submit" id="submit" name="submit">
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.col-md-8 -->

                                
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>

        
        <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                         
                                    
                                    
                                    
                           
                       

            

