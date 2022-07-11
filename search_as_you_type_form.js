function search_xero(){
    //search xero contacts for the entry in #q_company
    //and then populate the select box with what you find.
    //only search if there are three or more characters to go on...
    if(jQuery('#q_company').val().length < 3){
        jQuery('#schresults').hide();
        return false;
    } else {
        jQuery('#schresults').show();
        jQuery('#schresults').html('<i class="fas fa-spinner fa-spin"></i>');
    }
    var sch = jQuery('#q_company').val();
    var da = {
        'action' : "get_contact_results",
        'sch' : sch
    }
    var furl = php.quote;
    console.log(da);
    jQuery.ajax({
        method : 'POST',
        data : da,
        url : furl,
        success : function(r){
            console.log(r);
            jQuery('#schresults').html(r);
        },
        error : function(e){
            console.log('AJAX ERROR');
        }
    });
}