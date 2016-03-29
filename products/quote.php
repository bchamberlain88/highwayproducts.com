<?php
$getQuoteCodes = mysql_query('SELECT * FROM quote_codes WHERE selector = "'.$GLOBALS['quote_selector'].'"');
$quoteCodes = mysql_fetch_assoc($getQuoteCodes);
?>
<div class='get-quote-content'>
	<h2>Fill out <span class='hide six_hundred'>the form below </span>for a free quote</h2>
	<span class='animate close-quote fa fa-close'></span>

	<form class='aweber-form' data-submit='<?php $quoteCodes['form_id'] ?>'>
        <input autocorrect='off' spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-75502994' name='fillname' placeholder='Full name' type='text' />
        <input autocorrect='off' spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-75502991' name='email' placeholder='Email address' type='email' />
        <input autocorrect='off' spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-75502992' name='phone' placeholder='Phone number' type='phone' />
        <input autocorrect='off' spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-75502993' name='zip' placeholder='ZIP code' type='text' />
        <textarea autocorrect='off' speelcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-75502989' name='message' placeholder='Message'></textarea>
        <input autocorrect='off' spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-75502995' name='contact' placeholder='When to contact' type='text' />
        <input autocorrect='off' spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-75502996' name='truck' placeholder='Vehicle year, make, and model' type='text' />
        <button class='button large secondary animate submit' type='submit'>Send me a free quote!</button>
    </form>

	<div class="AW-Form-<?php $quoteCodes['form_id'] ?>" style='left:-99999px;position:absolute;top:-99999px;display:none;'></div>
	<script type="text/javascript">(function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "//forms.aweber.com/form/22/<?php $quoteCodes['form_id'] ?>.js";
	    fjs.parentNode.insertBefore(js, fjs);
	    }(document, "script", "aweber-wjs-04m0nw0rp"));
	</script>
</div>

<script type="text/javascript">

$('.close-quote').on('click', function(){
	$('.get-quote-wrapper').remove();
});

var _contact_errors = [];

$.fn.awebify = function(){
  var _this = $(this);
  if(_this.length > 0){
    var _aweber = _this.attr('data-aweber');
    _this.on('change keyup', function(){
      var _val = _this.val();
      $('#'+_aweber).val(_val);
    });
  }
};

$('.aweber-input').each(function(){
  $(this).awebify();
});

$('.aweber-form').on('submit', function(event){
  event.preventDefault();
  _contact_errors = [];
  var form = $(this);
  var _submit = $(this).attr('data-submit');
  var data = new Array;
  $(this).find('input, textarea').each(function(i){
    
    var _type = $(this).attr('type');
    var _name = $(this).attr('name');
    if(_type != 'submit'){
      var _val = $(this).val();
      if(_val != ''){
        data[i] = _val;
      }else{
        _contact_errors.push(_name);
      }
    }
  });
  
  if(_contact_errors.length > 0){

    // there were errors - catch them

    console.log(_contact_errors);
    $('.form-input, .form-textarea').removeClass('error');
    for(var i = 0; i < _contact_errors.length; i++){
      $("input[name='"+_contact_errors[i]+"'], textarea[name='"+_contact_errors[i]+"']").addClass('error');
    }

  }else{

  	$('.form-input, .form-textarea').removeClass('error');
    $('.af-element .submit').click();

  }

});
</script>