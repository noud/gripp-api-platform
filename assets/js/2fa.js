jQuery(document).ready(function () {
	let formId = 's6411e22d72';
	let urlGenerate = jQuery('#google_authenticator_secret').data('url-request');
	let urlQr = jQuery('#google_authenticator_secret').data('url-qr');
	let itemId = jQuery('#google_authenticator_secret').data('item-id');	

    jQuery("#getGoogleAuthenticatorSecret").click(function () {
        jQuery.ajax({
            type: 'POST',
            url: urlGenerate,
            success: function (data) {
            	console.log(formId+'_googleAuthenticatorSecret');
                jQuery("#"+formId+"_googleAuthenticatorSecret").val(data);
            }
        });
    });
    if (itemId) {
	    if (jQuery("#"+formId+"_googleAuthenticatorSecret").val()) {
	        jQuery.ajax({
	            type: 'POST',
	            url: urlQr,
	            success: function (data) {
	                jQuery("#qr_image").attr("src",data);
	            }
	        });
	    }
    }
    jQuery("#clearGoogleAuthenticatorSecret").click(function () {
        jQuery("#"+formId+"_googleAuthenticatorSecret").val('');
        jQuery("#qr_image").attr("src",'');
        jQuery("#qr_code").hide();
    });
});