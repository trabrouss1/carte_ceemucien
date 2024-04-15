// Add asterix to required fields
$(document).ready(function(){
    $("input[required]").prev().addClass("required-hlper");
    $("input[required]").parent("label").addClass("required-hlper");
    $("select[required]").prev().addClass("required-hlper");
    $("select[required]").parent("label").addClass("required-hlper");
});
