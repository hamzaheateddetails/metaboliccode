<?php
class TVC_Pricings {
  protected $TVC_Admin_Helper="";
  protected $url = "";
  protected $subscriptionId = "";
  protected $google_detail;
  protected $customApiObj;
  protected $pro_plan_site;

  public function __construct() {
    $this->TVC_Admin_Helper = new TVC_Admin_Helper();
    $this->customApiObj = new CustomApi();
    $this->subscriptionId = $this->TVC_Admin_Helper->get_subscriptionId(); 
    $this->google_detail = $this->TVC_Admin_Helper->get_ee_options_data(); 
    $this->TVC_Admin_Helper->add_spinner_html();
    $this->pro_plan_site = $this->TVC_Admin_Helper->get_pro_plan_site();     
    $this->create_form();
  }

  public function create_form() {       
    $googleDetail = [];
    $plan_id = 1;
    if(isset($this->google_detail['setting'])){
      if ($this->google_detail['setting']) {
        $googleDetail = $this->google_detail['setting'];
        if(isset($googleDetail->plan_id) && !in_array($googleDetail->plan_id, array("1"))){
          $plan_id = $googleDetail->plan_id;
        }
      }
    }

    $close_icon = esc_url_raw(ENHANCAD_PLUGIN_URL.'/admin/images/close.png');
    $check_icon = esc_url_raw(ENHANCAD_PLUGIN_URL.'/admin/images/check.png');
    ?>
<div class="tab-content">
	<div class="tab-pane show active" id="tvc-account-page">
		<div class="tab-card" >			
       <div class="tvc-price-table-features columns-5">
        <div class="tvc-container"> 
          <div class="clearfix">
            <div class="row-heading clearfix">
               <div class="column tvc-blank-col"><span><?php esc_html_e("Features","enhanced-e-commerce-for-woocommerce-store"); ?></span></div>
               <div class="column discounted tvc-free-plan">
                  <div class="name-wrap"><div class="name"><?php esc_html_e("STARTER","enhanced-e-commerce-for-woocommerce-store"); ?></div></div>
                  <div class="tvc-list-price">
                    <div class="price-current"><span class="inner"><?php esc_html_e("FREE","enhanced-e-commerce-for-woocommerce-store"); ?></span></div>
                    <div class="tvc_month_free"><?php esc_html_e("FOREVER FREE","enhanced-e-commerce-for-woocommerce-store"); ?></div>
                  </div>
                  <span>
                    <a href="javascript:void(0)" class="btn tvc-btn"><?php esc_html_e("Currently Active","enhanced-e-commerce-for-woocommerce-store"); ?></a>
                  </span>
               </div>
               <div class="column discounted ">
                  <div class="name-wrap"><div class="name"><?php esc_html_e("HUSTLE","enhanced-e-commerce-for-woocommerce-store"); ?></div></div>
                  <div class="tvc-list-price-month">
                    <div class="tvc-list-price">
                      <div class="price-normal">
                        <span><?php esc_html_e("$39.00","enhanced-e-commerce-for-woocommerce-store"); ?></span>
                        <div class="tvc-plan-off"><?php esc_html_e("50% OFF","enhanced-e-commerce-for-woocommerce-store"); ?></div>
                      </div>
                      <div class="price-current"><span class="inner"><?php printf("%s <span>%s</span>",esc_html_e("$19"),esc_html_e("/month")); ?></span></div>
                      <div class="tvc_month_free"><?php esc_html_e("Limited Offer","enhanced-e-commerce-for-woocommerce-store"); ?></div>
                    </div>
                    <a target="_blank" href="<?php echo esc_url_raw("https://conversios.io/checkout/?pid=plan_1_m&utm_source=EE+Plugin+User+Interface&utm_medium=HUSTLE&utm_campaign=Upsell+at+Conversios"); ?>" class="btn tvc-btn"><?php esc_html_e("Get Started","enhanced-e-commerce-for-woocommerce-store"); ?></a>
                  </div>              
               </div>
               <div class="column discounted popular">
                <div class="tvc_popular">
                  <div class="tvc_popular_inner"><?php esc_html_e("POPULAR","enhanced-e-commerce-for-woocommerce-store"); ?></div>
                </div>
                  <div class="name-wrap">
                     <div class="name"><?php esc_html_e("GROWTH","enhanced-e-commerce-for-woocommerce-store"); ?></div>                
                  </div>
                  <div class="tvc-list-price-month">
                    <div class="tvc-list-price">
                      <div class="price-normal"><span><?php esc_html_e("$59.00","enhanced-e-commerce-for-woocommerce-store"); ?></span>
                        <div class="tvc-plan-off"><?php esc_html_e("50% OFF","enhanced-e-commerce-for-woocommerce-store"); ?></div>
                      </div>
                      <div class="price-current"><span class="inner"><?php printf("%s <span>%s</span>",esc_html_e("$29"),esc_html_e("/month")); ?></span></div>
                      <div class="tvc_month_free"><?php esc_html_e("Limited Offer","enhanced-e-commerce-for-woocommerce-store"); ?></div>
                    </div>
                    <a target="_blank"  href="<?php echo esc_url_raw("https://conversios.io/checkout/?pid=plan_2_m&utm_source=EE+Plugin+User+Interface&utm_medium=GROWTH&utm_campaign=Upsell+at+Conversios"); ?>" class="btn tvc-btn"><?php esc_html_e("Get Started","enhanced-e-commerce-for-woocommerce-store"); ?></a>
                  </div>              
               </div>
               <div class="column discounted ">
                  <div class="name-wrap">
                     <div class="name"><?php esc_html_e("LEAP","enhanced-e-commerce-for-woocommerce-store"); ?></div>                
                  </div>
                  <div class="tvc-list-price-month">
                    <div class="tvc-list-price">
                      <div class="price-normal"><span><?php esc_html_e("$99.00","enhanced-e-commerce-for-woocommerce-store"); ?></span>
                        <div class="tvc-plan-off"><?php esc_html_e("50% OFF","enhanced-e-commerce-for-woocommerce-store"); ?></div>
                      </div>
                      <div class="price-current"><span class="inner"><?php printf("%s <span>%s</span>",esc_html_e("$49"),esc_html_e("/month")); ?></span></div>
                      <div class="tvc_month_free"><?php esc_html_e("Limited Offer","enhanced-e-commerce-for-woocommerce-store"); ?></div>
                    </div>
                    <a target="_blank" href="<?php echo esc_url_raw("https://conversios.io/checkout/?pid=plan_3_m&utm_source=EE+Plugin+User+Interface&utm_medium=LEAP&utm_campaign=Upsell+at+Conversios"); ?>" class="btn tvc-btn"><?php esc_html_e("Get Started","enhanced-e-commerce-for-woocommerce-store"); ?></a>
                  </div>                
               </div>
            </div>
            <div class="row-subheading clearfix"><?php esc_html_e("Analytics","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Universal Analytics Tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Google Analytics 4 Tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Dual Set up (UA + GA4)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("eCommerce tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Limited)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Shopping Behavior Analysis","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Limited)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Checkout Behavior Tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Limited)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Channel Performance Analysis","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Limited)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("All Pages tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Google Analytics and Google Ads linking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Custom dimensions tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Custom metrics tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Affiliate performance tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Coupon Performance Tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Actionable Dashboard (GA3/ GA4)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Limited)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Facebook pixel tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Limited)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div>
            <div class="row-subheading clearfix"><?php esc_html_e("Google Shopping","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Google Merchant Center account management","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Site verification","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Domain claim","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Products Sync via Content API","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(upto 100)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(upto 1000)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(upto 5000)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Unlimited)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Automatic Products Update","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(upto 100)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(upto 1000","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(upto 5000)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Unlimited)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Schedule Product Sync","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Smart Shopping Campaign management","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Smart Shopping reports","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Google Ads and Google Merchant Center account linking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Remarketing tags","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Dynamic Remarketing Tags for eCommerce events","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Limited)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"><br><?php esc_html_e("(Complete)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Google Ads Conversion tracking","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Compatibility with Brands Plugin","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Product filters for selected products sync","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><?php esc_html_e("(Upcoming)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><?php esc_html_e("(Upcoming)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column popular"><?php esc_html_e("(Upcoming)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><?php esc_html_e("(Upcoming)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            </div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Performance max campaigns","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column popular"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div>
            <div class="row-subheading clearfix"><?php esc_html_e("Support","enhanced-e-commerce-for-woocommerce-store"); ?></div>
            <div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Free Google Analytics Audit","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Free Consultation with Shopping Expert","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-feature clearfix">
               <div class="column"><?php esc_html_e("Dedicated Customer Success Manager","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div><div class="row-footer clearfix">
               <div class="column"><?php esc_html_e("Premium Support (24*7)","enhanced-e-commerce-for-woocommerce-store"); ?></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column"><img src="<?php echo esc_url_raw($close_icon); ?>" alt="no"></div>
               <div class="column popular "><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
               <div class="column"><img src="<?php echo esc_url_raw($check_icon); ?>" alt="yes"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="tvc-guarantee">
        <div class="guarantee">
          <div class="title"><?php printf("<span>%s</span>%s", esc_html_e("15 Days","enhanced-e-commerce-for-woocommerce-store"), esc_html_e("100% No-Risk Money Back Guarantee!","enhanced-e-commerce-for-woocommerce-store")); ?></div>
          <div class="description"><?php esc_html_e("You are fully protected by our 100% No-Risk-Double-Guarantee. If you don’t like over the next 15 days, then we will happily refund 100% of your money. No questions asked.","enhanced-e-commerce-for-woocommerce-store"); ?></div>
        </div>
      </div>
    </div>
	</div>
</div>
<?php
    }
}
?>